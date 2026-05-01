# 📜 Kontrak API - Group GUEST (Public Endpoints)

Dokumen ini menjelaskan spesifikasi antarmuka (interface) antara Back-end dan Front-end untuk endpoint-endpoint yang dapat diakses tanpa autentikasi (public access).

---

## 👥 Pembagian Peran

| Peran         | Penanggung Jawab | Tanggung Jawab Utama                                                                                       |
| :------------ | :--------------- | :--------------------------------------------------------------------------------------------------------- |
| **Front-end** | **Mada**         | • Mengirim request ke API.`<br>`• Menerima & mengolah response.`<br>`• Menampilkan data (UI/UX).           |
| **Back-end**  | **Farrel**       | • Menyediakan endpoint API.`<br>`• Mengolah business process & database.`<br>`• Mengirim response standar. |

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
   Kolom ID relasi harus **disembunyikan** jika data relasinya sudah dimuat (eager loaded). - _Contoh_: Jika return data user beserta role-nya, maka `users.uid_role` harus di-hide karena validasinya bisa menggunakan object `role.uid` yang disertakan. - _Tujuannya_: Response lebih bersih dan tidak redundan.

---

## 🔐 Group: GUEST (Public Endpoints)

Semua endpoint di bawah ini dapat diakses tanpa autentikasi (public access).

### Tabel Ringkasan Endpoint

| No  | Method | Endpoint          | Route Definition                                                                                                                     | Deskripsi                                        |
| :-: | :----: | :---------------- | :----------------------------------------------------------------------------------------------------------------------------------- | :----------------------------------------------- |
|  1  |  GET   | `/`               | `Router::add('GET', '/', HomepageController::class, 'index', [WAFMiddleware::class]);`                                               | Homepage - 2 highlight event + 10 galeri terbaru |
|  2  |  GET   | `/tentang-kami`   | `Router::add('GET', '/tentang-kami', HomepageController::class, 'tentangKami', [WAFMiddleware::class]);`                             | Tentang Kami - Menampilkan 3 mentor              |
|  3  |  GET   | `/pelatih`        | `Router::add('GET', '/pelatih', HomepageController::class, 'pelatih', [WAFMiddleware::class]);`                                      | Daftar Pelatih - Menampilkan semua mentor        |
|  4  |  GET   | `/lomba`          | `Router::add('GET', '/lomba', HomepageController::class, 'lomba', [WAFMiddleware::class]);`                                          | Agenda Kegiatan - Menampilkan semua event        |
|  5  |  GET   | `/galeri`         | `Router::add('GET', '/galeri', HomepageController::class, 'galeri', [WAFMiddleware::class]);`                                        | Galeri Foto - Menampilkan semua foto galeri      |
|  6  |  GET   | `/kontak`         | `Router::add('GET', '/kontak', HomepageController::class, 'kontak', [WAFMiddleware::class]);`                                        | Kontak - Halaman kontak                          |
|  7  |  POST  | `/kontak/process` | `Router::add('POST', '/kontak/process', HomepageController::class, 'kontakProcess', [WAFMiddleware::class, CsrfMiddleware::class]);` | Kontak - Proses kirim pesan                      |

---

## 🏠 Endpoint: Homepage

**URL**: `GET /`

### Response

Menampilkan 2 **highlight event** dan 10 **galeri terbaru**.

- untuk back-end data foto disimpan di direktori :

  ```bash
    untuk event :
      buat folder : 'private-uploads/banner-event/'
      cari file : 'FileController.php' cari method 'getAllowedFolders()' lalu tambahkan di array folder 'banner-event'

    untuk gallery :
      buat folder : 'private-uploads/galleries/'
      cari file : 'FileController.php' cari method 'getAllowedFolders()' lalu tambahkan di array folder 'galleries'
  ```

- untuk front-end data foto menggunakan :

  ```bash
    untuk event :
      {{ url("/file/banner-event/" . $event['foto_event']) }}

    untuk gallery :
      {{ url("/file/galleries/" . $gallery['foto_event']) }}
  ```

```json
{
  "notification": null,
  "title": "Khafid Swimming Club (KSC) - Official Website | Beranda",
  "events": [
    {
      "id": 1,
      "uid": "e6e9b4c1-fa79-4dc0-b1e0-9b5c1afb398a",
      "nama_event": "kuontol anda",
      "deskripsi": "Et reiciendis excepturi ut sed omnis est nihil. Molestias beatae quo consectetur. Id perferendis beatae suscipit ut amet sed ut.",
      "lokasi_event": "729 Dare Rapids Apt. 385\nFritschtown, FL 81269-8836",
      "waktu_event": "14:55:29",
      "tanggal_event": "2025-02-21",
      "tipe_event": "gratis",
      "biaya_event": "3263380.00",
      "status_event": "berjalan",
      "banner_event": "Accusantium laboriosam optio minus ratione et quod qui. Impedit neque enim et totam. Asperiores architecto laudantium autem quos ut sed. Aut harum at ut et qui voluptatem iusto.",
      "kategori": "Isabelle Beier DDS",
      "author": "Lisandro Padberg"
    }
    // ... s/d 2 item
  ],
  "galleries": [
    {
      "id": 12,
      "uid": "188f9051-dd4d-46d9-9de6-55bb4f9caab8",
      "foto_event": "Christiana Aufderhar V",
      "nama_foto": "Vella Quigley"
    }
    // ... s/d 10 item
  ]
}
```

---

## ℹ️ Endpoint: Tentang Kami

**URL**: `GET /tentang-kami`

### Response

Menampilkan daftar **3 mentor**.

- untuk back-end data foto disimpan di direktori :
  ```bash
    untuk mentor :
      buat folder : 'private-uploads/mentors/'
      cari file : 'FileController.php' cari method 'getAllowedFolders()' lalu tambahkan di array folder 'mentors'
  ```
- untuk front-end data foto menggunakan :
  ```bash
    untuk mentor :
      {{ url("/file/mentors/" . $mentor['foto_profil']) }}
  ```

```json
{
  "notification": null,
  "title": "Khafid Swimming Club (KSC) - Official Website | Tentang Kami",
  "mentors": [
    {
      "id_user": 2,
      "uid": "3a135818-c496-4a94-8bfc-a8d2ffc7b05b",
      "nama_lengkap": "Dr. Orlando Cole V",
      "email": "sage58@lind.com",
      "no_telepon": null,
      "tanggal_lahir": null,
      "nama_klub": null,
      "alamat": null,
      "foto_ktp": null,
      "foto_profil": null
    }
    // ... s/d 3 item
  ]
}
```

---

## 🏊 Endpoint: Pelatih (List Mentor)

**URL**: `GET /pelatih`

### Response

Sama dengan endpoint `/tentang-kami`, menampilkan daftar **semua mentor**.

- untuk back-end data foto disimpan di direktori :
  ```bash
    untuk mentor :
      buat folder : 'private-uploads/mentors/'
      cari file : 'FileController.php' cari method 'getAllowedFolders()' lalu tambahkan di array folder 'mentors'
  ```
- untuk front-end data foto menggunakan :
  ```bash
    untuk mentor :
      {{ url("/file/mentors/" . $mentor['foto_profil']) }}
  ```

```json
{
  "notification": null,
  "title": "Khafid Swimming Club (KSC) - Official Website | Daftar Pelatih",
  "mentors": [
    {
      "id_user": 2,
      "uid": "3a135818-c496-4a94-8bfc-a8d2ffc7b05b",
      "nama_lengkap": "Dr. Orlando Cole V",
      "email": "sage58@lind.com",
      "no_telepon": null,
      "tanggal_lahir": null,
      "nama_klub": null,
      "alamat": null,
      "foto_ktp": null,
      "foto_profil": null
    }
    // ... s/d sebanyak coach di database
  ]
}
```

---

## 📅 Endpoint: Events (List Event)

**URL**: `GET /lomba`

### Response

Menampilkan **seluruh lomba** yang tersedia.

- untuk back-end data foto disimpan di direktori :
  ```bash
    untuk event :
      buat folder : 'private-uploads/banner-event/'
      cari file : 'FileController.php' cari method 'getAllowedFolders()' lalu tambahkan di array folder 'banner-event'
  ```
- untuk front-end data foto menggunakan :
  ```bash
    untuk event :
      {{ url("/file/banner-event/" . $event['foto_event']) }}
  ```

```json
{
  "notification": null,
  "title": "Khafid Swimming Club (KSC) - Official Website | Agenda Kegiatan",
  "events": [
    {
      "id": 1,
      "uid": "e6e9b4c1-fa79-4dc0-b1e0-9b5c1afb398a",
      "nama_event": "kuontol anda",
      "deskripsi": "Et reiciendis excepturi ut sed omnis est nihil. Molestias beatae quo consectetur. Id perferendis beatae suscipit ut amet sed ut.",
      "lokasi_event": "729 Dare Rapids Apt. 385\nFritschtown, FL 81269-8836",
      "waktu_event": "14:55:29",
      "tanggal_event": "2025-02-21",
      "tipe_event": "gratis",
      "biaya_event": "3263380.00",
      "status_event": "berjalan",
      "banner_event": "Accusantium laboriosam optio minus ratione et quod qui. Impedit neque enim et totam. Asperiores architecto laudantium autem quos ut sed. Aut harum at ut et qui voluptatem iusto.",
      "kategori": "Isabelle Beier DDS",
      "author": "Lisandro Padberg"
    }
    // ... s/d sebanyak data events
  ]
}
```

---

## 🖼️ Endpoint: Galeri

**URL**: `GET /galeri`

### Response

Menampilkan **seluruh foto galeri**.

- untuk back-end data foto disimpan di direktori :
  ```bash
    untuk gallery :
      buat folder : 'private-uploads/galleries/'
      cari file : 'FileController.php' cari method 'getAllowedFolders()' lalu tambahkan di array folder 'galleries'
  ```
- untuk front-end data foto menggunakan :
  ```bash
    untuk gallery :
      {{ url("/file/galleries/" . $gallery['foto_event']) }}
  ```

```json
{
  "notification": null,
  "title": "Khafid Swimming Club (KSC) - Official Website | Galeri Foto",
  "galleries": [
    {
      "id": 12,
      "uid": "188f9051-dd4d-46d9-9de6-55bb4f9caab8",
      "foto_event": "Christiana Aufderhar V",
      "nama_foto": "Vella Quigley"
    }
    // ... s/d banyaknya data galleries
  ]
}
```

---

## 📞 Endpoint: Kontak

### 1. Halaman Kontak

**URL**: `GET /kontak`

**Response**:

```json
{
  "notification": null,
  "title": "Khafid Swimming Club (KSC) - Official Website | Hubungi Kami"
}
```

### 2. Kirim Pesan (Process)

**URL**: `POST /kontak/process`

**Body Request (JSON/Form-Data)**:

```json
{
  "nama_lengkap": "Budi Santoso",
  "email": "budi@example.com",
  "subjek": "Tanya Jadwal",
  "pesan": "Kapan jadwal latihan berikutnya?"
}
```

**Response (Success)**:

```json
{
  "notification": {
    "redirect": "/kontak"
    "status": "success",
    "message": "Pesan Anda berhasil dikirim!",
    "expires_at": 1770955896,
    "duration": 5000
  },
}
```

---

## 📋 Catatan Implementasi

### File Upload System

Untuk semua endpoint yang menampilkan foto/gambar, sistem menggunakan folder `private-uploads/` dengan subfolder sesuai kategori:

1. **Banner Event**: `private-uploads/banner-event/`
2. **Galleries**: `private-uploads/galleries/`
3. **Mentors**: `private-uploads/mentors/`

**Setup Backend:**

- Buat folder yang dibutuhkan
- Update `FileController.php` → method `getAllowedFolders()` → tambahkan nama folder ke array

**Akses dari Frontend:**

```php
{{ url("/file/{folder-name}/" . $data['field_name']) }}
```

### SEO & Metadata

Setiap endpoint menyertakan field `title` yang dapat digunakan untuk:

- Page title (`<title>` tag)
- Open Graph metadata
- Twitter Card metadata

---

## 🔗 Referensi

- File lengkap: `.BACKUP/API_CONTRACT.md`
- Group lain: `.BACKUP/PROJECT-CONTRACT/AUTH-CONTRACT.md`
# 📜 Kontrak API - Group GUEST (Public Endpoints)

Dokumen ini menjelaskan spesifikasi antarmuka (interface) antara Back-end dan Front-end untuk endpoint-endpoint yang dapat diakses tanpa autentikasi (public access).

---

## 👥 Pembagian Peran

| Peran         | Penanggung Jawab | Tanggung Jawab Utama                                                                                       |
| :------------ | :--------------- | :--------------------------------------------------------------------------------------------------------- |
| **Front-end** | **Mada**         | • Mengirim request ke API.`<br>`• Menerima & mengolah response.`<br>`• Menampilkan data (UI/UX).           |
| **Back-end**  | **Farrel**       | • Menyediakan endpoint API.`<br>`• Mengolah business process & database.`<br>`• Mengirim response standar. |

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
   Kolom ID relasi harus **disembunyikan** jika data relasinya sudah dimuat (eager loaded). - _Contoh_: Jika return data user beserta role-nya, maka `users.uid_role` harus di-hide karena validasinya bisa menggunakan object `role.uid` yang disertakan. - _Tujuannya_: Response lebih bersih dan tidak redundan.

---

## 🔐 Group: GUEST (Public Endpoints)

Semua endpoint di bawah ini dapat diakses tanpa autentikasi (public access).

### Tabel Ringkasan Endpoint

| No  | Method | Endpoint          | Route Definition                                                                                                                     | Deskripsi                                        |
| :-: | :----: | :---------------- | :----------------------------------------------------------------------------------------------------------------------------------- | :----------------------------------------------- |
|  1  |  GET   | `/`               | `Router::add('GET', '/', HomepageController::class, 'index', [WAFMiddleware::class]);`                                               | Homepage - 2 highlight event + 10 galeri terbaru |
|  2  |  GET   | `/tentang-kami`   | `Router::add('GET', '/tentang-kami', HomepageController::class, 'tentangKami', [WAFMiddleware::class]);`                             | Tentang Kami - Menampilkan 3 mentor              |
|  3  |  GET   | `/pelatih`        | `Router::add('GET', '/pelatih', HomepageController::class, 'pelatih', [WAFMiddleware::class]);`                                      | Daftar Pelatih - Menampilkan semua mentor        |
|  4  |  GET   | `/lomba`          | `Router::add('GET', '/lomba', HomepageController::class, 'lomba', [WAFMiddleware::class]);`                                          | Agenda Kegiatan - Menampilkan semua event        |
|  5  |  GET   | `/galeri`         | `Router::add('GET', '/galeri', HomepageController::class, 'galeri', [WAFMiddleware::class]);`                                        | Galeri Foto - Menampilkan semua foto galeri      |
|  6  |  GET   | `/kontak`         | `Router::add('GET', '/kontak', HomepageController::class, 'kontak', [WAFMiddleware::class]);`                                        | Kontak - Halaman kontak                          |
|  7  |  POST  | `/kontak/process` | `Router::add('POST', '/kontak/process', HomepageController::class, 'kontakProcess', [WAFMiddleware::class, CsrfMiddleware::class]);` | Kontak - Proses kirim pesan                      |

---

## 🏠 Endpoint: Homepage

**URL**: `GET /`

### Response

Menampilkan 2 **highlight event** dan 10 **galeri terbaru**.

- untuk back-end data foto disimpan di direktori :

  ```bash
    untuk event :
      buat folder : 'private-uploads/banner-event/'
      cari file : 'FileController.php' cari method 'getAllowedFolders()' lalu tambahkan di array folder 'banner-event'

    untuk gallery :
      buat folder : 'private-uploads/galleries/'
      cari file : 'FileController.php' cari method 'getAllowedFolders()' lalu tambahkan di array folder 'galleries'
  ```

- untuk front-end data foto menggunakan :

  ```bash
    untuk event :
      {{ url("/file/banner-event/" . $event['foto_event']) }}

    untuk gallery :
      {{ url("/file/galleries/" . $gallery['foto_event']) }}
  ```

```json
{
  "notification": null,
  "title": "Khafid Swimming Club (KSC) - Official Website | Beranda",
  "events": [
    {
      "id": 1,
      "uid": "e6e9b4c1-fa79-4dc0-b1e0-9b5c1afb398a",
      "nama_event": "kuontol anda",
      "deskripsi": "Et reiciendis excepturi ut sed omnis est nihil. Molestias beatae quo consectetur. Id perferendis beatae suscipit ut amet sed ut.",
      "lokasi_event": "729 Dare Rapids Apt. 385\nFritschtown, FL 81269-8836",
      "waktu_event": "14:55:29",
      "tanggal_event": "2025-02-21",
      "tipe_event": "gratis",
      "biaya_event": "3263380.00",
      "status_event": "berjalan",
      "banner_event": "Accusantium laboriosam optio minus ratione et quod qui. Impedit neque enim et totam. Asperiores architecto laudantium autem quos ut sed. Aut harum at ut et qui voluptatem iusto.",
      "kategori": "Isabelle Beier DDS",
      "author": "Lisandro Padberg"
    }
    // ... s/d 2 item
  ],
  "galleries": [
    {
      "id": 12,
      "uid": "188f9051-dd4d-46d9-9de6-55bb4f9caab8",
      "foto_event": "Christiana Aufderhar V",
      "nama_foto": "Vella Quigley"
    }
    // ... s/d 10 item
  ]
}
```

---

## ℹ️ Endpoint: Tentang Kami

**URL**: `GET /tentang-kami`

### Response

Menampilkan daftar **3 mentor**.

- untuk back-end data foto disimpan di direktori :
  ```bash
    untuk mentor :
      buat folder : 'private-uploads/mentors/'
      cari file : 'FileController.php' cari method 'getAllowedFolders()' lalu tambahkan di array folder 'mentors'
  ```
- untuk front-end data foto menggunakan :
  ```bash
    untuk mentor :
      {{ url("/file/mentors/" . $mentor['foto_profil']) }}
  ```

```json
{
  "notification": null,
  "title": "Khafid Swimming Club (KSC) - Official Website | Tentang Kami",
  "mentors": [
    {
      "id_user": 2,
      "uid": "3a135818-c496-4a94-8bfc-a8d2ffc7b05b",
      "nama_lengkap": "Dr. Orlando Cole V",
      "email": "sage58@lind.com",
      "no_telepon": null,
      "tanggal_lahir": null,
      "nama_klub": null,
      "alamat": null,
      "foto_ktp": null,
      "foto_profil": null
    }
    // ... s/d 3 item
  ]
}
```

---

## 🏊 Endpoint: Pelatih (List Mentor)

**URL**: `GET /pelatih`

### Response

Sama dengan endpoint `/tentang-kami`, menampilkan daftar **semua mentor**.

- untuk back-end data foto disimpan di direktori :
  ```bash
    untuk mentor :
      buat folder : 'private-uploads/mentors/'
      cari file : 'FileController.php' cari method 'getAllowedFolders()' lalu tambahkan di array folder 'mentors'
  ```
- untuk front-end data foto menggunakan :
  ```bash
    untuk mentor :
      {{ url("/file/mentors/" . $mentor['foto_profil']) }}
  ```

```json
{
  "notification": null,
  "title": "Khafid Swimming Club (KSC) - Official Website | Daftar Pelatih",
  "mentors": [
    {
      "id_user": 2,
      "uid": "3a135818-c496-4a94-8bfc-a8d2ffc7b05b",
      "nama_lengkap": "Dr. Orlando Cole V",
      "email": "sage58@lind.com",
      "no_telepon": null,
      "tanggal_lahir": null,
      "nama_klub": null,
      "alamat": null,
      "foto_ktp": null,
      "foto_profil": null
    }
    // ... s/d sebanyak coach di database
  ]
}
```

---

## 📅 Endpoint: Events (List Event)

**URL**: `GET /lomba`

### Response

Menampilkan **seluruh lomba** yang tersedia.

- untuk back-end data foto disimpan di direktori :
  ```bash
    untuk event :
      buat folder : 'private-uploads/banner-event/'
      cari file : 'FileController.php' cari method 'getAllowedFolders()' lalu tambahkan di array folder 'banner-event'
  ```
- untuk front-end data foto menggunakan :
  ```bash
    untuk event :
      {{ url("/file/banner-event/" . $event['foto_event']) }}
  ```

```json
{
  "notification": null,
  "title": "Khafid Swimming Club (KSC) - Official Website | Agenda Kegiatan",
  "events": [
    {
      "id": 1,
      "uid": "e6e9b4c1-fa79-4dc0-b1e0-9b5c1afb398a",
      "nama_event": "kuontol anda",
      "deskripsi": "Et reiciendis excepturi ut sed omnis est nihil. Molestias beatae quo consectetur. Id perferendis beatae suscipit ut amet sed ut.",
      "lokasi_event": "729 Dare Rapids Apt. 385\nFritschtown, FL 81269-8836",
      "waktu_event": "14:55:29",
      "tanggal_event": "2025-02-21",
      "tipe_event": "gratis",
      "biaya_event": "3263380.00",
      "status_event": "berjalan",
      "banner_event": "Accusantium laboriosam optio minus ratione et quod qui. Impedit neque enim et totam. Asperiores architecto laudantium autem quos ut sed. Aut harum at ut et qui voluptatem iusto.",
      "kategori": "Isabelle Beier DDS",
      "author": "Lisandro Padberg"
    }
    // ... s/d sebanyak data events
  ]
}
```

---

## 🖼️ Endpoint: Galeri

**URL**: `GET /galeri`

### Response

Menampilkan **seluruh foto galeri**.

- untuk back-end data foto disimpan di direktori :
  ```bash
    untuk gallery :
      buat folder : 'private-uploads/galleries/'
      cari file : 'FileController.php' cari method 'getAllowedFolders()' lalu tambahkan di array folder 'galleries'
  ```
- untuk front-end data foto menggunakan :
  ```bash
    untuk gallery :
      {{ url("/file/galleries/" . $gallery['foto_event']) }}
  ```

```json
{
  "notification": null,
  "title": "Khafid Swimming Club (KSC) - Official Website | Galeri Foto",
  "galleries": [
    {
      "id": 12,
      "uid": "188f9051-dd4d-46d9-9de6-55bb4f9caab8",
      "foto_event": "Christiana Aufderhar V",
      "nama_foto": "Vella Quigley"
    }
    // ... s/d banyaknya data galleries
  ]
}
```

---

## 📞 Endpoint: Kontak

### 1. Halaman Kontak

**URL**: `GET /kontak`

**Response**:

```json
{
  "notification": null,
  "title": "Khafid Swimming Club (KSC) - Official Website | Hubungi Kami"
}
```

### 2. Kirim Pesan (Process)

**URL**: `POST /kontak/process`

**Body Request (JSON/Form-Data)**:

```json
{
  "nama_lengkap": "Budi Santoso",
  "email": "budi@example.com",
  "subjek": "Tanya Jadwal",
  "pesan": "Kapan jadwal latihan berikutnya?"
}
```

**Response (Success)**:

```json
{
  "notification": {
    "redirect": "/kontak"
    "status": "success",
    "message": "Pesan Anda berhasil dikirim!",
    "expires_at": 1770955896,
    "duration": 5000
  },
}
```

---

## 📋 Catatan Implementasi

### File Upload System

Untuk semua endpoint yang menampilkan foto/gambar, sistem menggunakan folder `private-uploads/` dengan subfolder sesuai kategori:

1. **Banner Event**: `private-uploads/banner-event/`
2. **Galleries**: `private-uploads/galleries/`
3. **Mentors**: `private-uploads/mentors/`

**Setup Backend:**

- Buat folder yang dibutuhkan
- Update `FileController.php` → method `getAllowedFolders()` → tambahkan nama folder ke array

**Akses dari Frontend:**

```php
{{ url("/file/{folder-name}/" . $data['field_name']) }}
```

### SEO & Metadata

Setiap endpoint menyertakan field `title` yang dapat digunakan untuk:

- Page title (`<title>` tag)
- Open Graph metadata
- Twitter Card metadata

---

## 🔗 Referensi

- File lengkap: `.BACKUP/API_CONTRACT.md`
- Group lain: `.BACKUP/PROJECT-CONTRACT/AUTH-CONTRACT.md`
