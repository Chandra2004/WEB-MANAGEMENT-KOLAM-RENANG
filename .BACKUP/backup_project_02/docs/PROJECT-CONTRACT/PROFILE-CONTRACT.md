# 📜 Kontrak API - Group PROFILE (User Profile)

Dokumen ini menjelaskan spesifikasi antarmuka (interface) antara Back-end dan Front-end untuk pengelolaan profil pengguna.

---

## 🔐 Group: PROFILE (My Profile)

Endpoint ini digunakan oleh pengguna yang sudah login (Admin, Coach, Member) untuk mengelola informasi profil mereka.

---

## 👤 URL: GET `/{role}/dashboard/my-profile`

### 📥 JSON Response (Data Terkirim ke View)

```json
{
  "notification": null,
  "title": "Dashboard admin | Khafid Swimming Club (KSC) - Official Website",
  "user": {
    "id_user": 1,
    "uid": "4e8ada26-3a11-473e-852e-b402a35328e3",
    "nama_lengkap": "admin cuyy",
    "email": "admin@gmail.com",
    "no_telepon": null,
    "tanggal_lahir": null,
    "jenis_kelamin": null,
    "nama_klub": null,
    "alamat": null,
    "foto_ktp": null,
    "foto_profil": null,
    "is_active": 1,
    "nama_role": "admin"
  },
  "totalUnreadNotification": 1,
  "unReadNotification": [
    {
      "id_notification": 1,
      "uid": "50a46709-7cb8-488e-b07f-f503b4104ee8",
      "uid_user": "4e8ada26-3a11-473e-852e-b402a35328e3",
      "judul": "Prof.",
      "pesan": "Sed culpa velit sed inventore nobis reiciendis saepe. Quam maxime sequi nemo id. Libero quos quo asperiores numquam voluptatem dicta saepe non. Consequatur facilis delectus voluptatem.",
      "is_read": 0,
      "created_at": "2026-02-21 16:36:26",
      "updated_at": "2026-02-21 16:36:26"
    }
  ]
}
```

### 📝 Tugas Back-end (Farrel)

1. **Model Query**: Ambil data terbaru user berdasarkan `Helper::session_get('user')`. Pastikan `password` tidak ditarik.

### 🎨 Tugas Front-end (Mada)

Gunakan syntax Blade yang sudah ada, lalu modifikasi bagian berikut:

1. **Inisialisasi Alpine.js**: Pada fungsi `profileHandler()`, inisialisasi `avatarUrl` dan `ktpUrl` menggunakan PHP:
   - `avatarUrl`: `{{ $user['foto_profil'] ? url('/file/users/' . $user['foto_profil']) : "https://ui-avatars.com/api/?name=" . urlencode($user['nama_lengkap']) . "&background=eff6ff&color=1e40af&size=256&bold=true" }}`
   - `ktpUrl`: `{{ $user['foto_ktp'] ? url('/file/ktp/' . $user['foto_ktp']) : 'null' }}`
2. **Binding Value**: Ganti nilai statis pada input (`value="Nabil"`, dll) menjadi dinamis: `value="{{ $user['nama_lengkap'] }}"`.
3. **Select Option**: Gunakan logic `@if` untuk menentukan option mana yang memiliki atribut `selected` pada field Jenis Kelamin.
4. **Readonly Fields**: Biarkan Email dan Afiliasi Klub dalam mode `readonly`.

---

## 🚀 URL: POST `/{role}/{uidUser}/dashboard/my-profile/edit/process`

### 📤 JSON Request (Body / Form-Data)

```json
{
  "nama_lengkap": "Nabil Ahmad",
  "no_telepon": "08123456789",
  "tanggal_lahir": "2005-12-03",
  "jenis_kelamin": "L",
  "alamat": "Jl. Ikan Hiu No. 123",
  "password": "newpassword123", // Opsional
  "foto_profil": "file_binary_image", // Opsional
  "foto_ktp": "file_binary_image" // Opsional
}
```

### 📝 Tugas Back-end (Farrel)

#### 1. Validasi (ProfileRequest)

Farrel harus mendefinisikan `rules()` di `app/Http/Requests/ProfileRequest.php`:

- `nama_lengkap`: `required|string|max:100`
- `no_telepon`: `nullable|string|numeric|max:15`
- `tanggal_lahir`: `required|date`
- `jenis_kelamin`: `required|in:L,P`
- `alamat`: `nullable|string|max:255`
- `password`: `nullable|string|min:6`
- `foto_profil`: `nullable|image|max:2560` (KB)
- `foto_ktp`: `nullable|image|max:2560` (KB)

#### 2. Otorisasi Keamanan

Gunakan method statis di `User.php` untuk memastikan keamanan akses.

- **Method**: `User::authorizeAction($role, $uidUser)`.
- **Kondisi**: Jika user mencoba mengedit UID yang bukan miliknya (lewat URL), sistem harus menolak (403/Redirect).

#### 3. Logika Model & Database (User.php)

Seluruh query harus berada di dalam Model menggunakan **Try-Catch** dan **Database Transactions**.

- **Pengecekan Duplikasi**: Sebelum update, cek apakah `no_telepon` baru sudah digunakan oleh user lain. Jika ya, `throw new \Exception("Nomor telepon sudah digunakan oleh orang lain.")`.
- **Password Hashing**: Lakukan hashing (`password_hash`) hanya jika field password diisi dengan `Helper::password_hash()`.
- **Query Update**: Gunakan `Database::beginTransaction()` untuk menjamin data tersimpan sempurna atau tidak sama sekali (Rollback jika error).

#### 4. File Handling & Storage Management (Gunakan `UploadHandler`)

Farrel harus mengikuti alur "All-in" ini untuk memastikan storage tidak bengkak oleh file sampah:

- **Persiapan**: Gunakan `use TheFramework\Config\UploadHandler;` di bagian atas controller.
- **Step 1: Identifikasi File Lama**:
  Ambil data user saat ini dari database. Simpan nama file `foto_profil` dan `foto_ktp` lama ke dalam variabel (misal: `$oldAvatar` dan `$oldKtp`).
- **Step 2: Eksekusi Update Foto Profil**:
  1. Cek apakah ada file yang diunggah: `if ($request->hasFile('foto_profil'))`.
  2. Jika ada, hapus file lama: `UploadHandler::delete($oldAvatar, '/users')`.
  3. Upload file baru (Konversi ke WebP): `$res = UploadHandler::upload($request->file('foto_profil'), ['uploadDir' => '/users', 'maxSize' => 2621440, 'prefix' => 'user', 'convertTo' => 'webp'])`.
  4. Cek Error: `if (UploadHandler::isError($res)) throw new \Exception(UploadHandler::getErrorMessage($res));`.
  5. Update variabel data: `$dataToUpdate['foto_profil'] = $res['filename'];`.
- **Step 3: Eksekusi Update Foto KTP**:
  1. Cek apakah ada file yang diunggah: `if ($request->hasFile('foto_ktp'))`.
  2. Jika ada, hapus file lama: `UploadHandler::delete($oldKtp, '/ktp')`.
  3. Upload file baru (Konversi ke WebP): `$res = UploadHandler::upload($request->file('foto_ktp'), ['uploadDir' => '/ktp', 'maxSize' => 2621440, 'prefix' => 'ktp', 'convertTo' => 'webp'])`.
  4. Cek Error: `if (UploadHandler::isError($res)) throw new \Exception(UploadHandler::getErrorMessage($res));`.
  5. Update variabel data: `$dataToUpdate['foto_ktp'] = $res['filename'];`.
- **Penting**: Proses penghapusan file lama harus dilakukan **sebelum** upload file baru sukses agar tidak terjadi kebingungan referensi nama file di server.

#### 5. Controller & Session Sync (Urutan Eksekusi)

Farrel harus mengikuti urutan kode berikut di dalam Controller:

1. **Ambil Data**: `$dataToUpdate = $request->validated();` (Mendapatkan data teks yang aman).
2. **Hapus Password dari Array**: Jika password kosong, hapus dari `$dataToUpdate` agar tidak menimpa password lama: `if(empty($dataToUpdate['password'])) unset($dataToUpdate['password']);`.
3. **Proses File (Step 2 & 3 di atas)**:
   - Jika `$request->hasFile('foto_profil')`, jalankan `UploadHandler`, lalu: `$dataToUpdate['foto_profil'] = $res['filename'];`.
   - Jika `$request->hasFile('foto_ktp')`, jalankan `UploadHandler`, lalu: `$dataToUpdate['foto_ktp'] = $res['filename'];`.
4. **Kirim ke Model**: `User::updateProfile($uidUser, $dataToUpdate);` (Dijalankan setelah array `$dataToUpdate` siap sepenuhnya).
5. **Try-Catch**: Bungkus seluruh urutan di atas dalam blok `try-catch`.
6. **Sync Session**: Setelah sukses, perbarui data session user menggunakan `Helper::session_write('user', $dataToUpdate)`. Method ini otomatis melakukan _merge_ data sehingga session tetap sinkron tanpa perlu login ulang.
7. **Notification**: Berikan feedback redirect sukses/error yang konsisten.

---

### 🎨 Tugas Front-end (Mada)

Gunakan syntax Blade yang sudah ada, lalu modifikasi bagian berikut:

1. **Inisialisasi Alpine.js**: Pada fungsi `profileHandler()`, inisialisasi `avatarUrl` dan `ktpUrl` menggunakan PHP:
   - `avatarUrl`: `{{ $user['foto_profil'] ? url('/file/profiles/' . $user['foto_profil']) : "https://ui-avatars.com/api/?name=" . urlencode($user['nama_lengkap']) . "&background=eff6ff&color=1e40af&size=256&bold=true" }}`
   - `ktpUrl`: `{{ $user['foto_ktp'] ? url('/file/ktp/' . $user['foto_ktp']) : 'null' }}`
2. **Binding Value**: Ganti nilai statis pada input (`value="Nabil"`, dll) menjadi dinamis: `value="{{ $user['nama_lengkap'] }}"`.
3. **Select Option**: Gunakan logic `@if` untuk menentukan option mana yang memiliki atribut `selected` pada field Jenis Kelamin.
4. **Form Header**: Pastikan `@csrf` dan `enctype="multipart/form-data"` terpasang.
5. **Validation Errors**: Tambahkan span error di bawah setiap input menggunakan `@if(has_error('...'))`.
6. **Loading State**: Manfaatkan variabel `loadingAvatar` di Alpine.js untuk memberikan feedback saat user mengganti foto.