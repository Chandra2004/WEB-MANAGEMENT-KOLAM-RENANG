# 🏗️ Cara Kerja Aplikasi: Dari A sampai Z untuk Pemula

**Belajar Arsitektur Aplikasi dengan Analogi Sederhana yang Gampang Dipahami**

---

## 📋 Yang Akan Kamu Pelajari

1. [Bayangkan Aplikasi Seperti Restoran](#1-bayangkan-aplikasi-seperti-restoran)
2. [🛠️ Alat Bantu: PHP Artisan (Asisten Restoran)](#2-alat-bantu-php-artisan-asisten-restoran)
3. [🔄 7 Tahap Perjalanan Request](#3-7-tahap-perjalanan-request)
4. [Tahap 1: Routes - Pintu Masuk](#4-tahap-1-routes---pintu-masuk)
5. [Tahap 2: Middleware - Satpam](#5-tahap-2-middleware---satpam)
6. [Tahap 3: Request Validation - Cek Pesanan](#6-tahap-3-request-validation---cek-pesanan)
7. [Tahap 4: Controller - Pelayan](#7-tahap-4-controller---pelayan)
8. [Tahap 5: Service - Chef](#8-tahap-5-service---chef)
9. [Tahap 6: Repository - Gudang](#9-tahap-6-repository---gudang)
10. [Tahap 7: Model - Rak Penyimpanan](#10-tahap-7-model---rak-penyimpanan)
11. [Praktik: Bikin Fitur User dari Nol](#11-praktik-bikin-fitur-user-dari-nol)
12. [Tips untuk Pemula](#12-tips-untuk-pemula)

---

## 1. 🍽️ Bayangkan Aplikasi Seperti Restoran

Biar gampang dipahami, **bayangkan aplikasi web kamu itu seperti restoran yang rapi!**

### 🏪 Analogi Restoran

Ketika kamu pesan makanan di restoran, prosesnya seperti ini:

1. **🚪 Pintu Masuk (Routes)** - Kamu masuk lewat pintu
2. **👮 Satpam (Middleware)** - Cek apakah kamu boleh masuk (punya reservasi? dress code/jas OK?)
3. **📋 Kasir (Request Validation)** - Cek pesanan kamu lengkap dan valid ngga
4. **🧑‍💼 Pelayan (Controller)** - Terima pesanan, kasih ke dapur
5. **👨‍🍳 Chef (Service)** - Masak makanan pakai resep rahasia (ini business logic!)
6. **📦 Gudang (Repository)** - Ambil bahan makanan dari gudang
7. **🗄️ Rak Penyimpanan (Model)** - Tempat bahan makanan tersusun rapi

### 🎯 Kenapa Harus Terpisah-pisah Gini?

**❓ Pertanyaan Pemula:** "Kan lebih gampang kalau semua dikerjain 1 orang aja?"

**💡 Jawaban:**

Iya, bener! Untuk warung kecil (aplikasi sederhana), memang cukup 1 orang ngerjain semua. **TAPI** kalau restorannya udah gede (aplikasi kompleks):

- ✅ **Lebih Rapi** - Kalau chef sakit, tinggal ganti chef baru. Pelayan tetap jalan normal.
- ✅ **Lebih Cepat** - Tiap orang fokus di pekerjaannya masing-masing
- ✅ **Lebih Aman** - Satpam fokus ngecek keamanan, chef fokus masak, ga ada yang campur aduk
- ✅ **Gampang Dikembangkan** - Mau tambah menu? Mau tambah chef? Mau tambah pelayan? Tinggal tambah aja, yang lain ga usah diubah

**Sama persis kayak kode!**

Kalau semua logic (login, database, email, payment, dll) dicampur jadi satu file, nanti pas mau update jadi susah. Takutnya update satu fitur, malah rusak fitur lain yang ga kesentuh!

### 📚 Istilah Teknis yang Sering Muncul (Jangan Takut!)

| Istilah Baku                     | Bahasa Gampangnya                   | Analogi Restoran                      | Contoh Nyata                                                                 |
| -------------------------------- | ----------------------------------- | ------------------------------------- | ---------------------------------------------------------------------------- |
| **Layered Architecture**   | Kode yang dipisah berdasarkan tugas | Restoran dengan pembagian peran jelas | Pelayan terima pesanan, Chef masak, Kasir terima bayaran                     |
| **Separation of Concerns** | 1 fungsi, 1 tugas aja               | Chef cuma masak, Pelayan cuma nganter | File UserController.php cuma handle request user, bukan sekalian masak logic |
| **Business Logic**         | Aturan bisnis perusahaan            | Resep rahasia chef                    | Diskon 20% untuk member, minimal order Rp 50.000                             |
| **Repository Pattern**     | Tempat ambil/simpan data yang rapi  | Gudang yang terorganisir              | File UserRepository.php cuma ambil/simpan data user dari database            |
| **CRUD**                   | Create Read Update Delete           | Bikin, Lihat, Ubah, Hapus             | Tambah user, Lihat daftar user, Edit user, Hapus user                        |

---

## 2. 🛠️ Alat Bantu: PHP Artisan (Asisten Restoran)

### 🤖 Analogi: Asisten Serba Bisa

Bayangkan kamu punya asisten robot di restoran yang bisa bangun rak baru, panggil pelayan baru, atau bikin resep baru dalam sekejap hanya dengan satu perintah suara.

**PHP Artisan** adalah asisten robot itu! Dia membantu kamu membuat file-file yang dibutuhkan agar kamu tidak perlu mengetik dari nol atau copy-paste manual.

### 📋 Cara Panggil Asisten

Buka terminal/CMD di folder project kamu, lalu ketik:

```bash
php artisan list
```

Ini akan memunculkan semua daftar perintah yang bisa dilakukan si asisten.

### 🚀 Contoh Perintah Dasar

- `php artisan serve` : "Buka Restoran!" (Menjalankan server agar web bisa dibuka).
- `php artisan migrate` : "Siapkan Meja & Rak!" (Menyiapkan tabel di database).
- `php artisan route:list` : "Lihat Papan Penunjuk!" (Melihat daftar semua alamat/URL yang ada).

---

## 3. 🔄 7 Tahap Perjalanan Request (Pesan Nasi Goreng!)

### Analogi: Kamu Pesan "Nasi Goreng Spesial" di Restoran

Mari kita ikuti perjalanan pesanan kamu dari awal sampai makanan datang ke meja!

```
┌──────────────────────────────────────────────────┐
│  👤 KAMU (User / Pengunjung Website)             │
│  "Mau pesan 1 Nasi Goreng Spesial, level 3!"    │
└──────────────────────────────────────────────────┘
              ↓
┌──────────────────────────────────────────────────┐
│  🚪 1. PINTU MASUK (Routes / web.php)            │
│  "OK, yang pesan makanan, silakan ke kassa 1!"  │
│                                                  │
│  Tugasnya:                                       │
│  - Cek: Ini pesanan makanan atau minuman?       │
│  - Arahkan ke kasir/pelayan yang tepat          │
│  - Kalau salah pintu, langsung ditolak          │
└──────────────────────────────────────────────────┘
              ↓
┌──────────────────────────────────────────────────┐
│  👮 2. SATPAM (Middleware)                       │
│  "Tunggu dulu, boleh saya lihat member card?"   │
│                                                  │
│  Tugasnya:                                       │
│  - Apakah kamu member? (Authentication)         │
│  - Apakah kamu get banned? (Authorization)      │
│  - Apakah dress code sesuai?                    │
│  - Kalau ga lolos → DITOLAK, ga bisa pesan      │
└──────────────────────────────────────────────────┘
              ↓ (Kalau lolos cek satpam)
┌──────────────────────────────────────────────────┐
│  📋 3. KASIR (Request Validation)                │
│  "Pesanan apa? Level pedas berapa? Bayar pakai  │
│   kartu atau cash?"                              │
│                                                  │
│  Tugasnya:                                       │
│  - Cek form pesanan lengkap                     │
│  - Cek format benar (nomor meja harus angka)    │
│  - Cek pilihan valid (level pedas cuma 1-5)     │
│  - Kalau salah → diminta isi ulang              │
└──────────────────────────────────────────────────┘
              ↓ (Kalau pesanan valid)
┌──────────────────────────────────────────────────┐
│  🧑‍💼 4. PELAYAN (Controller)                      │
│  "Baik Pak/Bu, pesanan sudah saya catat.        │
│   Saya sampaikan ke dapur ya!"                  │
│                                                  │
│  Tugasnya:                                       │
│  - Terima pesanan yang udah valid dari kasir    │
│  - Kasih ke chef untuk diproses                 │
│  - Tunggu makanan jadi                          │
│  - Antar ke meja kamu dengan senyum manis 😊    │
│                                                  │
│  ❌ PELAYAN TIDAK MASAK! Cuma ngantarin aja.    │
└──────────────────────────────────────────────────┘
              ↓
┌──────────────────────────────────────────────────┐
│  👨‍🍳 5. CHEF (Service)                            │
│  "OK, saya masak Nasi Goreng dengan resep       │
│   rahasia restoran kita!"                       │
│                                                  │
│  Tugasnya:                                       │
│  - Baca resep (business logic)                  │
│  - Cek bahan cukup ga? (validasi bisnis)        │
│  - Minta bahan ke gudang (panggil Repository)   │
│  - Masak dengan bumbu rahasia (business rules)  │
│  - Plating cantik                               │
│                                                  │
│  👨‍🍳 CHEF INI YANG PALING PENTING!                │
│     - Dia yang tau resep rahasia                │
│     - Dia yang tentuin rasanya enak apa ngga    │
│     - Business logic SEMUA di sini!             │
└──────────────────────────────────────────────────┘
              ↓
┌──────────────────────────────────────────────────┐
│  📦 6. GUDANG (Repository)                       │
│  "Chef minta nasi, telur, ayam? Saya ambilkan!" │
│                                                  │
│  Tugasnya:                                       │
│  - Ambil bahan dari rak penyimpanan (Model)     │
│  - Kasih ke chef                                │
│  - Catat stok yang keluar                       │
│                                                  │
│  ❌ GUDANG TIDAK MASAK! Cuma nyediain bahan.    │
└──────────────────────────────────────────────────┘
              ↓
┌──────────────────────────────────────────────────┐
│  🗄️ 7. RAK PENYIMPANAN (Model)                   │
│  "Rak A: Nasi, Rak B: Telur, Rak C: Ayam"       │
│                                                  │
│  Tugasnya:                                       │
│  - Data tersimpan rapi berdasarkan jenis        │
│  - Gampang dicari kalau butuh                   │
│  - Deskripsi apa aja yang disimpen di each rak  │
│                                                  │
│  Ini representasi DATABASE TABEL!               │
└──────────────────────────────────────────────────┘
              ↓
┌──────────────────────────────────────────────────┐
│  🍽️ MAKANAN JADI!                                │
│  "Nasi Goreng Spesial siap dihidangkan!"        │
│                                                  │
│  Pelayan bawa ke meja kamu → SELESAI! 🎉        │
└──────────────────────────────────────────────────┘
```

### 🎯 Contoh Konkret di Aplikasi Web

**Skenario:** Kamu klik tombol "Tambah User Baru" dengan nama "John", email "john@mail.com"

**Request:** `POST /users`

```
1. ROUTES (web.php)
   💬 "Oh ini request POST /users, berarti mau bikin user baru.
       OK, saya arahkan ke UserController!"

2. MIDDLEWARE (AdminMiddleware)
   💬 "Tunggu, kamu siapa? Udah login? Role kamu admin?
       OK lolos, silakan lanjut!"

3. VALIDATION (StoreUserRequest)
   💬 "Nama ada? Email valid? Password minimal 8 karakter?
       Semua OK, lanjut!"

4. CONTROLLER (UserController)
   💬 "Saya terima data dari validation, sekarang saya kasih
       ke UserService buat diproses business logic-nya!"

5. SERVICE (UserService)
   💬 "OK saya proses nih:
       - Password saya hash dulu biar aman
       - UUID saya generate
       - Kuota user saya cek, masih ada slot ga?
       - OK aman, saya kasih ke Repository untuk disimpan!"

6. REPOSITORY (UserRepository)
   💬 "Baik, saya terima data dari Service.
       Sekarang saya simpan ke database via Model!"

7. MODEL (User)
   💬 "Saya representasi tabel 'users' di database.
       Data akan disimpan di kolom: id, name, email, password, dll"

   ↓
RESPONSE: "Berhasil! User 'John' telah dibuat!"
```

---

## 4. 🚪 Tahap 1: Routes - Pintu Masuk Restoran

### 🎯 Apa itu Routes?

**Penjelasan:**
Routes adalah sistem yang mengatur "siapa harus pergi ke mana". Setiap kali ada orang mengetik alamat di browser (seperti `/users` atau `/login`), Routes akan menangkap alamat tersebut dan menentukan Controller mana yang bertugas melayaninya.

**Analogi Restoran:**
Bayangkan **Routes** adalah **Pintu Masuk & Papan Penunjuk**. Pengunjung masuk lewat pintu depan, dan di situ ada resepsionis atau papan petunjuk yang bilang: "Kalau mau makan di tempat, silakan ke Meja 1. Kalau mau bawa pulang, silakan ke Kasir A."

---

### 🛠️ Cara Penulisan Dasar (Base Syntax)

Di framework ini, kita menggunakan perintah `Router::add()` untuk membuat rute baru.

**Potongan Kode:**

```php
use TheFramework\App\Router;
use TheFramework\Http\Controllers\HomeController;

Router::add('GET', '/welcome', HomeController::class, 'Welcome');
```

**Penjelasan Kode Secara Eksplisit:**

1. **`Router::add`**: Perintah utama untuk mendaftarkan alamat baru ke sistem.
2. **`'GET'`**: Jenis permintaan. Berarti user hanya ingin "melihat" halaman `/welcome`.
3. **`'/welcome'`**: Alamat URL yang diketik user di browser.
4. **`HomeController::class`**: Nama file "Pelayan" (Controller) yang akan menangani permintaan ini.
5. **`'Welcome'`**: Nama tugas (Method/Function) spesifik di dalam HomeController yang harus dijalankan.

---

### 🛡️ WAFMiddleware: Satpam yang Selalu Berjaga

**Penjelasan:**
Kamu akan melihat `WAFMiddleware::class` ada di hampir setiap rute. WAF (Web Application Firewall) berfungsi untuk memfilter serangan berbahaya sebelum mencapai Controller kamu.

**Analogi Restoran:**
**WAFMiddleware** adalah **Gerbang Detektor Logam**. Setiap pengunjung yang masuk akan dicek tasnya. Jika ada yang membawa barang berbahaya (seperti kode jahat untuk merusak database), satpam WAF akan langsung mengusir mereka di pintu depan sebelum mereka sempat duduk.

**Potongan Kode:**

```php
use TheFramework\Middleware\WAFMiddleware;

Router::add('GET', '/', HomeController::class, 'Index', [WAFMiddleware::class]);
```

**Penjelasan Kode Secara Eksplisit:**

- **`[WAFMiddleware::class]`**: Ini adalah array middleware. Kamu meletakkan "Satpam" di pintu rute ini.
- Sebelum function `Index` dijalankan, sistem akan menjalankan pengecekan keamanan di dalam `WAFMiddleware` terlebih dahulu.

---

### 📋 Mengenal Jenis Perintah (HTTP Methods)

**Penjelasan:**
Kita harus menentukan apa yang ingin dilakukan user melalui method HTTP. Ini penting agar sistem tahu apakah user cuma mau melihat data atau mau mengubah data.

**Analogi Restoran:**
Ini adalah **Instruksi Spesifik** ke kasir. Jika kamu bilang "GET", kasir kasih menu. Jika kamu bilang "POST", kasir mencatat orderan baru.

| Method           | Fungsi                | Contoh Kode                                     |
| :--------------- | :-------------------- | :---------------------------------------------- |
| **GET**    | Melihat data          | `Router::add('GET', '/users', ...)`           |
| **POST**   | Menambah data baru    | `Router::add('POST', '/users/save', ...)`     |
| **PUT**    | Update data (Semua)   | `Router::add('PUT', '/users/update', ...)`    |
| **PATCH**  | Update data (Sedikit) | `Router::add('PATCH', '/users/note', ...)`    |
| **DELETE** | Menghapus data        | `Router::add('DELETE', '/users/remove', ...)` |

---

### 🆔 Dynamic Route: Meja Nomor Berapa?

**Penjelasan:**
Terkadang alamat web tidak selalu tetap. Contohnya `/profile/1`, `/profile/2`. Angka `1` dan `2` adalah data dinamis yang berubah-ubah.

**Analogi Restoran:**
Ini seperti **Meja Reservasi**. Kamu tidak buat pintu khusus untuk "Budi" atau pintu khusus untuk "Iwan". Kamu buat satu rute pintu bernama **{uid}**, dan siapa pun yang datang dengan tiket ID tertentu akan diantar ke meja yang sesuai.

**Potongan Kode:**

```php
// URL: /users/profile/user-abc-123
Router::add('GET', '/users/profile/{uid}', HomeController::class, 'ShowProfile');
```

**Penjelasan Kode Secara Eksplisit:**

- **`{uid}`**: Tanda kurung kurawal ini artinya "Data ini bisa berubah-ubah".
- Di dalam Controller `ShowProfile($uid)`, variabel `$uid` akan otomatis berisi teks yang ada di URL (contoh: `"user-abc-123"`).

---

### 📦 Route Group: Area VIP Khusus

**Penjelasan:**
Jika kamu punya banyak alamat yang punya awalan yang sama (prefix) atau butuh satpam yang sama, kamu bisa mengelompokkannya agar kode tidak berulang-ulang (DRY - Don't Repeat Yourself).

**Analogi Restoran:**
Ini adalah **Ruangan VIP**. Di pintu masuk ruangan VIP, sudah ada Satpam khusus. Semua meja di dalam ruangan tersebut otomatis berada di bawah perlindungan satpam itu, dan alamatnya pun sama-sama di area "VIP".

**Potongan Kode:**

```php
Router::group(
    [
        'prefix' => '/api', // Semua URL di dalam sini berawal /api
        'middleware' => [WAFMiddleware::class, ApiAuthMiddleware::class] // Satpam double!
    ],
    function () {
        Router::add('GET', '/users', ApiHomeController::class, 'Users');
        Router::add('POST', '/users/create', ApiHomeController::class, 'Create');
    }
);
```

**Penjelasan Kode Secara Eksplisit:**

1. **`'prefix' => '/api'`**: Alamat otomatis menjadi `/api/users` dan `/api/users/create`. Sangat praktis!
2. **`'middleware' => [...]`**: Semua rute di dalam kurung kurawal `{ ... }` akan melalui pengecekan `WAF` dan `ApiAuth` secara otomatis. Kamu tidak perlu menulisnya berulang-ulang di setiap baris.

---

### ✅ DO and DON'T (Aturan Emas)

| ✅ DO (Lakukan!)                                                                                        | ❌ DON'T (Jangan!)                                                                                                        |
| :------------------------------------------------------------------------------------------------------ | :------------------------------------------------------------------------------------------------------------------------ |
| **Gunakan Route Group** untuk URL yang mirip agar file `web.php` rapi.                          | **Jangan tulis logic di web.php**. Jangan masak di pintu masuk! Semua logic harus ada di Controller/Service.        |
| **Selalu pakai WAFMiddleware** untuk rute yang berhubungan dengan input user atau database.       | **Jangan pakai nama URL yang membingungkan**, gunakanlah nama yang deskriptif dan singkat.                          |
| **Sesuaikan Method HTTP**. Kalau mau hapus, wajib pakai `DELETE`, jangan `GET` demi keamanan. | **Jangan buat rute duplikat** (alamat dan method yang sama persis), karena sistem akan bingung mau pilih yang mana. |

---

---

## 5. 👮 Tahap 2: Middleware - Satpam Restoran

### 🎯 Apa itu Middleware?

**Penjelasan:**
Middleware adalah "filter" atau penyaring yang berada di antara **Route** dan **Controller**. Gunanya untuk mengecek sesuatu sebelum permintaan (request) sampai ke tujuan utama. Jika syarat tidak terpenuhi, Middleware bisa menghentikan perjalanan request atau mengalihkannya (redirect).

**Analogi Restoran:Middleware** adalah **Satpam Restoran**. Setelah pengunjung masuk lewat pintu (Route), satpam akan mencegat:

- "Maaf Pak, ruangan ini khusus Member VIP. Mana kartu membernya?"
- "Maaf Bu, di sini wajib pakai sepatu, tidak boleh pakai sandal jepit."

Jika pengunjung lolos cek satpam, baru mereka boleh lanjut menemui Pelayan (Controller).

---

### 🛠️ Membuat Middleware Sendiri

**Analogi:** Kamu ingin punya satpam baru khusus mengecek member. Suruh asisten robot bikin:

```bash
php artisan make:middleware MemberMiddleware
```

Setiap Middleware di framework ini wajib memiliki dua fungsi utama: `before()` (sebelum request) dan `after()` (setelah request selesai).

**Potongan Kode:**

```php
namespace TheFramework\Middleware;

use TheFramework\Helpers\Helper;

class AdminMiddleware implements Middleware
{
    public function before()
    {
        // 1. Ambil data user dari Session pakai Helper yang sudah disiapkan
        $user = Helper::session_get('user');

        // 2. Cek: Apakah user sudah login?
        if (!$user) {
            Helper::redirect('/login', 'error', 'Login dulu ya!');
            exit; // Stop di sini, jangan lanjut!
        }

        // 3. Cek: Apakah dia Admin? (Pakai fungsi hasRole biar simpel)
        if (!Helper::hasRole('admin')) {
            Helper::redirect('/', 'error', 'Hanya Admin yang boleh masuk!');
            exit; // Usir sekarang juga!
        }

        // Jika semua OK, request lanjut ke Controller...
    }

    public function after()
    {
        // Jalankan sesuatu setelah Controller selesai (opsional)
    }
}
```

**Penjelasan Kode Secara Eksplisit:**

1. **`implements Middleware`**: Memastikan class ini mengikuti aturan standar framework (harus punya `before` dan `after`).
2. **`public function before()`**: Semua kode di dalam sini akan dijalankan **SEBELUM** Controller dipanggil. Ini tempat paling pas untuk mengecek keamanan.
3. **`Helper::session_get('user')`**: Mempermudah pengambilan data session. Fungsi ini otomatis memastikan Session sudah aktif (`ensureSession`) sebelum mengambil data.
4. **`Helper::hasRole('admin')`**: Cara cepat untuk cek jabatan user tanpa perlu tulis `if-else` manual yang panjang.
5. **`Helper::redirect(...)`**: Jika tidak punya akses, kita tendang user ke halaman lain.
6. **`exit`**: Sangat penting! Ini perintah untuk "menutup pintu". Request tidak akan pernah sampai ke Controller jika `exit` dipanggil.

### 🔄 Before vs After: Kapan Satpam Harus Bertindak?

**Penjelasan:**
Ada dua momen di mana Middleware bisa bekerja: **Sebelum** request diproses (Before) dan **Setelah** request selesai diproses (After).

---

#### **1. Fungsi `before()` (Cek Gerbang)**

**Analogi Restoran:**
Ini adalah **Pengecekan di Pintu Masuk**. Satpam mencegat pengunjung _sebelum_ mereka duduk dan memesan makanan. Satpam mengecek: "Boleh masuk ga? Sudah reservasi? Pakai baju sopan ga?"

**Kegunaan:**

- Cek Login (Auth).
- Cek Hak Akses (Admin/User).
- Cek Virus/Hacker (WAF).
- Cek Kuota/Rate Limit.

**Potongan Kode:**

```php
public function before()
{
    // Jika hari ini libur, jangan biarkan tamu masuk
    if (Config::get('RESTO_STATUS') === 'closed') {
        Helper::redirect('/closed', 'info', 'Maaf resto sedang libur!');
        exit;
    }
}
```

**Penjelasan Kode Secara Eksplisit:**

- Kode ini dijalankan **paling awal** bahkan sebelum Pelayan (Controller) tahu ada tamu datang.
- Jika syarat gagal, kita panggil `exit;` agar tamu disuruh pulang saat itu juga.

---

#### **2. Fungsi `after()` (Catat Laporan)**

**Analogi Restoran:**
Ini adalah **Pencatatan di Buku Tamu atau Kasih Struk**. Setelah tamu selesai makan dan mau keluar lewat pintu yang sama, satpam bertugas mencatat: "Siapa tamu tadi? Makan jam berapa? Menu apa yang paling laku?" atau sekadar memberikan kartu ucapan "Terima kasih sudah mampir!".

**Kegunaan:**

- Mencatat Log/History (Audit Log).
- Menghitung waktu proses (Performance Log).
- Memodifikasi jawaban akhir (Response) sebelum dikirim ke browser.
- Membersihkan sampah (Cleanup).

**Potongan Kode:**

```php
public function after()
{
    // Catat siapa saja yang baru saja selesai mengakses halaman ini
    $ip = Helper::get_client_ip();
    Logging::info("Ada tamu dari IP: $ip baru saja selesai makan!");
}
```

**Penjelasan Kode Secara Eksplisit:**

- Kode ini dijalankan **setelah** Pelayan (Controller) selesai masak dan mengantar makanan ke tamu.
- Apapun yang kamu tulis di sini tidak akan menghentikan proses (karena makanan sudah diantar), tapi berguna untuk pencatatan internal sistem.

---

### 💡 Advanced: Satpam yang Bawa Daftar Tamu Spesifik (Middleware Parameter)

**Penjelasan:**
Terkadang kita ingin satu Middleware yang sama tapi bisa punya aturan yang beda-beda di setiap rute. Contohnya `RoleMiddleware`. Di satu rute kita ingin cuma **Admin** yang boleh masuk, tapi di rute lain kita ingin **Admin** dan **Coach** boleh masuk.

**Analogi Restoran:**Ini adalah **Satpam yang Pegang Daftar Tamu (Guest List)**. Di setiap pintu, satpam yang sama dibekali kertas daftar jabatan yang berbeda:

- Di Pintu VIP: Kertas daftar berisi `['admin']`.
- Di Pintu Ruang Rapat: Kertas daftar berisi `['admin', 'coach']`.
- Di Pintu Dapur: Kertas daftar berisi `['admin', 'chef']`.

---

#### **1. Potongan Kode Middleware (RoleMiddleware.php)**

```php
namespace TheFramework\Middleware;

use TheFramework\Helpers\Helper;

class RoleMiddleware implements Middleware
{
    protected array $allowedRoles;

    // 1. Parameter roles dikirim sebagai satu buah array dari Route
    public function __construct($roles)
    {
        // Pastikan kita menyimpannya sebagai array
        $this->allowedRoles = (array) $roles;
    }

    public function before()
    {
        // 2. Ambil data user yang sedang login
        $user = Helper::session_get('user');

        if (!$user) {
            Helper::redirect('/login', 'error', 'Login dulu ya!');
            exit;
        }

        // 3. Cek: Apakah jabatan user ada di daftar kertas satpam?
        // Misal user itu 'Koordinator', apakah ada di ['SuperAdmin', 'Koordinator']?
        $userRole = $user['role_name'] ?? '';

        if (!in_array($userRole, $this->allowedRoles)) {
            Helper::redirect('/', 'error', 'Maaf, area ini khusus ' . implode(' atau ', $this->allowedRoles));
            exit;
        }
    }

    public function after() {}
}
```

**Penjelasan Kode Secara Eksplisit:**

1. **`__construct($roles)`**: Constructor ini menerima satu variabel `$roles`. Karena di rute kita mengirimnya dalam bentuk array `['A', 'B']`, maka variabel ini akan berisi array tersebut.
2. **`(array) $roles`**: Kita memastikan data yang masuk dikonversi/dipastikan sebagai array agar fungsi `in_array` tidak error.
3. **`in_array($userRole, $this->allowedRoles)`**: Satpam mengecek apakah jabatan user saat ini terdaftar di dalam "Daftar Izin" yang dibawa.

---

#### **2. Cara Pakai di Route (web.php)**

Ini adalah cara memanggil Satpam dengan memberikan "Daftar Nama" sekaligus saat pendaftaran rute.

**Potongan Kode:**

```php
// Contoh pemanggilan di rute dengan parameter array
Router::add('GET', '/courses', DashboardController::class, 'Courses', [
    [RoleMiddleware::class, ['SuperAdmin', 'Koordinator']]
]);
```

**Penjelasan Kode Secara Eksplisit:**

- **`Router::add(..., [...])`**: Argumen ke-5 adalah daftar satpam.
- **`[RoleMiddleware::class, ['SuperAdmin', 'Koordinator']]`**:
  - Kita mengirim array. **Elemen pertama** adalah Class Middleware-nya.
  - **Elemen kedua** adalah data yang mau kita kirim ke `__construct`.
  - Di sini kita mengirim satu paket array `['SuperAdmin', 'Koordinator']`.
- **Fleksibilitas**: Kamu bisa ganti isinya sesuka hati, misal `['Dosen']` atau `['Mahasiswa', 'Umum']` tanpa perlu mengubah file `RoleMiddleware.php`.

---

### 📋 Cara Menggunakan Middleware di Route

Kamu bisa memasang Middleware langsung saat mendaftarkan Route.

**Potongan Kode:**

```php
Router::add('GET', '/admin/dashboard', AdminController::class, 'Index', [
    AdminMiddleware::class
]);
```

**Penjelasan Kode Secara Eksplisit:**

- **`[AdminMiddleware::class]`**: Bagian terakhir di `Router::add` adalah tempat menaruh satpam. Kamu bisa menaruh lebih dari satu satpam di sini (misal: `[WAFMiddleware::class, AdminMiddleware::class]`).
- Sistem akan mengecek satpam dari yang paling **KIRI** ke **KANAN**. Jadi `WAF` cek virus dulu, baru `Admin` cek jabatan.

---

### 📦 Middleware Bawaan yang Sering Dipakai

Framework ini sudah menyediakan beberapa satpam siap pakai:

| Middleware                   | Tugasnya                         | Kapan Harus Pakai?                    |
| :--------------------------- | :------------------------------- | :------------------------------------ |
| **WAFMiddleware**      | Deteksi hacker & kode jahat.     | Wajib di hampir semua rute!           |
| **ApiAuthMiddleware**  | Cek API Key / Token.             | Untuk rute API (`/api/*`).          |
| **CsrfMiddleware**     | Mencegah spam dari website luar. | Untuk rute Form (POST/PUT).           |
| **LanguageMiddleware** | Mengatur bahasa (ID/EN).         | Jika website kamu punya multi-bahasa. |

---

### ✅ DO and DON'T (Tips Keamanan)

| ✅ DO (Lakukan!)                                                                              | ❌ DON'T (Jangan!)                                                                                                           |
| :-------------------------------------------------------------------------------------------- | :--------------------------------------------------------------------------------------------------------------------------- |
| **Pasang WAF di urutan pertama.** Biar virus diusir duluan sebelum pengecekan lain.     | **Jangan taruh Business Logic di Middleware.** Satpam cuma cek identitas, jangan suruh masak Nasi Goreng!              |
| **Gunakan Route Group** jika banyak rute butuh satpam yang sama agar kode lebih bersih. | **Jangan lupa panggil `exit`** setelah redirect di dalam Middleware, atau Controller akan tetap jalan di background! |
| **Gunakan `before()`** untuk validasi keamanan.                                       | **Jangan biarkan rute sensitif** (seperti hapus data) tanpa Middleware pengaman.                                       |

---

## 6. 📝 Tahap 3: Request Validation - Kasir Cek Pesanan

### 🎯 Apa itu Request Validation?

**Penjelasan:**
Request Validation adalah proses pengecekan data yang dikirimkan oleh user. Sebelum data disimpan ke dalam database, kita harus memastikan datanya lengkap, formatnya benar (misal: format email harus ada `@`), dan aman. Ini mencegah data "sampah" atau data berbahaya masuk ke sistem.

**Analogi Restoran:****Request Validation** adalah **Kasir Restoran**. Setelah kamu melewati satpam dan ingin memesan, kasir akan mengecek nota pesananmu:

- "Nama pemesan ada?" (Required)
- "Pilihan menu sesuai daftar?" (In:nasi_goreng,mie_goreng)
- "Nomor HP benar 10-13 angka?" (Numeric|Min:10)

Jika ada yang salah, kasir akan langsung bilang: "Maaf Pak, menu ini tidak tersedia" atau "Nomor HP-nya kurang satu angka". Kamu tidak akan boleh lanjut sampai pesananmu benar.

---

### 🛠️ Membuat Form Validation (Form Request)

Di framework ini, kita menggunakan `app/App/FormRequest.php` untuk membuat validasi otomatis. Kamu bisa membuatnya lewat bantuan asisten robot:

**Perintah Artisan:**

```bash
php artisan make:request StoreUserRequest
```

**Potongan Kode (StoreUserRequest.php):**

```php
namespace TheFramework\Http\Requests;

use TheFramework\App\FormRequest;
use TheFramework\Helpers\Helper;

class StoreUserRequest extends FormRequest
{
    // 1. Cek apakah orang ini boleh mengirim form ini?
    public function authorize(): bool
    {
        return Helper::hasRole('admin');
    }

    // 2. Daftar aturan pengecekan (Rules)
    public function rules(): array
    {
        return [
            'name'     => 'required|string|min:3',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ];
    }

    // 3. Nama label yang muncul di pesan error
    public function labels(): array
    {
        return [
            'name' => 'Nama Lengkap',
            'email' => 'Alamat Email',
        ];
    }
}
```

**Penjelasan Kode Secara Eksplisit:**

1. **`extends FormRequest`**: Menghubungkan file ini ke core `app/App/FormRequest.php`. Di balik layar, core ini yang menjalankan "mesin" validasi secara otomatis.
2. **`authorize()`**: Pengecekan keamanan level kedua. Jika return `false`, user akan langsung diusir (403 Forbidden).
3. **`rules()`**: Di sini kita mendefinisikan aturan mainnya. Simbol `|` (pipe) digunakan untuk memberikan aturan ganda.
   - `required`: Data tidak boleh kosong.
   - `email`: Harus berformat email asli.
   - `unique:users,email`: Data ini tidak boleh sama dengan yang sudah ada di tabel `users` (mencegah email ganda).
4. **`libraries/Validator.php`**: Di balik layar, framework memanggil `Validator` untuk mencocokkan input user dengan rules yang kamu buat.

---

### 📋 Cara Pakai di Controller

Hebatnya di framework ini, kamu tidak perlu mengetik perintah "tolong validasi" secara manual di Controller. Cukup panggil nama filenya!

**Potongan Kode:**

```php
public function store(StoreUserRequest $request)
{
    // Jika kode sampai ke baris ini, berarti data SUDAH PASTI VALID.
    // Jika gagal, user otomatis ditendang balik ke form dengan pesan error.

    $data = $request->validated(); // Ambil hanya data yang sudah lulus sensor
}
```

**Penjelasan Kode Secara Eksplisit:**

- **`StoreUserRequest $request`**: Dengan menuliskan nama class validasi di dalam kurung, framework akan otomatis melakukan pengecekan sebelum fungsi `store` dijalankan.
- **`$request->validated()`**: Fungsi ini mengambil data yang sudah "bersih" dan siap digunakan. Sangat aman dari input liar yang tidak terdaftar di rules.

---

## 7. 🧑‍💼 Tahap 4: Controller - Pelayan Restoran

### 🎯 Apa itu Controller?

**Penjelasan:**
Controller adalah "Otak Koordinator" di dalam aplikasi. Tugasnya bukan untuk mengerjakan semua pekerjaan, melainkan mengatur aliran data. Controller menerima permintaan dari user, memanggil bagian yang tepat untuk memprosesnya, lalu memberikan hasil akhirnya kembali ke user (berupa tampilan web atau data JSON).

**Analogi Restoran:****Controller** adalah **Pelayan Restoran**. Tugas pelayan adalah:

- Menyapa tamu dan menerima pesanan (Request).
- Memastikan pesanan sudah dicek kasir (Validation).
- Mengantarkan pesanan ke dapur (Service) untuk dimasak.
- Setelah masakan jadi, pelayan mengantarkannya ke meja tamu (Response / View).

**PENTING:** Pelayan tidak boleh ikut memasak di dapur! Jika pelayan ikut memasak, pelayanan di depan akan berantakan. Sama halnya dengan Controller, dia tidak boleh berisi logika bisnis yang rumit.

---

### 🛠️ Membuat Pelayan Baru (Controller)

Kamu bisa meminta bantuan asisten robot untuk membuat file Pelayan baru:

**Perintah Artisan:**

```bash
php artisan make:controller UserController
```

**Potongan Kode (UserController.php):**

```php
namespace TheFramework\Http\Controllers;

use TheFramework\App\View;
use TheFramework\Helpers\Helper;
use TheFramework\Http\Requests\StoreUserRequest;
use TheFramework\Services\UserService;

class UserController
{
    private $userService;

    public function __construct()
    {
        // Siapkan 'Chef' (Service) untuk diajak kerjasama
        $this->userService = new UserService();
    }

    public function store(StoreUserRequest $request)
    {
        try {
            // 1. Ambil pesanan yang sudah bersih dari kasir
            $data = $request->validated();

            // 2. Berikan pesanan ke Chef (Service) untuk diolah
            $this->userService->createUser($data);

            // 3. Antarkan kabar gembira ke tamu (Redirect)
            Helper::redirect('/users', 'success', 'User Baru Berhasil Dibuat!');

        } catch (\Exception $e) {
            // 4. Jika ada masalah di dapur, lapor ke tamu
            Helper::redirect('/users/create', 'error', 'Waduh, ada masalah: ' . $e->getMessage());
        }
    }
}
```

**Penjelasan Kode Secara Eksplisit:**

1. **`$this->userService = new UserService()`**: Controller menjalin hubungan dengan Service. Bayangkan pelayan punya bel khusus untuk memanggil Chef di dapur.
2. **`StoreUserRequest $request`**: Pelayan hanya mau memproses pesanan yang sudah punya "Cap Valid" dari Kasir (Validation).
3. **`try { ... } catch { ... }`**: Cara aman untuk bekerja. Jika terjadi kesalahan di dapur, pelayan sudah siap dengan rencana cadangan (menampilkan pesan error) agar aplikasi tidak mati total.
4. **`View::render()`**: Perintah untuk menyiapkan "Piring & Sajian" (Tampilan HTML) yang akan dikirim ke layar browser user.

---

### ✅ DO and DON'T (Etika Pelayan)

| ✅ DO (Lakukan!)                                                                              | ❌ DON'T (Jangan!)                                                                                                        |
| :-------------------------------------------------------------------------------------------- | :------------------------------------------------------------------------------------------------------------------------ |
| **Gunakan Service** untuk memproses data yang rumit. Biarkan Chef yang memasak.         | **Jangan tulis Query SQL** (seperti `SELECT * FROM...`) di dalam Controller. Database adalah urusan Repository.   |
| **Gunakan FormRequest** untuk validasi. Jangan buat `if-else` validasi di Controller. | **Jangan simpan Logika Bisnis** di sini. Contoh: Jangan menghitung diskon atau memproses pembayaran di Controller.  |
| **Kembalikan Response** yang jelas (View, JSON, atau Redirect).                         | **Jangan memanggil file model secara langsung** jika aplikasi sudah mulai besar. Gunakan Service sebagai perantara. |

---

### Penjelasan Step-by-Step

**Method `index()` (Tampilkan daftar user):**

1. Panggil `$this->userService->getAllUsers()` untuk ambil data
2. Passing data ke view `users.index`
3. View akan ditampilkan ke browser

**Method `store()` (Simpan user baru):**

1. Terima data dari StoreUserRequest (sudah tervalidasi!)
2. Kasih ke Service: `$this->userService->createUser($validated)`
3. Service yang handle business logic (hash password, dll)
4. Redirect ke `/users` dengan pesan sukses
5. Terima data dari StoreUserRequest (sudah tervalidasi!)
6. Kasih ke Service: `$this->userService->createUser($validated)`
7. Service yang handle business logic (hash password, dll)
8. Redirect ke `/users` dengan pesan sukses

**Lihat betapa slim controller ini?** Cuma koordinasi doang. Business logic semua di Service!

---

## 8. 👨‍🍳 Tahap 5: Service - Chef Restoran (Jantung Aplikasi)

### 🎯 Apa itu Service?

**Penjelasan:**
Service adalah tempat di mana semua **Business Logic** (Aturan Bisnis) aplikasi kamu tinggal. Jika Controller adalah "Pelayan" yang hanya tahu cara mencatat pesanan, maka Service adalah **"Chef"** yang tahu persis bagaimana data harus diolah. Di sinilah keputusan-keputusan penting diambil: Apakah user ini berhak dapat diskon? Apakah datanya aman untuk disimpan? Apakah kita perlu mengirim email notifikasi sekarang?

**Analogi Restoran (Chef Utama):**Bayangkan di dapur restoran yang sibuk:

- **Chef Memegang Resep Rahasia**: Resep ini adalah Business Logic. Pelayan (Controller) tidak perlu tahu kalau sambal ini butuh 10 cabai, dia cuma perlu tahu tamu minta "Sambal Pedas".
- **Chef Menjaga Kualitas (Quality Control)**: Sebelum makanan keluar, Chef mengecek apakah rasanya sudah pas. Jika "pahit" (data error), Chef akan menolak mengeluarkan piring itu.
- **Chef Mengolah Bahan**: Chef menerima bahan mentah dari Petugas Gudang (Repository) dan mengubahnya menjadi hidangan mewah.
- **Chef Bukan Pembantu Umum**: Chef tidak mengepel lantai atau mengantar makanan ke meja. Dia fokus 100% pada masakan dan resepnya.

---

### ❓ Kenapa Kamu WAJIB Pakai Service? (Penting!)

1. **Anti Copy-Paste (DRY)**: Misal kamu punya fitur "Daftar Akun". Fitur ini ada di Website dan juga ada di Aplikasi Mobile (API). Tanpa Service, kamu akan menulis logika pendaftaran (seperti enkripsi password) dua kali. Capek, kan? Dengan Service, cukup tulis 1x, lalu panggil dari mana saja.
2. **Controller Tetap Langsing (Slim Controller)**: Controller yang terlalu banyak kodingan disebut "Fat Controller" dan itu sangat dibenci developer pro. Dengan Service, Controller kamu cuma berisi perintah panggil-panggil saja.
3. **Mudah Ditusuk-tusuk (Testability)**: Kamu bisa mencoba logika "Hitung Total Belanja" dengan sangat mudah tanpa harus menyalakan server web atau database, cukup dengan menjalankan tes pada file Service-nya.

---

### 🛠️ Penggunaan Chef di Kode

Siapkan Chef baru kamu menggunakan asisten robot (Artisan):

**Perintah Artisan:**

```bash
php artisan make:service UserService
```

**Potongan Kode (app/Services/UserService.php):**

```php
<?php

namespace TheFramework\Services;

use TheFramework\Repositories\UserRepository;
use TheFramework\Helpers\Helper;

class UserService
{
    private $userRepo;

    public function __construct()
    {
        // Chef bekerjasama dengan Petugas Gudang (Repository)
        // untuk urusan bahan makanan (Data)
        $this->userRepo = new UserRepository();
    }

    /**
     * TUGAS: Mengolah Pendaftaran User Baru
     */
    public function createNewAccount(array $rawData)
    {
        // 1. [LOGIKA KEAMANAN] Bungkus password dengan aman (Hashing)
        // Password tidak boleh disimpan telanjang bulat di database!
        $rawData['password'] = Helper::hash_password($rawData['password']);

        // 2. [LOGIKA IDENTITAS] Berikan kode unik (UUID)
        // UUID lebih aman daripada ID angka biasa (1, 2, 3) agar tidak mudah ditebak hacker
        $rawData['uid'] = Helper::uuid();

        // 3. [ATURAN BISNIS] Cek apakah kuota pendaftaran masih ada
        // Ini adalah peraturan restoran: "Maksimal hanya boleh ada 1000 member"
        $currentTotal = $this->userRepo->countAll();
        if ($currentTotal >= 1000) {
            throw new \Exception("Maaf, pendaftaran ditutup karena restoran sudah penuh!");
        }

        // 4. [LOGIKA DEFAULT] Atur role otomatis jika admin lupa mengisi
        if (!isset($rawData['role'])) {
            $rawData['role'] = 'member';
        }

        // 5. [AKSI SIMPAN] Suruh petugas gudang menyimpannya ke rak
        $user = $this->userRepo->create($rawData);

        // 6. [SIDE EFFECT] Kirim kabar gembira ke Log sistem
        // Ini tidak wajib buat user, tapi wajib buat admin untuk memantau aktivitas
        Helper::log("Akun baru berhasil dibuat untuk: " . $user['email']);

        // 7. Sajikan data user yang sudah jadi
        return $user;
    }

    /**
     * TUGAS: Update Profil User dengan Proteksi Ganda
     */
    public function updateProfile($uid, array $newInfo)
    {
        // Cari dulu datanya di gudang
        $user = $this->userRepo->findByUid($uid);
        if (!$user) throw new \Exception("Orang ini tidak terdaftar di restoran kami!");

        // Aturan Bisnis: Jika email diganti, cek apakah email baru sudah dipakai orang lain?
        if (isset($newInfo['email']) && $newInfo['email'] !== $user['email']) {
            if ($this->userRepo->findByEmail($newInfo['email'])) {
                throw new \Exception("Maaf, email tersebut sudah ada yang punya!");
            }
        }

        // Jalankan perintah update ke gudang
        return $this->userRepo->updateByUid($uid, $newInfo);
    }
}
```

---

### 🧐 Penjelasan Eksplisit (Biar Makin Pinter):

1. **`Helper::hash_password()`**: Ini adalah bagian dari Business Logic Keamanan. Sebagai Chef yang baik, kamu wajib memastikan keamanan data sebelum masuk ke gudang.
2. **`throw new \Exception()`**: Ini adalah cara Chef "teriak" jika ada masalah. Teriakan ini akan ditangkap oleh Controller (Pelayan) untuk disampaikan ke User (Tamu) dengan kalimat yang sopan.
3. **Side Effects**: Mengapa ada logging atau kirim email di sini? Karena itu adalah bagian dari "Prosedur Masak". Tanpa Service, kamu akan lupa mencatat log atau mengirim email setiap kali ada pendaftaran baru.
4. **Aliran Data**: Controller mengirim data "Mentah" -> Service mengolah jadi "Masakan Matang" -> Repository menyimpannya di "Rak Gudang".

---

### ✅ DO and DON'T (Standard Kerja Chef Profesional)

| ✅ DO (Logika Bisnis)                                                           | ❌ DON'T (Salah Alamat)                                                                                                                    |
| :------------------------------------------------------------------------------ | :----------------------------------------------------------------------------------------------------------------------------------------- |
| **Olahan Data**: Enkripsi, Hashing, Perhitungan (Diskon, Pajak, Total).   | **Jangan kirim Response**: `View::render` atau `Helper::json` dilarang keras di sini.                                            |
| **Aturan Main**: Cek stok, cek kuota, validasi tanggal, cek ketersediaan. | **Jangan baca URL**: `$_POST`, `$_GET`, atau `$_SESSION` sebaiknya tidak dibaca langsung. Terima saja datanya dari Controller. |
| **Side Effects**: Kirim Email, Hitung Log, Trigger notifikasi ke admin.   | **Jangan tulis SQL**: Jangan ada kata `SELECT`, `INSERT`, atau `UPDATE` manual. Itu tugas Repository!                          |

---

## 9. 📦 Tahap 6: Repository - Gudang Bahan Restoran

### 🎯 Apa itu Repository?

**Penjelasan:**
Repository adalah layer khusus yang bertindak sebagai "Penjaga Gerbang Database". Tugasnya cuma satu: **Mengurus data mentah**. Repository adalah satu-satunya tempat di mana kamu boleh menulis kode-kode database (Query SQL). Dengan adanya Repository, Chef (Service) tidak perlu tahu bagaimana cara mengambil data, dia cukup minta ke Repository.

**Analogi Restoran (Petugas Gudang):**Di balik restoran yang mewah, ada gudang besar yang gelap dan dingin:

- **Petugas Gudang Memegang Kunci**: Hanya petugas gudang (Repository) yang punya kunci dan tahu letak pasti setiap bahan di rak-rak (Tabel Database) yang berdebu.
- **Merapikan Barang (Ordering & Filtering)**: Petugas gudang tidak memberikan telur dalam kondisi kotor. Dia membersihkannya, menyusunnya dengan rapi, dan membuang yang busuk sebelum diserahkan ke Chef.
- **Pencarian Cepat (Indexing)**: Jika Chef minta "Daging Sapi Lokal", petugas gudang sudah tahu itu ada di Rak C Baris 4. Dia tidak perlu mencari di seluruh gudang dari awal.
- **Tidak Ikut Memasak**: Petugas gudang tidak pernah memotong bawang atau menghitung bumbu. Tugasnya selesai saat bahan sudah diletakkan di meja dapur Chef.

---

### ❓ Kenapa Kamu WAJIB Pakai Repository?

1. **Gampang Pindah Rumah (Database Agnostic)**: Misal hari ini restoran kamu pakai gudang kayu (MySQL), lalu besok pindah ke gudang besi (PostgreSQL). Kamu cukup mengubah instruksi di petugas gudang saja, si Chef dan Pelayan tidak akan sadar kalau gudangnya sudah berubah.
2. **Query yang Terorganisir**: Tanpa Repository, kodingan SQL kamu akan berceceran di mana-mana. Jika nama kolom di database berubah (misal `nama_user` jadi `full_name`), kamu akan pusing memperbaikinya di puluhan file. Dengan Repository, cukup ubah di 1 file saja!
3. **Bisa Dipakai Berulang (Reusability)**: Fungsi "Cari User Berdasarkan Email" mungkin dibutuhkan di 10 tempat berbeda. Kamu tidak perlu nulis query yang sama 10 kali.

---

### 🛠️ Penggunaan Gudang di Kode

Minta asisten robot (Artisan) untuk membangun gudang baru:

**Perintah Artisan:**

```bash
php artisan make:repository UserRepository
```

**Potongan Kode (app/Repositories/UserRepository.php):**

```php
<?php

namespace TheFramework\Repositories;

use TheFramework\Models\User;

class UserRepository
{
    /**
     * TUGAS: Mengambil 1 barang dari rak berdasarkan ID
     *
     * @param int $id ID unik dari user (primary key)
     * @return User|null Objek User jika ditemukan, null jika tidak
     */
    public function find($id)
    {
        // Petugas mengambil data langsung dari rak Primary Key.
        // Ini adalah cara tercepat untuk mengambil data berdasarkan ID utama.
        return User::find($id);
    }

    /**
     * TUGAS: Mencari bahan spesifik berdasarkan Email
     *
     * @param string $email Alamat email user yang dicari
     * @return User|null Objek User jika ditemukan, null jika tidak
     */
    public function findByEmail($email)
    {
        // Query filter: "Cari di rak 'users' yang label email-nya cocok".
        // `where('email', '=', $email)`: Memfilter baris di tabel 'users'
        // di mana kolom 'email' sama dengan nilai $email.
        // `first()`: Mengambil baris pertama yang cocok dari hasil filter.
        // Jika tidak ada yang cocok, akan mengembalikan null.
        return User::where('email', '=', $email)->first();
    }

    /**
     * TUGAS: Mencari bahan dengan filter komplek (Pencarian & Urutan)
     *
     * @param string|null $keyword Kata kunci untuk pencarian nama atau email
     * @return \Illuminate\Database\Eloquent\Collection Kumpulan objek User yang aktif
     */
    public function getActiveUsers($keyword = null)
    {
        // Mulai pencarian di rak 'users' yang statusnya Aktif.
        // `User::where('status', '=', 'active')`: Memulai query dengan filter
        // hanya user yang memiliki status 'active'.
        $query = User::where('status', '=', 'active');

        // Jika Chef kasih kata kunci pencarian, petugas gudang akan mencari lebih spesifik.
        if ($keyword) {
            // `where('name', 'LIKE', "%$keyword%")`: Mencari user yang namanya
            // mengandung $keyword (case-insensitive, fleksibel).
            // `orWhere('email', 'LIKE', "%$keyword%")`: Jika nama tidak cocok,
            // coba cari di kolom email. Ini adalah kondisi OR.
            $query->where('name', 'LIKE', "%$keyword%")
                  ->orWhere('email', 'LIKE', "%$keyword%");
        }

        // Urutkan berdasarkan nama agar Chef tidak pusing saat menerima bahan.
        // `orderBy('name', 'ASC')`: Mengurutkan hasil berdasarkan kolom 'name'
        // secara ascending (A-Z).
        // `get()`: Mengeksekusi query dan mengambil semua hasil yang cocok
        // dalam bentuk koleksi objek User.
        return $query->orderBy('name', 'ASC')->get();
    }

    /**
     * TUGAS: Menyimpan Stok Baru ke Rak
     *
     * @param array $data Data user baru yang akan disimpan
     * @return User Objek User yang baru saja dibuat
     */
    public function create(array $data)
    {
        // Menaruh data baru ke dalam database.
        // `User::create($data)`: Menggunakan metode `create` dari Model Eloquent
        // untuk membuat baris baru di tabel 'users' dengan data yang diberikan.
        // Pastikan kolom-kolom di $data sudah diizinkan di properti `$fillable` Model User.
        return User::create($data);
    }

    /**
     * TUGAS: Menghitung Berapa Banyak Stok yang Tersisa
     *
     * @return int Total jumlah user di database
     */
    public function countAll()
    {
        // Menghitung total baris di tabel 'users'.
        // `User::all()`: Mengambil semua baris dari tabel 'users'.
        // `count()`: Menghitung jumlah elemen dalam koleksi yang dihasilkan.
        // Ini bisa dioptimalkan dengan `User::count()` untuk query yang lebih efisien.
        return count(User::all());
    }
}
```

---

### 🧐 Penjelasan Eksplisit (Biar Makin Jago):

1. **`User::where(...)`**: Inilah instruksi pencarian di rak. Petugas gudang (Repository) melakukan penyaringan (filtering) agar data yang dikirim ke Chef benar-benar presisi. Ini adalah abstraksi dari `SELECT * FROM users WHERE ...`.
2. **`orderBy('name', 'ASC')`**: Ini adalah prosedur pengorganisiran. Data yang acak-acakan di database dirapikan dulu sebelum dikonsumsi oleh layer di atasnya. Ini adalah abstraksi dari `ORDER BY name ASC`.
3. **Encapsulation**: Chef (Service) tidak pernah melihat kode `LIKE "%$keyword%"`. Chef cuma memanggil fungsi `getActiveUsers('Budi')`. Ini membuat kode di layer Service sangat manusiawi dan gampang dibaca, karena detail implementasi database tersembunyi di dalam Repository.
4. **Tanggung Jawab Tunggal**: Lihat bahwa tidak ada kode `password_hash` di sini. Petugas gudang masa bodoh dengan keamanan password, dia cuma peduli "Apakah datanya ada? Jika ada, ambil!". Ini menegaskan prinsip Single Responsibility Principle (SRP), di mana setiap layer memiliki satu tanggung jawab utama.

---

### ✅ DO and DON'T (Standard Kerja Petugas Gudang)

| ✅ DO (Urusan Data Mentah)                                                                              | ❌ DON'T (Dilarang Masuk Dapur)                                                                                                     |
| :------------------------------------------------------------------------------------------------------ | :---------------------------------------------------------------------------------------------------------------------------------- |
| **Query SQL**: Gunakan `where`, `orderBy`, `join`, `limit`, `groupBy` di sini.          | **Jangan Olah Data**: Jangan melakukan `password_hash`, enkripsi, atau perhitungan pajak di sini. Itu tugas Chef!           |
| **Sorting & Filtering**: Pastikan data yang keluar sudah sesuai urutan yang diminta.              | **Jangan Kirim Notifikasi**: Memberikan pesan "Berhasil Simpan" adalah tugas Pelayan (Controller), bukan petugas gudang.      |
| **Membungkus Model**: Gunakan Model untuk berinteraksi dengan tabel agar aman dari SQL Injection. | **Jangan Panggil Service**: Petugas gudang dilarang keras menyuruh Chef memasak (Service). Alurnya selalu dari atas ke bawah. |

---

## 10. 🗄️ Tahap 7: Model & Migration - Rak & Label Penyimpanan

### 🎯 Apa itu Model dan Migration?

**Penjelasan Singkat:**Database adalah gudang yang besar. Namun, gudang tanpa rak dan tanpa label akan membuat barang (data) berantakan.

1. **Migration** adalah **"Instruksi Tukang Bangun Rak"**. Dia bertugas memahat kayu, memasang paku, dan membuat bentuk rak fisik di database.
2. **Model** adalah **"Label & Kecerdasan Rak"**. Dia bertugas memberi tahu aplikasi kita: "Rak ini isinya apa? Siapa yang boleh mengisi? Dan data apa yang harus disembunyikan?"

**Analogi Restoran (Blueprint & Rak Fisik):**

- **Migration** adalah **Cetak Biru (Blueprint)** gedung restoran. Sebelum restoran buka, tukang bangunan melihat kertas migration untuk tahu: "Oh, perlu meja ukuran 2x2," atau "Perlu lemari es di sudut kiri." Migration dieksekusi sekali di awal untuk membangun struktur fisiknya.
- **Model** adalah **Petugas Inventaris**. Dia menempelkan label di rak tersebut: "Rak ini khusus Bahan Basah," atau "Hanya Chef yang boleh membuka laci ini." Model selalu ada setiap saat untuk memastikan data yang masuk ke rak sudah sesuai aturan.

---

### 🛠️ Membangun Rak (Migration)

Sebelum punya Model, kita harus bikin rak fisiknya dulu di database.

**Perintah Artisan:**

```bash
php artisan make:migration CreateUsersTable
```

**Potongan Kode Migration (`database/migrations/..._create_users_table.php`):**

```php
Schema::create('users', function ($table) {
    $table->id();                               // Rak otomatis: Nomor urut (1, 2, 3...)
    $table->uuid('uid')->unique();              // Rak khusus: Kode unik yang tidak boleh sama
    $table->string('name', 255);                // Rak teks: Untuk nama (maks 255 huruf)
    $table->string('email', 255)->unique();     // Rak teks: Email unik (kunci login)
    $table->string('password', 255);            // Rak rahasia: Untuk password terenkripsi
    $table->timestamps();                       // Rak otomatis: Tgl dibuat & Tgl diubah
});
```

_Setelah kodenya ditulis, jalankan perintah `php artisan migrate` agar raknya benar-benar dibangun di database._

---

### 🛠️ Memberi Label Rak (Model)

Setelah rak fisik ada, kita buat Model untuk mengontrol rak tersebut.

**Perintah Artisan:**

```bash
php artisan make:model User
```

**Potongan Kode Model (`app/Models/User.php`):**

```php
namespace TheFramework\Models;

use TheFramework\App\Model;

class User extends Model
{
    // 1. Kasih tahu Model ini menjaga rak (tabel) yang mana
    protected $table = 'users';

    // 2. [KEAMANAN] Daftar kolom yang BOLEH diisi oleh user
    // Ini mencegah orang iseng mengirim data 'isAdmin = true' lewat form
    protected $fillable = ['uid', 'name', 'email', 'password', 'active'];

    // 3. [PRIVASI] Kolom yang harus DISEMBUNYIKAN
    // Saat data dikirim ke browser, password tidak akan pernah ikut tampil
    protected $hidden = ['password'];

    /**
     * RELASI: Hubungan Antar Rak
     * Analogi: 1 User punya banyak Pesanan (Posts)
     */
    public function posts()
    {
        // "Cari di rak 'Posts' yang punya label 'user_id' sama dengan ID saya"
        return $this->hasMany(Post::class, 'user_id', 'id');
    }
}
```

---

### 🧐 Penjelasan Eksplisit (Biar Makin Jago):

1. **`protected $fillable`**: Ini adalah **Sistem Satpam**. Hanya kolom di dalam daftar ini yang boleh diisi secara massal (mass-assignment). Jika kamu lupa memasukkan `email` di sini, maka saat pendaftaran, email user tidak akan pernah tersimpan.
2. **`protected $hidden`**: Ini adalah **Tirai Penutup**. Password sangat rahasia. Dengan memasukkannya ke `$hidden`, kita memastikan password hanya ada di database dan tidak akan "bocor" ke tampilan web/API.
3. **Relationships (`hasMany`, `belongsTo`)**: Ini adalah **Kabel Penghubung** antar rak. Kamu tidak perlu menulis SQL `JOIN` yang panjang. Cukup panggil `$user->posts`, dan framework akan otomatis mengambilkan semua pesanan milik user tersebut.
4. **ORM (Object Relational Mapping)**: Inilah sihir utamanya. Kamu tidak lagi bicara soal "Tabel & Kolom", tapi bicara soal "Objektif & Properti".

---

### ✅ DO and DON'T (Standard Kerja Inventaris)

| ✅ DO (Gunakan Otak Rak)                                                                                         | ❌ DON'T (Jangan Kotori Rak)                                                                                                  |
| :--------------------------------------------------------------------------------------------------------------- | :---------------------------------------------------------------------------------------------------------------------------- |
| **Definisikan Relasi**: Hubungkan satu tabel dengan tabel lainnya agar query jadi mudah.                   | **Jangan tulis SQL Query**: SQL urusannya Repository. Model cuma "Label Struktur".                                      |
| **Gunakan `$fillable`**: Selalu batasi kolom yang bisa diisi demi keamanan (Mass Assignment Protection). | **Jangan taruh Logic Bisnis**: Menghitung diskon atau kirim email adalah tugas Chef (Service), bukan tugas Rak (Model). |
| **Gunakan `$hidden`**: Amankan data sensitif agar tidak bocor ke luar aplikasi.                          | **Jangan otak-atik database manual**: Gunakan Migration agar teman satu tim kamu punya struktur rak yang sama.          |

---

## 11. 🤖 PHP Artisan - Asisten Serbaguna

`php artisan` adalah command-line interface (CLI) yang disediakan oleh framework untuk membantu kamu dalam berbagai tugas pengembangan. Anggap saja dia asisten robot yang siap membantu kamu membuat file, menjalankan migrasi database, membersihkan cache, dan banyak lagi.

**Kenapa penting?**

- **Efisiensi:** Otomatis membuat struktur file yang benar, menghemat waktu dan mengurangi kesalahan ketik.
- **Standarisasi:** Memastikan semua file mengikuti konvensi penamaan dan struktur yang sama.
- **Produktivitas:** Mempercepat alur kerja pengembangan.

Kamu akan sering menggunakan `php artisan` untuk membuat berbagai komponen aplikasi.

---

## 12. 🚀 Praktik: Bikin Fitur User dari Nol

Sekarang kita praktik bikin fitur CRUD User dari nol sampai jadi!

### Cara Cepat (The Professional Way)

Asisten robot kamu bisa membuatkan SEGALANYA (Pelayan, Chef, Gudang, Rak, Pintu) dalam satu perintah:

```bash
php artisan make:crud User
```

Ini akan otomatis membuatkan:

- Model, Controller, Service, Repository, Request, dan Views!

### Cara Manual (Step-by-Step)

Jika kamu ingin membuat setiap komponen secara terpisah, ikuti langkah-langkah ini:

### Step 1: Migration (Bikin Tabel Database)

```bash
php artisan make:migration CreateUsersTable
```

**File:** `database/migrations/YYYY_MM_DD_CreateUsersTable.php`

```php
Schema::create('users', function ($table) {
    $table->id();                             // id (auto increment)
    $table->uuid('uid')->unique();            // uid (UUID public)
    $table->string('name', 255);              // name
    $table->string('email', 255)->unique();   // email (harus unik)
    $table->string('password', 255);          // password (encrypted)
    $table->enum('role', ['admin', 'user'])
          ->default('user');                  // role (admin/user)
    $table->boolean('active')->default(true); // active (true/false)
    $table->timestamps();                     // created_at, updated_at
});
```

**Jalankan migration:**

```bash
php artisan migrate
```

### Step 2: Model

```bash
php artisan make:model User
```

**(Lihat code di section 9)**

### Step 3: Repository

```bash
php artisan make:repository UserRepository
```

**(Lihat code di section 9)**

### Step 4: Service

```bash
php artisan make:service UserService
```

**(Lihat code di section 8)**

### Step 5: Form Request

```bash
php artisan make:request StoreUserRequest
```

**(Lihat code di section 5)**

### Step 6: Controller

```bash
php artisan make:controller UserController
```

**(Lihat code di section 6)**

### Step 7: Routes

**File:** `routes/web.php`

```php
use TheFramework\Http\Controllers\UserController;
use TheFramework\Middleware\AdminMiddleware;

Router::group(['middleware' => AdminMiddleware::class], function() {
    Router::get('/users', [UserController::class, 'index']);
    Router::get('/users/create', [UserController::class, 'create']);
    Router::post('/users', [UserController::class, 'store']);
});
```

### Step 8: View

**File:** `resources/views/users/index.blade.php`

```blade
@extends('layouts.app')

@section('content')
    <h1>Daftar User</h1>

    <a href="/users/create">+ Tambah User</a>

    <table>
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
        </tr>
        @endforeach
    </table>
@endsection
```

### SELESAI! 🎉

Sekarang kamu punya fitur User lengkap dengan arsitektur yang rapi!

---

## 11. 💡 Tips Ampuh untuk Pemula (Junior to Pro)

Menjadi developer hebat bukan tentang menghafal kode, tapi tentang **membangun kebiasaan yang benar**. Berikut adalah tips agar perjalanan belajarmu lebih mulus:

### 1️⃣ Jangan Over-Engineer (Mulai dari yang Simple)

**Aturan Emas:** Jangan gunakan meriam untuk membunuh nyamuk.

- **Aplikasi Kecil (Warung):** Cukup gunakan **Route → Controller → Model → View**. Praktis dan cepat!
- **Aplikasi Besar (Restoran Bintang 5):** Baru gunakan **Middleware → Validation → Service → Repository**.
  > **KISS Principle:** _Keep It Simple, Stupid!_ Jangan bikin rumit kalau memang belum butuh.
  >

### 2️⃣ Prinsip 1 Tugas = 1 File (SRP)

Dalam dunia profesional, ini disebut **Single Responsibility Principle**.

- ❌ **Buruk:** Controller yang masak, cuci piring, sekaligus antar pesanan (Fat Controller).
- ✅ **Bagus:** Controller cuma terima pesanan. Tugas masak kasih ke **Service**, tugas ambil bahan kasih ke **Repository**.
  _Kode yang terpisah-pisah jauh lebih mudah diperbaiki daripada satu file raksasa._

### 3️⃣ Error Message adalah Sahabat Setiamu 🤝

Jangan panik saat melihat layar merah/error! Anggap error message sebagai **GPS** yang memberitahumu:

- 📍 **Di mana** letak salahnya (File & Baris).
- ❓ **Apa** yang salah (Typo, variable hilang, atau rak database belum dibuat).
  > _Developer senior adalah pemula yang sudah melihat error lebih banyak dari orang lain._
  >

### 4️⃣ Kuasai Jurus Debugging `dd()` atau `Helper::json()`

Gunakan fungsi `dd()` (_Die and Dump_) atau `Helper::json()` untuk mengintip isi variabel di tengah jalan.

- **`dd($data)`**: Cocok untuk melihat data dalam format teks rapi di browser. Program langsung berhenti.
- **`Helper::json($data)`**: Cocok jika kamu sedang mengetes API atau ingin melihat data dalam format JSON murni.

```php
public function store(StoreUserRequest $request) {
    $data = $request->validated();

    // Pilih salah satu:
    dd($data);
    // ATAU
    return Helper::json($data);
}
```

_Gunakan ini jika kamu bingung kenapa data tidak tersimpan atau isinya kosong._

### 5️⃣ Konsistensi adalah Kunci (Naming Convention)

Gunakan nama yang manusiawi dan konsisten. Jika satu pakai Bahasa Inggris, semua pakai Bahasa Inggris.

- ✅ **Pro:** `UserController`, `UserService`, `UserRepository`.
- ❌ **Amatir:** `PelayanUser`, `User_Service`, `UsersRepo`.

### 6️⃣ Komentar: Jelaskan "Kenapa", Bukan "Apa"

- ❌ **Redundan:** `$name = $request->name; // Ambil nama` (Sudah jelas!)
- ✅ **Bermanfaat:** `// Potongan harga 10% karena sedang promo Ramadhan` (Memberi tahu alasan di balik logika).

### 7️⃣ Rahasianya Ada di `.env`

Jangan pernah menulis password database atau API Key langsung di dalam kode.

- Gunakan file `.env` untuk menyimpan "Konfigurasi Rahasia".
- Pastikan file `.env` tidak di-upload ke GitHub atau dibagikan ke sembarang orang.

### 8️⃣ Gunakan Git (Mesin Waktu Developer)

Belajarlah menggunakan **Git & GitHub**. Git memungkinkanmu untuk "save game". Jika kodinganmu rusak setelah seharian bekerja, kamu bisa melakukan **Undo** ke kondisi sebelumnya yang masih sehat.

### 9️⃣ Roadmap Belajar yang Sehat

Jangan mencoba belajar semuanya dalam semalam. Ikuti urutan ini:

1. **Level 1:** HTML, CSS Dasar, & Logika PHP (Bikin tampilan statis).
2. **Level 2:** MVC Dasar (Route, Controller, View).
3. **Level 3:** Database & Migration (Bikin rak penyimpanan).
4. **Level 4:** Arsitektur Pro (Service, Repository, API).

### 🔟 Join Komunitas & Jangan Berhenti Praktek

Koding adalah keterampilan otot (seperti main gitar). Semakin sering kamu mengetik, semakin jago jarimu. Jangan malu bertanya di forum seperti **StackOverflow, Forum Framework Indonesia, atau Grup Telegram.**

---

## 12. 🛠️ Mengenal Core Helpers & App Logic

Selain layer utama (MVC), framework ini memiliki "Alat Bantu" inti di folder `app/App` dan `app/Helpers` yang akan sering kamu panggil.

### 🎥 A. Logging (`app/App/Logging.php`)

**Analogi:** **Black Box Pesawat**.Dia mencatat segala sesuatu yang terjadi di dalam "penerbangan" aplikasi kamu. Jika terjadi kecelakaan (error), kamu tinggal buka Black Box ini untuk melihat penyebabnya.

- **Method Sering Pakai:** `Logging::getLogger()->info()` atau `error()`.
- **Cara Pakai:**

```php
use TheFramework\App\Logging;

// Mencatat kejadian penting
Logging::getLogger()->info("User {$user['id']} baru saja login.");

// Mencatat error fatal
Logging::getLogger()->error("Gagal koneksi ke database!");
```

| ✅ DO                                                                    | ❌ DON'T                                                           |
| :----------------------------------------------------------------------- | :----------------------------------------------------------------- |
| Catat aktivitas krusial (pembayaran, login, hapus data).                 | **Jangan catat data sensitif** seperti password user di log. |
| Gunakan Level `error` untuk masalah serius agar tampil di Slack/Email. | Jangan mencatat setiap klik tombol, nanti file log jadi raksasa.   |

---

### 🔑 B. SessionManager (`app/App/SessionManager.php`)

**Analogi:** **Kunci Loker Penitipan**.Saat tamu masuk ke restoran, mereka diberikan nomor loker. Selama mereka ada di restoran, mereka bisa menyimpan barang (data login) di loker tersebut. Saat mereka keluar (logout), loker dikosongkan.

- **Method Sering Pakai:** `startSecureSession()`, `destroySession()`.
- **Cara Pakai:**

```php
use TheFramework\App\SessionManager;

// Biasanya dipanggil otomatis oleh framework di index.php
SessionManager::startSecureSession();

// Untuk logout
SessionManager::destroySession();
```

| ✅ DO                                                                                | ❌ DON'T                                                                                               |
| :----------------------------------------------------------------------------------- | :----------------------------------------------------------------------------------------------------- |
| Selalu gunakan `regenerateSession()` setelah user login agar aman dari pembajakan. | **Jangan simpan data raksasa** (seperti hasil query ribuan baris) di session. Cukup ID-nya saja. |
| Biarkan framework yang mengurus start session di awal.                               | Jangan lupa panggil `destroySession` saat logout agar data benar-benar hilang.                       |

---

### 🇨🇭 C. Helper (`app/Helpers/Helper.php`)

**Analogi:** **Pisau Swiss Army**.Alat serbaguna yang berisi fungsi-fungsi kecil tetapi sangat berguna untuk mempersingkat pekerjaanmu di seluruh aplikasi.

- **Method Sering Pakai:** `Helper::redirect()`, `Helper::url()`, `Helper::old()`, `Helper::json()`.
- **Cara Pakai:**

```php
use TheFramework\Helpers\Helper;

// 1. Redirect dengan notifikasi
Helper::redirect('/home', 'success', 'Selamat Datang!');

// 2. Generate URL yang benar
$link = Helper::url('/css/style.css');

// 3. Menghasilkan respon JSON untuk API
Helper::json(['status' => 'ok', 'data' => $users]);

// 4. Mengambil input lama di form (UX)
<input value="<?= Helper::old('username') ?>">
```

| ✅ DO                                                                                 | ❌ DON'T                                                                                     |
| :------------------------------------------------------------------------------------ | :------------------------------------------------------------------------------------------- |
| Gunakan `Helper::e()` untuk menampilkan teks dari user agar aman dari hacker (XSS). | **Jangan buat logic bisnis di Helper.** Helper hanya untuk fungsi bantuan kecil.       |
| Gunakan `Helper::redirect()` untuk pindah halaman dengan rapi.                      | Jangan buat Helper terlalu gemuk. Jika sudah spesifik soal satu fitur, buatlah Service saja. |

---

## 🛠️ 13. Ringkasan Perintah Asisten (Artisan) - Cheat Sheet

| Perintah                          | Deskripsi Gampangnya                             |
| :-------------------------------- | :----------------------------------------------- |
| **🚀 Server & Setup**       |                                                  |
| `php artisan serve`             | Buka restoran (Jalankan server lokal)            |
| `php artisan setup`             | Rakit restoran (Setup awal .env & kunci)         |
| `php artisan optimize`          | Bersihkan sisa makanan (Hapus cache agar segar)  |
| **🛠️ Pembuatan Komponen** |                                                  |
| `php artisan make:controller`   | Rekrut Pelayan baru                              |
| `php artisan make:service`      | Rekrut Chef baru                                 |
| `php artisan make:repository`   | Bangun Gudang baru                               |
| `php artisan make:model -m`     | Bikin Rak & Label sekaligus (Model + Migration)  |
| `php artisan make:request`      | Bikin Form Cek Pesanan (Validasi)                |
| `php artisan make:crud Nama`    | **BOOM!** Bikin semua layer dalam 1 detik  |
| **🗄️ Database**           |                                                  |
| `php artisan migrate`           | Rakit rak fisik ke dalam gudang                  |
| `php artisan db:seed`           | Isi rak dengan contoh bahan uji coba             |
| `php artisan tinker`            | Ngobrol langsung dengan "Isi Rak" (Database CLI) |

---

**Selamat Belajar & Berkarya! 🚀**

Ingat: **Koding itu berat kalau cuma dilihat, tapi asik kalau langsung dipraktekkan.** Mulailah dari proyek kecil seperti web "Daftar Belanja" atau "Catatan Harian". Jangan takut salah, karena setiap _bug_ adalah pelajaran yang berharga.

**Happy Coding!** 💻☕🔥

**You got this! 💪**
