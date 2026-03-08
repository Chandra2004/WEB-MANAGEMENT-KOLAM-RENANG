# 📜 Kontrak API - Group DASHBOARD (ADMIN)

Dokumen ini menjelaskan spesifikasi antarmuka (interface) antara Back-end dan Front-end untuk endpoint-endpoint yang dapat diakses **HANYA** oleh **ADMIN** yang sudah terautentikasi.

---

## 👥 Pembagian Peran

| Peran               | Penanggung Jawab | Tanggung Jawab Utama                                                                                              |
| :------------------ | :--------------- | :---------------------------------------------------------------------------------------------------------------- |
| **Front-end** | **Mada**   | • Mengirim request ke API.`<br>`• Menerima & mengolah response.`<br>`• Menampilkan data (UI/UX).           |
| **Back-end**  | **Farrel** | • Menyediakan endpoint API.`<br>`• Mengolah business process & database.`<br>`• Mengirim response standar. |

---

## 🔔 Struktur Response Dasar

Setiap response API (terutama GET) memiliki struktur dasar yang mencakup notifikasi.

### Object `notification`

Field ini **opsional** (bisa `null`). Jika ada, strukturnya sebagai berikut:

**Status: Success**

```json
{
  "notification": {
    "status": "success",
    "message": "Data berhasil disimpan",
    "expires_at": 1770955896,
    "duration": 10000
  }
}
```

**Status: Warning**

```json
{
  "notification": {
    "status": "warning",
    "message": "Sesi Anda akan segera berakhir",
    "expires_at": 1770956016,
    "duration": 10000
  }
}
```

**Status: Error**

```json
{
  "notification": {
    "status": "error",
    "message": "Terjadi kesalahan server",
    "expires_at": 1770956016,
    "duration": 10000
  }
}
```

---

## ⚠️ Aturan Umum Response API

Harap perhatikan aturan berikut untuk **SEMUA** endpoint:

1. **Field Timestamp**: Field `created_at`, `updated_at` **WAJIB DIHILANGKAN (HIDE)** dari response JSON.
2. **Field Relasi (Foreign Keys)**:
   Kolom ID relasi harus **disembunyikan** jika data relasinya sudah dimuat (eager loaded).
   - _Contoh_: Jika return data user beserta role-nya, maka `users.uid_role` harus di-hide karena validasinya bisa menggunakan object `role.uid` yang disertakan.
   - _Tujuannya_: Response lebih bersih dan tidak redundan.

---

## 🔐 Group: DASHBOARD (ADMIN)

Semua endpoint di bawah ini dapat diakses **HANYA** oleh **ADMIN** yang sudah terautentikasi.

### Tabel Ringkasan Endpoint

| No | Method | Endpoint                                                               | Controller                 | Method                        | Roles Permitted                  |
| :-: | :----: | :--------------------------------------------------------------------- | :------------------------- | :---------------------------- | :------------------------------- |
| 1 |  GET  | `/{role}/dashboard`                                                  | `DashboardControlller`   | `dashboard`                 | `admin`, `coach`, `member` |
| 2 |  GET  | `/{role}/dashboard/management-category`                              | `CategoryController`     | `category`                  | `admin`, `coach`             |
| 3 |  POST  | `/{role}/{uidUser}/dashboard/management-category/create/process`     | `CategoryController`     | `categoryCreateProcess`     | -                                |
| 4 |  POST  | `/{role}/{uidUser}/dashboard/management-category/edit/process`       | `CategoryController`     | `categoryEditProcess`       | -                                |
| 5 |  POST  | `/{role}/{uidUser}/dashboard/management-category/delete/process`     | `CategoryController`     | `categoryDeleteProcess`     | -                                |
| 6 |  GET  | `/{role}/dashboard/management-event`                                 | `EventController`        | `event`                     | `admin`, `coach`             |
| 7 |  POST  | `/{role}/{uidUser}/dashboard/management-event/create/process`        | `EventController`        | `eventCreateProcess`        | -                                |
| 8 |  POST  | `/{role}/{uidUser}/dashboard/management-event/edit/process`          | `EventController`        | `eventEditProcess`          | -                                |
| 9 |  POST  | `/{role}/{uidUser}/dashboard/management-event/delete/process`        | `EventController`        | `eventDeleteProcess`        | -                                |
| 10 |  GET  | `/{role}/dashboard/management-registration`                          | `RegistrationController` | `registration`              | `admin`, `coach`             |
| 11 |  POST  | `/{role}/{uidUser}/dashboard/management-registration/create/process` | `RegistrationController` | `registrationCreateProcess` | -                                |
| 12 |  POST  | `/{role}/{uidUser}/dashboard/management-registration/edit/process`   | `RegistrationController` | `registrationEditProcess`   | -                                |
| 13 |  POST  | `/{role}/{uidUser}/dashboard/management-registration/delete/process` | `RegistrationController` | `registrationDeleteProcess` | -                                |
| 14 |  GET  | `/{role}/dashboard/management-user`                                  | `UserController`         | `user`                      | `admin`                        |
| 15 |  POST  | `/{role}/{uidUser}/dashboard/management-user/create/process`         | `UserController`         | `userCreateProcess`         | -                                |
| 16 |  POST  | `/{role}/{uidUser}/dashboard/management-user/edit/process`           | `UserController`         | `userEditProcess`           | -                                |
| 17 |  POST  | `/{role}/{uidUser}/dashboard/management-user/delete/process`         | `UserController`         | `userDeleteProcess`         | -                                |
| 18 |  GET  | `/{role}/dashboard/management-coach`                                 | `CoachController`        | `coach`                     | `admin`                        |
| 19 |  POST  | `/{role}/{uidUser}/dashboard/management-coach/create/process`        | `CoachController`        | `coachCreateProcess`        | -                                |
| 20 |  POST  | `/{role}/{uidUser}/dashboard/management-coach/edit/process`          | `CoachController`        | `coachEditProcess`          | -                                |
| 21 |  POST  | `/{role}/{uidUser}/dashboard/management-coach/delete/process`        | `CoachController`        | `coachDeleteProcess`        | -                                |
| 22 |  GET  | `/{role}/dashboard/management-member`                                | `MemberController`       | `member`                    | `admin`, `coach`             |
| 23 |  POST  | `/{role}/{uidUser}/dashboard/management-member/create/process`       | `MemberController`       | `memberCreateProcess`       | -                                |
| 24 |  POST  | `/{role}/{uidUser}/dashboard/management-member/edit/process`         | `MemberController`       | `memberEditProcess`         | -                                |
| 25 |  POST  | `/{role}/{uidUser}/dashboard/management-member/delete/process`       | `MemberController`       | `memberDeleteProcess`       | -                                |
| 26 |  GET  | `/{role}/dashboard/notifications`                                    | `NotificationController` | `notification`              | `admin`, `coach`, `member` |
| 27 |  POST  | `/{role}/{uidUser}/dashboard/notifications/edit/process`             | `NotificationController` | `notificationEditProcess`   | -                                |
| 28 |  POST  | `/{role}/{uidUser}/dashboard/notifications/delete/process`           | `NotificationController` | `notificationDeleteProcess` | -                                |
| 29 |  GET  | `/{role}/dashboard/export-reports`                                   | `DashboardControlller`   | `report`                    | `admin`, `coach`             |
| 30 |  GET  | `/{role}/dashboard/my-profile`                                       | `MyProfileController`    | `myProfile`                 | `admin`, `coach`, `member` |
| 31 |  POST  | `/{role}/{uidUser}/dashboard/my-profile/edit/process`                | `MyProfileController`    | `myProfileEditProcess`      | -                                |
| 32 |  GET  | `/{role}/{uidUser}/dashboard/logout`                                 | `AuthController`         | `logout`                    | `admin`, `coach`, `member` |

---

## 📊 Endpoint: Dashboard

**URL**: `GET /admin/dashboard`

### Response JSON (untuk Role Admin)

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
  ],
  "totalAnggota": 3,
  "eventAktif": 36,
  "antreanValidasi": 2,
  "members": [
    {
      "id_user": 1,
      "uid": "4e8ada26-3a11-473e-852e-b402a35328e3",
      "tanggal_lahir": null,
      "nama_klub": null,
      "foto_profil": null
    },
    {
      "id_user": 2,
      "uid": "affdd74a-efc7-49ef-a2a3-21dbc01abf08",
      "tanggal_lahir": null,
      "nama_klub": null,
      "foto_profil": null
    },
    {
      "id_user": 3,
      "uid": "a0f3d96e-ca9f-49bd-92ad-30e875fe5b69",
      "tanggal_lahir": null,
      "nama_klub": null,
      "foto_profil": null
    }
  ]
}
```

### 📝 Tugas untuk Back-end (Farrel)

**File**: `/app/Http/Controllers/DashboardControlller.php`

1. Buka controller `DashboardControlller.php`. Method `dashboard()` sudah disiapkan untuk me-return data dasar.
2. Tugas Anda adalah melengkapi data spesifik untuk **admin** di dalam method `getAdminData()`.
3. Method `getAdminData()` harus me-return sebuah array yang berisi:
   * `totalAnggota`: Jumlah total semua user dari tabel `User`.
   * `eventAktif`: Jumlah event yang statusnya `berjalan`.
   * `antreanValidasi`: Jumlah pendaftaran yang statusnya `menunggu`.
   * `members`: 5 user terbaru (hanya kolom `id_user`, `uid`, `tanggal_lahir`, `nama_klub`, `foto_profil`).
4. Pastikan method `dashboard()` menggabungkan data dari `getAdminData()` ini saat role user adalah 'admin'.

### 🎨 Tugas untuk Front-end (Mada)

**File**: `/resources/views/dashboard/admin/dashboard.blade.php`

1. **Ganti Data Statis**: Ganti data statis (jumlah anggota, event, dll) dengan data dari JSON.
2. **Looping Member**: Lakukan loop pada array `members` untuk menampilkan daftar "Anggota Baru".
3. **Logika Gambar Profil**: Untuk setiap member, jika `foto_profil` `null`, tampilkan inisial. Jika ada, tampilkan gambar dari `{{ url('/file/users/' . $member['foto_profil']) }}`.

---

## 📁 Endpoint: Management Category

**URL**: `GET /admin/dashboard/management-category`

### Response JSON

```json
{
  "notification": null,
  "title": "Manajemen Kategori | Khafid Swimming Club (KSC) - Official Website",
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
  ],
  "categories": [
    {
      "id": 1,
      "uid": "c03457b9-f383-4bc5-9fb5-436d6cfb82d1",
      "nama_kategori": "Franz Stark",
      "slug_kategori": null
    },
    {
      "id": 2,
      "uid": "f3669fcf-db35-45a7-9099-05adf8e93bce",
      "nama_kategori": "Lauren Larkin",
      "slug_kategori": null
    },
    {
      "id": 3,
      "uid": "925add50-abd1-4fb3-b35c-40973210f653",
      "nama_kategori": "Rogelio Conroy",
      "slug_kategori": null
    }
  ]
}
```

### 📝 Tugas untuk Back-end (Farrel)

**File**: `/app/Http/Controllers/CategoryController.php`

#### 1. Menampilkan Data Kategori (`category` method)

* Tugas: Dalam `CategoryController`, method `category` harus mengambil semua data dari model `Category` dan menambahkannya ke response JSON dengan key `categories`.

#### 2. Proses CUD (Create, Update, Delete) Kategori

* **ATURAN WAJIB (Try-Catch)**: Untuk semua proses di bawah (Create, Update, Delete), pemanggilan method dari **Controller** ke **Model** **WAJIB** dibungkus dalam blok `try-catch`. Ini bertujuan untuk menangkap `Exception` yang mungkin dilempar oleh Model (misal: data duplikat, data tidak ditemukan, error database) dan memberikan response notifikasi yang sesuai kepada pengguna.
* **Rekomendasi Otorisasi**: Buat satu method di `UserModel` atau `AuthModel` yang bisa digunakan di semua controller. Contoh:

  ```php
  // Di dalam model User.php
  public static function authorizeAction(string $role, string $uidUser): bool
  {
      $user = Helper::session_get('user');
      return $user['nama_role'] === $role && $user['uid'] === $uidUser;
  }
  ```

---

**A. CREATE - `categoryCreateProcess`**

**Endpoint**: `POST /{role}/{uidUser}/dashboard/management-category/create/process`

1. **Validasi Request**: Buat `CategoryRequest.php`. Definisikan `rules` untuk `nama_kategori`: `required|string|max:255`.
2. **Otorisasi**: Di controller, panggil `User::authorizeAction($role, $uidUser)`. Jika `false`, hentikan proses (return 403 Forbidden).
3. **Logika Model (buat `createCategory`)**: Pindahkan logika ke `Category.php`.
   * **Uniqueness Check**: Sebelum `INSERT`, periksa apakah `nama_kategori` (case-insensitive) sudah ada. Jika ya, `throw new \Exception("Nama kategori sudah digunakan.");`.
   * **Data Preparation**: Siapkan `uid` (`Helper::uuid()`) dan `slug_kategori` (`Helper::slugify()`).
   * **Database Transaction**: Gunakan transaction. Jika gagal, `rollback` dan `throw Exception`.
4. **Controller**: Panggil `Category::createCategory($request->validated())` di dalam blok `try-catch`.

**B. UPDATE - `categoryEditProcess`**

**Endpoint**: `POST /{role}/{uidUser}/dashboard/management-category/edit/process`

1. **Validasi Request**: Gunakan `CategoryRequest`. Form harus mengirimkan `uid` kategori.
2. **Otorisasi**: Sama seperti proses create.
3. **Logika Model (buat `updateCategory`)**: Pindahkan logika ke `Category.php`.
   * **Find Category**: Cari kategori berdasarkan `uid`. Jika tidak ada, `throw new \Exception("Kategori tidak ditemukan.");`.
   * **Uniqueness Check**: Pastikan `nama_kategori` yang baru tidak duplikat dengan data lain.
   * **Data Preparation**: Update `nama_kategori` dan `slug_kategori`.
   * **Database Transaction**: Gunakan transaction untuk query `UPDATE`.
4. **Controller**: Panggil `Category::updateCategory($request->uid, $request->validated())` di dalam `try-catch`.

**C. DELETE - `categoryDeleteProcess`**

**Endpoint**: `POST /{role}/{uidUser}/dashboard/management-category/delete/process`

1. **Validasi Request**: Form hanya perlu mengirim `uid` kategori.
2. **Otorisasi**: Sama seperti proses create.
3. **Logika Model (buat `deleteCategory`)**:
   * **Find Category**: Cari kategori berdasarkan `uid`. Jika tidak ada, `throw new \Exception("Kategori tidak ditemukan.");`.
   * **Database Transaction**: Gunakan transaction untuk query `DELETE`.
4. **Controller**: Panggil `Category::deleteCategory($request->uid)` di dalam `try-catch`.

### 🎨 Tugas untuk Front-end (Mada)

**File**: `/resources/views/dashboard/general/category.blade.php`

1. **Looping Data**: Gunakan `@foreach($categories as $category)` untuk menampilkan setiap kategori dalam tabel.
2. **Form & Modal Integration**:

   * **Penting**: Semua form `POST` harus menyertakan `@csrf`.
   * **Create Form**: Atur `action` ke:
     ```php
     action="{{ url('/' . $user['nama_role'] . '/' . $user['uid'] . '/dashboard/management-category/create/process') }}"
     ```
   * **Update Form (di dalam Modal)**:
     * Tombol "Edit" harus membuka modal yang spesifik: `data-target="#editModal-{{ $category['uid'] }}"`.
     * `action` form di dalam modal:
       ```php
       action="{{ url('/' . $user['nama_role'] . '/' . $user['uid'] . '/dashboard/management-category/edit/process') }}"
       ```
     * Sertakan hidden input untuk UID: `<input type="hidden" name="uid" value="{{ $category['uid'] }}">`.
     * Input `nama_kategori` harus menampilkan data yang ada: `value="{{ $category['nama_kategori'] }}"`.
   * **Delete Form (di dalam Modal)**:
     * Tombol "Delete" membuka modal konfirmasi: `data-target="#deleteModal-{{ $category['uid'] }}"`.
     * `action` form di dalam modal:
       ```php
       action="{{ url('/' . $user['nama_role'] . '/' . $user['uid'] . '/dashboard/management-category/delete/process') }}"
       ```
     * Sertakan hidden input untuk UID: `<input type="hidden" name="uid" value="{{ $category['uid'] }}">`.

---

## 🎪 Endpoint: Management Event

**URL**: `GET /{role}/dashboard/management-event`

### Response JSON (GET)

```json
{
  "notification": null,
  "title": "Manajemen Event | KSC - Official Website",
  "user": { "..." },
  "totalUnreadNotification": 1,
  "unReadNotification": [ "..." ],
  "events": [
    {
      "id": 24,
      "uid": "acae4812-119a-4a32-91de-7b4e71f8765e",
      "banner_event": "gambar_renang_11.webp",
      "nama_event": "Kejuaraan Renang Bima",
      "deskripsi_event": "Deskripsi singkat...",
      "lokasi_event": "Gg. Gremet No. 600, Bau-Bau 46933, Gorontalo",
      "tanggal_event": "2026-10-27",
      "biaya_event": "176837.00",
      "status_event": "berjalan",
      "tipe_event": "gratis",
      "nama_author": "admin cuyy",
      "nama_kategori": "Franz Stark"
    }
  ],
  "categories": [
    { "uid": "c03457b9-f383-4bc5-9fb5-436d6cfb82d1", "nama_kategori": "Franz Stark" }
  ],
  "users": [
    { "uid": "4e8ada26-3a11-473e-852e-b402a35328e3", "nama_lengkap": "admin cuyy" }
  ]
}
```

### 📝 Tugas untuk Back-end (Farrel)

**File**: `/app/Http/Controllers/EventController.php` dan `app/Models/Event.php`.

#### 1. Menampilkan Data Event (`event` method)

* Di `EventController`, method `event()` harus mengembalikan data JSON sesuai struktur di atas.
* Buat query untuk mengambil **semua event** dengan detailnya. Lakukan `JOIN` tabel `events` dengan `users` (untuk `nama_author`) dan `categories` (untuk `nama_kategori`).
* Sertakan juga data **semua `categories`** (hanya `uid` dan `nama_kategori`) dan **semua `users`** (hanya `uid` dan `nama_lengkap`) untuk mengisi form.
* Pastikan response JSON memiliki keys: `events`, `categories`, dan `users`.

#### 2. Proses CUD (Create, Update, Delete) Event

* **ATURAN WAJIB (Try-Catch)**: Bungkus semua pemanggilan method dari Controller ke Model dalam `try-catch`.

---

**A. CREATE - `eventCreateProcess`**

**Endpoint**: `POST /{role}/{uidUser}/dashboard/management-event/create/process`

1. **Validasi Request**: Buat `EventRequest.php` dengan rules:
   * `nama_event`: `required|string|max:255`
   * `uid_kategori`: `required|exists:categories,uid`
   * `uid_author`: `required|exists:users,uid`
   * `deskripsi_event`, `tanggal_event`, `lokasi_event`, `tipe_event`, `biaya_event`: semua `required`.
   * `banner_event`: `required|image|mimes:jpg,jpeg,png|max:2048`
2. **Otorisasi**: Gunakan `User::authorizeAction($role, $uidUser)`.
3. **Logika Model (`createEvent`)**: Di `Event.php`.
   * **File Handling**: Proses upload `banner_event`. Simpan file dan nama filenya.
   * **Data Preparation**: Siapkan `uid` dan `slug_event`.
   * **Database Transaction**: Gunakan transaction untuk `INSERT`. Jika gagal, `throw Exception` dan hapus file yang sudah ter-upload.
4. **Controller**: Panggil `Event::createEvent($request)` di dalam `try-catch`.

**B. UPDATE - `eventEditProcess`**

**Endpoint**: `POST /{role}/{uidUser}/dashboard/management-event/edit/process`

1. **Validasi Request**: `banner_event` bisa `nullable`.
2. **Otorisasi**: Sama.
3. **Logika Model (`updateEvent`)**:
   * **Find Event**: Cari event berdasarkan `uid`.
   * **File Handling**: Jika ada banner baru, upload, dan **hapus file lama**.
   * **Database Transaction**: Gunakan transaction untuk `UPDATE`.
4. **Controller**: Panggil `Event::updateEvent($request->uid, $request)` di dalam `try-catch`.

**C. DELETE - `eventDeleteProcess`**

**Endpoint**: `POST /{role}/{uidUser}/dashboard/management-event/delete/process`

1. **Otorisasi**: Sama.
2. **Logika Model (`deleteEvent`)**:
   * **Find Event**: Cari event berdasarkan `uid`.
   * **File Handling**: **Hapus file `banner_event`** dari storage.
   * **Database Transaction**: Gunakan transaction untuk `DELETE`.
3. **Controller**: Panggil `Event::deleteEvent($request->uid)` di dalam `try-catch`.

### 🎨 Tugas untuk Front-end (Mada)

**File**: `/resources/views/dashboard/general/event.blade.php` (buat jika belum ada).

1. **Tabel Data**: Buat tabel untuk data `events` dengan kolom: Banner, Nama Event, Kategori (`nama_kategori`), Author (`nama_author`), Tanggal, Lokasi, Biaya, Status, Aksi.
2. **Form & Modal Integration**:

   * Buat Modal untuk "Tambah/Edit Event".
   * **Isi Form**: Form harus punya input untuk semua field di `EventRequest`.
     * **Author**: `<select name="uid_author">`, loop data `users` sebagai options.
     * **Kategori**: `<select name="uid_kategori">`, loop data `categories`.
     * **Banner**: `<input type="file">`. Saat edit, tampilkan banner sekarang.
   * **Action URL**: Atur `action` form secara dinamis (termasuk `@csrf`):
     * **Create**: `{{ url('/' . $user['nama_role'] . '/' . $user['uid'] . '/dashboard/management-event/create/process') }}`
     * **Update**: `{{ url('/' . $user['nama_role'] . '/' . $user['uid'] . '/dashboard/management-event/edit/process') }}` (sertakan hidden input `uid`).
     * **Delete**: `{{ url('/' . $user['nama_role'] . '/' . $user['uid'] . '/dashboard/management-event/delete/process') }}` (sertakan hidden input `uid`).

---

# 🎟️ Endpoint: Management Registration

**URL**: `GET /{role}/dashboard/management-registration`

### Response JSON (GET) - STRUKTUR TARGET

*Catatan: Bagian ini mendefinisikan kontrak API jika endpoint ini diakses sebagai API. Untuk tugas saat ini, Backend akan mengirim data langsung ke View.*

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
  ],
  "registrationEvents": [
    {
      "uid": "071328ee-b69f-406c-b432-0991e91cf571",
      "nama_event": "Kejuaraan Renang Tasikmalaya",
      "biaya_event": "178359.00",
      "kuota_peserta": null,
      "tipe_event": "berbayar",
      "status_event": "ditutup",
      "nama_author": "pelatih kawandd",
      "nama_kategori": "Lauren Larkin",
      "registrationMember_count": 1,
      "registrationMember": [
        {
          "uid": "f267536f-6ddc-49f8-813d-4b8b0fc214c9",
          "uid_event": "071328ee-b69f-406c-b432-0991e91cf571",
          "uid_user": "4e8ada26-3a11-473e-852e-b402a35328e3",
          "status": "menunggu",
          "tanggal_registrasi": "1973-07-03",
          "user": {
            "id_user": 1,
            "uid": "4e8ada26-3a11-473e-852e-b402a35328e3",
            "nama_lengkap": "admin cuyy"
          },
          "payment": {
            "id": 1,
            "uid": "a6b17179-93e2-47fc-9f4e-fbf291b8991b",
            "uid_registration": "f267536f-6ddc-49f8-813d-4b8b0fc214c9",
            "total_bayar": null,
            "metode_pembayaran": "Baileytown",
            "status_pembayaran": "menunggu",
            "catatan_admin": null,
            "tanggal_pembayaran": "2016-02-15 00:00:00",
            "bukti_pembayaran": "Lane Luettgen I",
            "created_at": "2026-02-21 16:36:27",
            "updated_at": "2026-02-21 16:36:27"
          }
        }
      ]
    },
    {
      "uid": "ee84c094-ab67-4897-9d1d-fc18ef3a3e88",
      "nama_event": "Kejuaraan Renang Ternate",
      "biaya_event": "402320.00",
      "kuota_peserta": null,
      "tipe_event": "gratis",
      "status_event": "ditunda",
      "nama_author": "admin cuyy",
      "nama_kategori": "Rogelio Conroy",
      "registrationMember_count": 2,
      "registrationMember": [
        {
          "uid": "13f7c083-11f8-4e2b-b5ba-a0fa5e64b883",
          "uid_event": "ee84c094-ab67-4897-9d1d-fc18ef3a3e88",
          "uid_user": "affdd74a-efc7-49ef-a2a3-21dbc01abf08",
          "status": "diterima",
          "tanggal_registrasi": "1970-03-27",
          "user": null,
          "payment": null
        },
        {
          "uid": "dac54afc-17b0-4ea1-91fe-eda7661f99f1",
          "uid_event": "ee84c094-ab67-4897-9d1d-fc18ef3a3e88",
          "uid_user": "affdd74a-efc7-49ef-a2a3-21dbc01abf08",
          "status": "ditolak",
          "tanggal_registrasi": "1998-07-10",
          "user": null,
          "payment": null
        }
      ]
    }
  ],
  "events": [
    {
      "uid": "071328ee-b69f-406c-b432-0991e91cf571",
      "nama_event": "Kejuaraan Renang Tasikmalaya"
    },
    {
      "uid": "ee84c094-ab67-4897-9d1d-fc18ef3a3e88",
      "nama_event": "Kejuaraan Renang Ternate"
    }
  ],
  "members": [
    {
      "id_user": 3,
      "uid": "a0f3d96e-ca9f-49bd-92ad-30e875fe5b69",
      "nama_lengkap": "member boyy",
      "email": "member@gmail.com",
    },
    {
      "id_user": 4,
      "uid": "a49f0623-9da1-4bb4-9d31-6c990729edc4",
      "nama_lengkap": "film chandra",
      "email": "filmnyachandra@gmail.com",
    }
  ]
}
```

### 📝 Tugas untuk Back-end (Farrel)

**(REVISI TUGAS - LEBIH DETAIL)**
Peran Anda adalah menyiapkan data untuk View. Method `registration()` di `RegistrationController.php` harus melakukan query yang kompleks dan meneruskan hasilnya ke Blade. Ikuti langkah-langkah ini secara berurutan.

#### Langkah 0: Prasyarat - Validasi Relasi Model

Pastikan method relasi ini ada dan sudah benar di dalam file Model masing-masing. Ini krusial untuk *eager loading*.

1. **File `app/Models/Event.php`**:

   * Buat method `public function registrationMember()`.
   * Ini adalah relasi `hasMany` ke `Registration::class` (`'uid_event'`, `'uid'`).
   * **Penting**: Rantai dengan `->select([...])` untuk hanya mengambil kolom: `uid`, `uid_event`, `uid_user`, `status`, `tanggal_registrasi`.
2. **File `app/Models/Registration.php`**:

   * Buat method `public function user()`.
   * Ini adalah relasi `belongsTo` ke `User::class` (`'uid_user'`, `'uid'`).
   * Rantai dengan `->select([...])` untuk hanya mengambil: `id_user`, `uid`, `nama_lengkap`.
   * Buat method `public function payment()`.
   * Ini adalah relasi `hasOne` ke `Payment::class` (`'uid_registration'`, `'uid'`). Relasi ini tidak perlu `select` karena kita butuh semua datanya.

#### Langkah 1: Controller - Menyiapkan Data Statis & Notifikasi

Di dalam method `registration()`, siapkan array dasar untuk diteruskan ke view.

* Buat variabel `$data_untuk_view`.
* Isi key-key awal: `'notification'`, `'title'`, `'user'`. Anda bisa menggunakan `Helper` atau mengambil data dari sesi seperti di controller lain.
* Isi key `'totalUnreadNotification'` dengan melakukan query `Notification::query()->...->count()`.
* Isi key `'unReadNotification'` dengan query `Notification::query()->...->all()`.

#### Langkah 2: Controller - Query untuk `$registrationEvents`

Ini adalah query utama. Bangun secara bertahap:

1. Mulai dengan `Event::query()`.
2. Gunakan `->select()` untuk memilih kolom secara eksplisit:
   * `events.uid`, `events.nama_event`, `events.biaya_event`, dll.
   * Gunakan alias untuk nama author: `'users.nama_lengkap AS nama_author'`.
   * Sertakan `categories.nama_kategori`.
3. Gunakan `->join('users', ...)` untuk menyambungkan `events.uid_author` ke `users.uid`.
4. Gunakan `->join('categories', ...)` untuk menyambungkan `events.uid_kategori` ke `categories.uid`.
5. Tambahkan *eager loading* untuk relasi bersarang: `->with(['registrationMember.user', 'registrationMember.payment'])`.
6. Sertakan `->withCount(['registrationMember'])` untuk mendapatkan `registrationMember_count` secara efisien.
7. Untuk mencocokkan data contoh, filter hasilnya dengan `->where('events.uid', ...)` dan `->orWhere('events.uid', ...)` untuk dua event yang ada di JSON.
8. Eksekusi dengan `->all()` dan masukkan hasilnya ke `$data_untuk_view['registrationEvents']`.

#### Langkah 3: Controller - Query & Transformasi untuk `$events`

1. Buat query **baru** pada `Event::query()`.
2. Pilih kolom `uid`, `nama_event`, dan **`tipe_event`** (penting untuk transformasi).
3. (Opsional) Gunakan `->limit(2)` untuk mencocokkan data contoh.
4. Ambil hasilnya.
5. **Lakukan Transformasi**: Gunakan `array_map` atau `foreach` pada hasil query. Untuk setiap item, tambahkan key `is_paid` (`true` jika `tipe_event` adalah `'berbayar'`). Kemudian, hapus key `tipe_event` dari item tersebut.
6. Masukkan hasil transformasi ke `$data_untuk_view['events']`.

#### Langkah 4: Controller - Query untuk `$allUsers`

1. Buat query **baru** pada `User::query()`.
2. Gunakan `->select()` untuk hanya mengambil `uid`, `nama_lengkap`, dan `email`.
3. Eksekusi dengan `->all()` dan masukkan hasilnya ke `$data_untuk_view['allUsers']` (sesuaikan key dengan `solo.md`, bukan `members`).

#### Langkah 5: Controller - Meneruskan Data ke View

* Sebagai baris terakhir di method Anda, panggil `return View::render('dashboard.general.registration', $data_untuk_view);`.

### 🎨 Tugas untuk Front-end (Mada)

**(REVISI TUGAS - LEBIH DETAIL)**

Halo Mada, berikut adalah panduan implementasi yang jauh lebih detail. Anda akan menerima variabel PHP dari Backend (`$registrationEvents`, `$events`, `$allUsers`, dll.). Tugas Anda adalah membuat seluruh halaman menjadi dinamis.

#### Bagian 1: Daftar Event Utama (Accordion)

1. **Looping Event Utama**:

   * Cari `div` dengan `class="space-y-4"`.
   * Hapus kedua `div` anak statis yang ada di dalamnya (yang merepresentasikan event).
   * Gantilah dengan sebuah perulangan: `@foreach($registrationEvents as $event)`.
2. **Render Event Berdasarkan Kondisi**:

   * Di dalam `@foreach`, gunakan `@if($event['registrationMember_count'] > 0)`.
   * **Jika `true`**: Salin struktur HTML dari event pertama (yang aktif, dengan accordion).
   * **Jika `false`**: Salin struktur HTML dari event kedua (yang `grayscale`). Cukup isi nama dan UID event di sini, lalu lanjutkan ke iterasi berikutnya dengan `@continue`.
3. **Dinamisasi Header Accordion (untuk event aktif)**:

   * Ganti `@click` menjadi `@click="openEvent = (openEvent === '{{ $event['uid'] }}' ? null : '{{ $event['uid'] }}')"`.
   * Ganti nama event: `<h3>{{ $event['nama_event'] }}</h3>`.
   * Ganti UID event: `<p>{{ $event['uid'] }}</p>`.
   * Ganti jumlah pendaftar: `<span>{{ $event['registrationMember_count'] }} Peserta</span>`.
   * Update `:class` pada ikon chevron menjadi `:class="openEvent === '{{ $event['uid'] }}' ? 'rotate-180' : ''"`.
   * Update `x-show` untuk konten accordion menjadi `x-show="openEvent === '{{ $event['uid'] }}'"`.

#### Bagian 2: Tabel Pendaftar (di dalam Accordion)

1. **Looping Pendaftar**:

   * Di dalam `<tbody>`, hapus baris `<tr>` statis.
   * Gantilah dengan perulangan: `@foreach($event['registrationMember'] as $member)`.
2. **Dinamisasi Sel Tabel (`<td>`) per Pendaftar**:

   * **Nama Peserta**: Ganti inisial, nama, dan UID dengan data dari `{{ $member['user']['nama_lengkap'] }}` dan `{{ $member['user']['uid'] }}`.
   * **Tanggal Daftar**: Ganti dengan `{{ \Carbon\Carbon::parse($member['tanggal_registrasi'])->format('d M Y') }}`.
   * **Status**: Gunakan `@if/@elseif` pada `{{ $member['status'] }}` untuk mengubah class warna badge (misal: `bg-yellow-100` untuk 'menunggu').
   * **Tombol Pembayaran**: Bungkus tombol dengan `@if($member['payment'])`. Jika tidak, tampilkan `<span>N/A</span>`. Pada tombol, tambahkan atribut `data-payment-details='{{ json_encode($member['payment']) }}'`.
   * **Tombol Aksi**: Tambahkan atribut `data-member-uid="{{ $member['uid'] }}"` dan `data-member-info='{{ json_encode($member) }}'` pada tombol Edit/Hapus.

#### Bagian 3: Modal-Modal (Gunakan Javascript)

Gunakan **satu instance** dari setiap modal, dan pakai Javascript untuk mengisi datanya saat tombol aksi diklik.

1. **Modal "Tambah Registrasi"**:

   * **Searchable Select (User)**: Di `x-data`, ganti array `users` dengan `users: @json($allUsers)`. Pastikan `filteredUsers` mencari di `nama_lengkap` dan `x-text` menggunakan `user.nama_lengkap`.
   * **Select Event**: Hapus `<option>` statis, ganti dengan `@foreach($events as $form_event)`. Pada `<option>`, tambahkan `data-is-paid` dari `$form_event['is_paid']`.
   * **Update Alpine Logic**: Perbarui `checkEventType` untuk membaca `data-is-paid`.
2. **Modal "Edit Registrasi"**:

   * Tangkap klik, ambil `data-member-info`, lalu isi nama peserta, event, dan status `select` di modal.
   * Set `action` form secara dinamis: `/.../edit/` + `member.uid`.
3. **Modal "Detail Pembayaran"**:

   * Tangkap klik, ambil `data-payment-details`, lalu isi semua info pembayaran di modal (Metode, Total, Waktu, `src` gambar, `href` link).
   * Set `select` validasi pembayaran dengan status dari data payment.
4. **Modal "Hapus Registrasi"**:

   * Tangkap klik, ambil `data-member-uid`.
   * Set `action` form secara dinamis: `/.../delete/` + `uid`.
