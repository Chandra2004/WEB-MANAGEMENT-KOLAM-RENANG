# 📜 Kontrak API - Group AUTH (Authentication Endpoints)

Dokumen ini menjelaskan spesifikasi antarmuka (interface) antara Back-end dan Front-end untuk endpoint-endpoint yang berhubungan dengan autentikasi pengguna.

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

## 🔐 Group: AUTH (Authentication Endpoints)

Group ini berisi endpoint-endpoint yang berhubungan dengan autentikasi pengguna (registrasi, login, dan lupa password).

### Tabel Ringkasan Endpoint AUTH

| No  | Method | Endpoint                   | Route Definition                                                                                                                                                                           | Deskripsi                   |
| :-: | :----: | :------------------------- | :----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | :-------------------------- |
|  1  |  GET   | `/register`                | `Router::add('GET', '/register', AuthController::class, 'registerView', [WAFMiddleware::class]);`                                                                                          | Halaman Registrasi          |
|  2  |  POST  | `/register/process`        | `Router::add('POST', '/register/process', AuthController::class, 'registerProcess', [WAFMiddleware::class, CsrfMiddleware::class, ThrottleRegisterMiddleware::class]);`                    | Proses Registrasi User Baru |
|  3  |  GET   | `/login`                   | `Router::add('GET', '/login', AuthController::class, 'loginView', [WAFMiddleware::class]);`                                                                                                | Halaman Login               |
|  4  |  POST  | `/login/process`           | `Router::add('POST', '/login/process', AuthController::class, 'loginProcess', [WAFMiddleware::class, CsrfMiddleware::class, ThrottleLoginMiddleware::class]);`                             | Proses Login User           |
|  5  |  GET   | `/forgot-password`         | `Router::add('GET', '/forgot-password', AuthController::class, 'forgotPasswordView', [WAFMiddleware::class]);`                                                                             | Halaman Lupa Password       |
|  6  |  POST  | `/forgot-password/process` | `Router::add('POST', '/forgot-password/process', AuthController::class, 'forgotPasswordProcess', [WAFMiddleware::class, CsrfMiddleware::class, ThrottleForgotPasswordMiddleware::class]);` | Proses Kirim Reset Password |

**Middleware Details:**

- `WAFMiddleware` - Web Application Firewall protection (semua routes)
- `CsrfMiddleware` - CSRF token validation (POST routes only)
- `ThrottleLoginMiddleware` - Rate limit: 5 attempts / 15 minutes
- `ThrottleRegisterMiddleware` - Rate limit: 3 registrations / 60 minutes per IP
- `ThrottleForgotPasswordMiddleware` - Rate limit: 3 requests / 60 minutes per email

---

## 📝 Endpoint: Register

### 1. Halaman Register

**URL**: `GET /register`

**Response**:

```json
{
  "notification": null,
  "title": "Khafid Swimming Club (KSC) - Official Website | Daftar Akun"
}
```

### 2. Proses Register

**URL**: `POST /register/process`

**Body Request (JSON/Form-Data)**:

```json
{
  "nama_lengkap": "Maman Abdurahman",
  "no_telepon": "085730676143",
  "email": "chandratriantomo123@gmail.com",
  "tanggal_lahir": "2026-02-19",
  "password": "28092004",
  "password_confirm": "28092004",
  "checkbox": "on"
}
```

#### 🏗️ Spesifikasi Implementasi Backend (Wajib)

1. **Aturan Validasi Custom (Controller: `AuthController::registerProcess`)**
   - **Email Unik**: Tidak boleh ada 2 akun dengan email yang sama.
   - **No Telepon Unik**: Tidak boleh ada 2 akun dengan nomor telepon yang sama.
   - **Logika**:
     - Panggil method model `User::checkEmail($email)`.
     - Panggil method model `User::checkNoTelepon($noTelepon)`.
     - **Kondisi Gagal**: Jika salah satu mengembalikan data (tidak null), return error.
     - **Kondisi Sukses**: Jika keduanya `null` (alias [null]), panggil `User::addUser($data)`.

2. **Metode Model (`User.php`)**

   **A. `checkEmail($email)`**
   - **Fungsi**: Cek ketersediaan email.
   - **Return Jika Ada (Sudah Terpakai)**:
     ```json
     [
       {
         "id_user": 1,
         "uid": "89686da1-42b4-45d6-aa7c-bafd3cf02531",
         "nama_lengkap": "Lisandro Padberg",
         "email": "alford.grant@hamill.com",
         "no_telepon": null,
         "tanggal_lahir": null,
         "nama_klub": null,
         "alamat": null,
         "foto_ktp": null,
         "foto_profil": null
       }
     ]
     ```
   - **Return Jika Kosong (Aman digunakan)**:
     ```json
     [null]
     ```

   **B. `checkNoTelepon($noTelepon)`**
   - **Fungsi**: Cek ketersediaan nomor telepon.
   - **Return**: Format sama dengan `checkEmail` (Objek User atau `[null]`).

   **C. `addUser($data)`**
   - **Fungsi**: Insert data user baru.
   - **Teknis**: Wajib menggunakan **Database Transactions** (Begin -> Commit/Rollback) untuk mencegah Race Conditions.
   - **Referensi**: Lihat `/docs/NOTED/IMPLEMENTASI.md` bagian _SECTION 6. DATABASE TRANSACTIONS & RACE CONDITIONS_.

**Validasi Field (Request Validation)**:

- `nama_lengkap`: required, string, max:255
- `no_telepon`: required, string, regex format Indo
- `email`: required, email
- `tanggal_lahir`: required, date
- `password`: required, string, min:8
- `password_confirm`: required, same:password
- `checkbox`: required, accepted ("on" atau true)

**Response (Success)**:

```json
{
  "notification": {
    "redirect": "/login",
    "status": "success",
    "message": "Registrasi berhasil! Silakan login untuk melanjutkan.",
    "expires_at": 1770955896,
    "duration": 5000
  }
}
```

**Response (Error - Validation Failed)**:

```json
{
  "notification": {
    "status": "error",
    "message": "Data yang Anda masukkan tidak valid. Silakan periksa kembali.",
    "expires_at": 1770956016,
    "duration": 7000
  },
  "errors": {
    "email": ["Email sudah terdaftar."],
    "password_confirm": ["Konfirmasi password tidak cocok."]
  }
}
```

---

## 🔑 Endpoint: Login

### 1. Halaman Login

**URL**: `GET /login`

**Response**:

```json
{
  "notification": null,
  "title": "Khafid Swimming Club (KSC) - Official Website | Masuk"
}
```

### 2. Proses Login

**URL**: `POST /login/process`

**Body Request (JSON/Form-Data)**:

```json
{
  "email": "chandratriantomo123@gmail.com",
  "password": "28092004",
  "checkbox": "on"
}
```

#### 🏗️ Spesifikasi Implementasi Backend (Wajib)

1. **Logika Proses (Controller: `AuthController::loginProcess`)**
   - **Cek User by Email**:
     - Panggil `User::checkEmail($email)`.
     - **Jika Return `[null]`**: Gagal (Email tidak ditemukan).
   - **Verifikasi Password**:
     - Ambil hash password dari data user yang ditemukan.
     - Gunakan `password_verify` atau `Helper::verify_password`.
     - **Jika Salah**: Gagal (Password salah).
   - **Logika Session**:
     - Jika Email & Password Benar:
       - Set session user.
       - Jika `checkbox` ("on"), set cookie "Remember Me".
       - Redirect ke Dashboard.

**Validasi Field**:

- `email`: required, string (bisa email atau username)
- `password`: required, string
- `checkbox`: optional, accepted ("on" atau true)

**Response (Success)**:

```json
{
  "notification": {
    "redirect": "/dashboard",
    "status": "success",
    "message": "Selamat datang, Budi Santoso!",
    "expires_at": 1770955896,
    "duration": 3000
  },
  "user": {
    "uid": "3a135818-c496-4a94-8bfc-a8d2ffc7b05b",
    "nama_lengkap": "Budi Santoso",
    "email": "budi@example.com",
    "foto_profil": null,
    "role": {
      "uid": "role-uuid-here",
      "nama_role": "user"
    }
  }
}
```

**Response (Error - Invalid Credentials)**:

```json
{
  "notification": {
    "status": "error",
    "message": "Email atau password yang Anda masukkan salah.",
    "expires_at": 1770956016,
    "duration": 5000
  }
}
```

**Response (Error - Account Not Activated)**:

```json
{
  "notification": {
    "status": "warning",
    "message": "Akun Anda belum diaktivasi. Silakan cek email Anda.",
    "expires_at": 1770956016,
    "duration": 7000
  }
}
```

---

## 🔒 Endpoint: Forgot Password

### 1. Halaman Lupa Password

**URL**: `GET /forgot-password`

**Response**:

```json
{
  "notification": null,
  "title": "Khafid Swimming Club (KSC) - Official Website | Lupa Password"
}
```

### 2. Proses Lupa Password

**URL**: `POST /forgot-password/process`

**Body Request (JSON/Form-Data)**:

```json
{
  "email": "chandratriantomo123@gmail.com"
}
```

#### 🏗️ Spesifikasi Implementasi Backend (Wajib)

1. **Logika Proses (Controller: `AuthController::forgotPasswordProcess`)**
   - **Cek User by Email**:
     - Panggil `User::checkEmail($email)`.
     - **Jika Return `[null]`**: Gagal (Email tidak ditemukan).
   - **Generate Token**:
     - Buat token random: `bin2hex(random_bytes(32))`.
   - **Simpan Token (Tanpa Database)**:
     - Gunakan **File-Based Cache** agar tidak mengotori database dan mencegah race condition.
     - **Key**: `password_reset_{email_hash}` (md5 email).
     - **Value**: JSON `{ "token": "...", "created_at": time() }`.
     - **TTL** (Time To Live): 3600 detik (1 Jam).
     - **Implementasi**:
       ```php
       use TheFramework\App\CacheManager;
       CacheManager::remember('password_reset_' . md5($email), 3600, function() use ($token) {
           return $token;
       });
       ```
   - **Kirim Email**:
     - Kirim link reset: `https://site.com/reset-password?token={token}&email={email}`.

**Validasi Field**:

- `email`: required, email

**Response (Success)**:

```json
{
  "notification": {
    "redirect": "/login",
    "status": "success",
    "message": "Instruksi reset password telah dikirim ke email Anda. Silakan cek inbox atau folder spam.",
    "expires_at": 1770955896,
    "duration": 8000
  }
}
```

**Response (Error - Email Not Found)**:

```json
{
  "notification": {
    "status": "error",
    "message": "Email tidak ditemukan. Silakan periksa kembali atau daftar akun baru.",
    "expires_at": 1770956016,
    "duration": 5000
  }
}
```

**Response (Warning - Rate Limit)**:

```json
{
  "notification": {
    "status": "warning",
    "message": "Anda sudah meminta reset password. Silakan cek email atau coba lagi dalam 5 menit.",
    "expires_at": 1770956016,
    "duration": 6000
  }
}
```

---

## 🛡️ Catatan Keamanan untuk Group AUTH

### 1. CSRF Protection

Semua POST request **WAJIB** menyertakan CSRF token.

**Implementasi Laravel:**

```php
@csrf
```

### 2. Rate Limiting

Batasi jumlah request untuk mencegah brute force dan abuse:

| Endpoint                        | Limit        | Waktu           | Action Jika Exceed |
| ------------------------------- | ------------ | --------------- | ------------------ |
| `POST /login/process`           | 5 percobaan  | 15 menit        | Block IP temporary |
| `POST /register/process`        | 3 registrasi | 1 jam           | Return error 429   |
| `POST /forgot-password/process` | 3 request    | 1 jam per email | Return warning     |

### 3. Password Hashing

Gunakan **bcrypt** dengan cost minimal **10** untuk hashing password.

**Implementasi Laravel:**

```php
$hashedPassword = Helper::hash_password($request->password);
```

### 4. Email Verification (Optional)

Untuk keamanan tambahan, implementasikan verifikasi email setelah registrasi:

1. Generate verification token saat registrasi
2. Kirim email dengan link verifikasi
3. User harus klik link sebelum bisa login
4. Token expire dalam 24 jam

### 5. Password Reset Token

Untuk fitur forgot password:

**Requirements:**

- Token harus **expire dalam 1 jam**
- **One-time use only** (hapus setelah digunakan)
- Minimum **32 karakter** random string
- Simpan **hashed token** di database, bukan plain text

---

## 📋 Checklist Implementasi Backend

- [ ] Setup CSRF protection untuk semua POST endpoints
- [ ] Implementasi rate limiting (login: 5/15min, register: 3/hour, forgot: 3/hour)
- [ ] Password hashing dengan bcrypt (cost 10)
- [ ] Session security flags (`httpOnly`, `secure`, `sameSite`)
- [ ] Password reset token system (1 hour expiry, one-time use)
- [ ] Email verification (optional)
- [ ] Input validation & sanitization
- [ ] Logging untuk audit trail
- [ ] Error handling yang proper (jangan expose sensitive info)
- [ ] Return consistent response structure

---

## 📋 Checklist Implementasi Frontend

- [ ] CSRF token di semua form
- [ ] Handle notification system (toast/alert dengan auto-hide)
- [ ] Handle redirect dari response
- [ ] Display validation errors per field
- [ ] Password strength indicator (optional)
- [ ] "Show/Hide Password" toggle
- [ ] "Remember Me" checkbox functionality
- [ ] Loading state saat submit form
- [ ] Disable button saat processing untuk prevent double submit

---

## 🔗 Referensi

- Group lain: `.BACKUP/PROJECT-CONTRACT/GUEST-CONTRACT.md`

---

## 📋 Panduan Implementasi Forgot Password (Lengkap)

### 1. Routes (`routes/web.php`)

```php
use TheFramework\Http\Controllers\AuthController;
use TheFramework\Middleware\WAFMiddleware;
use TheFramework\Middleware\CsrfMiddleware;
use TheFramework\Middleware\ThrottleForgotPasswordMiddleware;

Router::group(['middleware' => [WAFMiddleware::class]], function () {
    // 1. Halaman Form Lupa Password
    Router::add('GET', '/forgot-password', AuthController::class, 'forgotPasswordView');

    // 2. Proses Kirim Link Reset (Rate Limit: 3x/jam)
    Router::add('POST', '/forgot-password/process', AuthController::class, 'forgotPasswordProcess', [
        CsrfMiddleware::class,
        ThrottleForgotPasswordMiddleware::class
    ]);

    // 3. Halaman Form Reset Password (dari Email)
    Router::add('GET', '/reset-password', AuthController::class, 'resetPasswordView');

    // 4. Proses Update Password Baru
    Router::add('POST', '/reset-password/process', AuthController::class, 'resetPasswordProcess', [
        CsrfMiddleware::class
    ]);
});
```

### 2. Form Requests (Validasi Terpisah)

Buat class request secara manual atau via artisan (jika didukung). Letakkan di `app/Http/Requests/Auth/`.

**A. `ForgotPasswordRequest.php`**

```php
namespace TheFramework\Http\Requests\Auth;

use TheFramework\App\FormRequest;

class ForgotPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email' // Validasi email wajib ada di DB
        ];
    }
}
```

**B. `ResetPasswordRequest.php`**

```php
namespace TheFramework\Http\Requests\Auth;

use TheFramework\App\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email'            => 'required|email',
            'token'            => 'required',
            'password'         => 'required|min:8',
            'password_confirm' => 'required|same:password'
        ];
    }
}
```

### 3. Controller (`app/Http/Controllers/AuthController.php`)

```php
namespace TheFramework\Http\Controllers;

use TheFramework\App\Request;
use TheFramework\App\CacheManager;
use TheFramework\Helpers\Helper;
use TheFramework\Models\User;
// Import Request Classes
use TheFramework\Http\Requests\Auth\ForgotPasswordRequest;
use TheFramework\Http\Requests\Auth\ResetPasswordRequest;

class AuthController
{
    /**
     * Tampilkan form lupa password
     */
    public function forgotPasswordView()
    {
        return view('auth.forgot-password', ['title' => 'Lupa Password']);
    }

    /**
     * Proses generate token & kirim email (Mockup)
     * Menggunakan: ForgotPasswordRequest (Auto Validasi)
     */
    public function forgotPasswordProcess(ForgotPasswordRequest $request)
    {
        // 1. Ambil input tervalidasi
        $validated = $request->validated();
        $email = $validated['email'];

        // 2. Generate Token (32 bytes = 64 chars hex)
        $token = bin2hex(random_bytes(32));

        // 3. Simpan ke File Cache (Durasi 1 Jam)
        // Key: password_reset_MD5EMAIL
        $cacheKey = 'password_reset_' . md5($email);

        CacheManager::remember($cacheKey, 3600, function() use ($token) {
            return $token; // Closure ini hanya jalan jika cache belum ada/expired
        });

        // 4. Generate Link Reset
        // Format: /reset-password?email=...&token=...
        $link = Helper::url("/reset-password?email={$email}&token={$token}");

        // 5. Simulasi Kirim Email (Log ke Flash Message)
        return Helper::redirect('/login', 'success', "Link Reset: $link (Cek Email Anda)");
    }

    /**
     * Tampilkan form ganti password (validasi token di awal)
     */
    public function resetPasswordView(Request $request)
    {
        $email = $request->input('email');
        $token = $request->input('token');

        if (!$email || !$token) {
            return Helper::redirect('/forgot-password', 'error', 'Link tidak valid.');
        }

        return view('auth.reset-password', [
            'title' => 'Reset Password',
            'email' => $email,
            'token' => $token
        ]);
    }

    /**
     * Proses update password baru
     * Menggunakan: ResetPasswordRequest (Auto Validasi)
     */
    public function resetPasswordProcess(ResetPasswordRequest $request)
    {
        // 1. Ambil input tervalidasi
        $validated = $request->validated();
        $email = $validated['email'];
        $inputToken = $validated['token'];
        $newPassword = $validated['password'];

        // 2. Ambil Token dari Cache
        $cacheKey = 'password_reset_' . md5($email);

        // Trik: remember dengan return null, jika expired/hilang akan return null
        $cachedToken = CacheManager::remember($cacheKey, 3600, function() {
            return null;
        });

        // 3. Validasi Token (Harus Sama Persis & Tidak Expired)
        if (!$cachedToken || !hash_equals($cachedToken, $inputToken)) {
            return Helper::redirect('/forgot-password', 'error', 'Token kadaluarsa atau tidak valid.');
        }

        // 4. Update Password User
        $hashed = password_hash($newPassword, PASSWORD_BCRYPT);

        // Gunakan Model User update logic (Raw Query / Query Builder)
        User::where('email', $email)->update(['password' => $hashed]);

        // 5. Hapus Token (One-Time Use)
        CacheManager::forget($cacheKey);

        return Helper::redirect('/login', 'success', 'Password berhasil diubah. Silakan login.');
    }
}
```

### 3. View (`resources/views/auth/reset-password.blade.php`)

Pastikan form reset password mengirim `token` dan `email` sebagai hidden input.

```html
<form action="/reset-password/process" method="POST">
  <input type="hidden" name="_token" value="{{ csrf_token() }}" />

  <!-- Hidden Fields Penting -->
  <input type="hidden" name="email" value="{{ $email }}" />
  <input type="hidden" name="token" value="{{ $token }}" />

  <div class="form-group">
    <label>Password Baru</label>
    <input type="password" name="password" class="form-control" required />
    @if(has_error('password'))
    <span class="text-danger">{{ error('password') }}</span>
    @endif
  </div>

  <div class="form-group">
    <label>Konfirmasi Password</label>
    <input
      type="password"
      name="password_confirm"
      class="form-control"
      required
    />
    @if(has_error('password_confirm'))
    <span class="text-danger">{{ error('password_confirm') }}</span>
    @endif
  </div>

  <button type="submit" class="btn btn-primary">Reset Password</button>
</form>
```
# 📜 Kontrak API - Group AUTH (Authentication Endpoints)

Dokumen ini menjelaskan spesifikasi antarmuka (interface) antara Back-end dan Front-end untuk endpoint-endpoint yang berhubungan dengan autentikasi pengguna.

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

## 🔐 Group: AUTH (Authentication Endpoints)

Group ini berisi endpoint-endpoint yang berhubungan dengan autentikasi pengguna (registrasi, login, dan lupa password).

### Tabel Ringkasan Endpoint AUTH

| No  | Method | Endpoint                   | Route Definition                                                                                                                                                                           | Deskripsi                   |
| :-: | :----: | :------------------------- | :----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | :-------------------------- |
|  1  |  GET   | `/register`                | `Router::add('GET', '/register', AuthController::class, 'registerView', [WAFMiddleware::class]);`                                                                                          | Halaman Registrasi          |
|  2  |  POST  | `/register/process`        | `Router::add('POST', '/register/process', AuthController::class, 'registerProcess', [WAFMiddleware::class, CsrfMiddleware::class, ThrottleRegisterMiddleware::class]);`                    | Proses Registrasi User Baru |
|  3  |  GET   | `/login`                   | `Router::add('GET', '/login', AuthController::class, 'loginView', [WAFMiddleware::class]);`                                                                                                | Halaman Login               |
|  4  |  POST  | `/login/process`           | `Router::add('POST', '/login/process', AuthController::class, 'loginProcess', [WAFMiddleware::class, CsrfMiddleware::class, ThrottleLoginMiddleware::class]);`                             | Proses Login User           |
|  5  |  GET   | `/forgot-password`         | `Router::add('GET', '/forgot-password', AuthController::class, 'forgotPasswordView', [WAFMiddleware::class]);`                                                                             | Halaman Lupa Password       |
|  6  |  POST  | `/forgot-password/process` | `Router::add('POST', '/forgot-password/process', AuthController::class, 'forgotPasswordProcess', [WAFMiddleware::class, CsrfMiddleware::class, ThrottleForgotPasswordMiddleware::class]);` | Proses Kirim Reset Password |

**Middleware Details:**

- `WAFMiddleware` - Web Application Firewall protection (semua routes)
- `CsrfMiddleware` - CSRF token validation (POST routes only)
- `ThrottleLoginMiddleware` - Rate limit: 5 attempts / 15 minutes
- `ThrottleRegisterMiddleware` - Rate limit: 3 registrations / 60 minutes per IP
- `ThrottleForgotPasswordMiddleware` - Rate limit: 3 requests / 60 minutes per email

---

## 📝 Endpoint: Register

### 1. Halaman Register

**URL**: `GET /register`

**Response**:

```json
{
  "notification": null,
  "title": "Khafid Swimming Club (KSC) - Official Website | Daftar Akun"
}
```

### 2. Proses Register

**URL**: `POST /register/process`

**Body Request (JSON/Form-Data)**:

```json
{
  "nama_lengkap": "Maman Abdurahman",
  "no_telepon": "085730676143",
  "email": "chandratriantomo123@gmail.com",
  "tanggal_lahir": "2026-02-19",
  "password": "28092004",
  "password_confirm": "28092004",
  "checkbox": "on"
}
```

#### 🏗️ Spesifikasi Implementasi Backend (Wajib)

1. **Aturan Validasi Custom (Controller: `AuthController::registerProcess`)**
   - **Email Unik**: Tidak boleh ada 2 akun dengan email yang sama.
   - **No Telepon Unik**: Tidak boleh ada 2 akun dengan nomor telepon yang sama.
   - **Logika**:
     - Panggil method model `User::checkEmail($email)`.
     - Panggil method model `User::checkNoTelepon($noTelepon)`.
     - **Kondisi Gagal**: Jika salah satu mengembalikan data (tidak null), return error.
     - **Kondisi Sukses**: Jika keduanya `null` (alias [null]), panggil `User::addUser($data)`.

2. **Metode Model (`User.php`)**

   **A. `checkEmail($email)`**
   - **Fungsi**: Cek ketersediaan email.
   - **Return Jika Ada (Sudah Terpakai)**:
     ```json
     [
       {
         "id_user": 1,
         "uid": "89686da1-42b4-45d6-aa7c-bafd3cf02531",
         "nama_lengkap": "Lisandro Padberg",
         "email": "alford.grant@hamill.com",
         "no_telepon": null,
         "tanggal_lahir": null,
         "nama_klub": null,
         "alamat": null,
         "foto_ktp": null,
         "foto_profil": null
       }
     ]
     ```
   - **Return Jika Kosong (Aman digunakan)**:
     ```json
     [null]
     ```

   **B. `checkNoTelepon($noTelepon)`**
   - **Fungsi**: Cek ketersediaan nomor telepon.
   - **Return**: Format sama dengan `checkEmail` (Objek User atau `[null]`).

   **C. `addUser($data)`**
   - **Fungsi**: Insert data user baru.
   - **Teknis**: Wajib menggunakan **Database Transactions** (Begin -> Commit/Rollback) untuk mencegah Race Conditions.
   - **Referensi**: Lihat `/docs/NOTED/IMPLEMENTASI.md` bagian _SECTION 6. DATABASE TRANSACTIONS & RACE CONDITIONS_.

**Validasi Field (Request Validation)**:

- `nama_lengkap`: required, string, max:255
- `no_telepon`: required, string, regex format Indo
- `email`: required, email
- `tanggal_lahir`: required, date
- `password`: required, string, min:8
- `password_confirm`: required, same:password
- `checkbox`: required, accepted ("on" atau true)

**Response (Success)**:

```json
{
  "notification": {
    "redirect": "/login",
    "status": "success",
    "message": "Registrasi berhasil! Silakan login untuk melanjutkan.",
    "expires_at": 1770955896,
    "duration": 5000
  }
}
```

**Response (Error - Validation Failed)**:

```json
{
  "notification": {
    "status": "error",
    "message": "Data yang Anda masukkan tidak valid. Silakan periksa kembali.",
    "expires_at": 1770956016,
    "duration": 7000
  },
  "errors": {
    "email": ["Email sudah terdaftar."],
    "password_confirm": ["Konfirmasi password tidak cocok."]
  }
}
```

---

## 🔑 Endpoint: Login

### 1. Halaman Login

**URL**: `GET /login`

**Response**:

```json
{
  "notification": null,
  "title": "Khafid Swimming Club (KSC) - Official Website | Masuk"
}
```

### 2. Proses Login

**URL**: `POST /login/process`

**Body Request (JSON/Form-Data)**:

```json
{
  "email": "chandratriantomo123@gmail.com",
  "password": "28092004",
  "checkbox": "on"
}
```

#### 🏗️ Spesifikasi Implementasi Backend (Wajib)

1. **Logika Proses (Controller: `AuthController::loginProcess`)**
   - **Cek User by Email**:
     - Panggil `User::checkEmail($email)`.
     - **Jika Return `[null]`**: Gagal (Email tidak ditemukan).
   - **Verifikasi Password**:
     - Ambil hash password dari data user yang ditemukan.
     - Gunakan `password_verify` atau `Helper::verify_password`.
     - **Jika Salah**: Gagal (Password salah).
   - **Logika Session**:
     - Jika Email & Password Benar:
       - Set session user.
       - Jika `checkbox` ("on"), set cookie "Remember Me".
       - Redirect ke Dashboard.

**Validasi Field**:

- `email`: required, string (bisa email atau username)
- `password`: required, string
- `checkbox`: optional, accepted ("on" atau true)

**Response (Success)**:

```json
{
  "notification": {
    "redirect": "/dashboard",
    "status": "success",
    "message": "Selamat datang, Budi Santoso!",
    "expires_at": 1770955896,
    "duration": 3000
  },
  "user": {
    "uid": "3a135818-c496-4a94-8bfc-a8d2ffc7b05b",
    "nama_lengkap": "Budi Santoso",
    "email": "budi@example.com",
    "foto_profil": null,
    "role": {
      "uid": "role-uuid-here",
      "nama_role": "user"
    }
  }
}
```

**Response (Error - Invalid Credentials)**:

```json
{
  "notification": {
    "status": "error",
    "message": "Email atau password yang Anda masukkan salah.",
    "expires_at": 1770956016,
    "duration": 5000
  }
}
```

**Response (Error - Account Not Activated)**:

```json
{
  "notification": {
    "status": "warning",
    "message": "Akun Anda belum diaktivasi. Silakan cek email Anda.",
    "expires_at": 1770956016,
    "duration": 7000
  }
}
```

---

## 🔒 Endpoint: Forgot Password

### 1. Halaman Lupa Password

**URL**: `GET /forgot-password`

**Response**:

```json
{
  "notification": null,
  "title": "Khafid Swimming Club (KSC) - Official Website | Lupa Password"
}
```

### 2. Proses Lupa Password

**URL**: `POST /forgot-password/process`

**Body Request (JSON/Form-Data)**:

```json
{
  "email": "chandratriantomo123@gmail.com"
}
```

#### 🏗️ Spesifikasi Implementasi Backend (Wajib)

1. **Logika Proses (Controller: `AuthController::forgotPasswordProcess`)**
   - **Cek User by Email**:
     - Panggil `User::checkEmail($email)`.
     - **Jika Return `[null]`**: Gagal (Email tidak ditemukan).
   - **Generate Token**:
     - Buat token random: `bin2hex(random_bytes(32))`.
   - **Simpan Token (Tanpa Database)**:
     - Gunakan **File-Based Cache** agar tidak mengotori database dan mencegah race condition.
     - **Key**: `password_reset_{email_hash}` (md5 email).
     - **Value**: JSON `{ "token": "...", "created_at": time() }`.
     - **TTL** (Time To Live): 3600 detik (1 Jam).
     - **Implementasi**:
       ```php
       use TheFramework\App\CacheManager;
       CacheManager::remember('password_reset_' . md5($email), 3600, function() use ($token) {
           return $token;
       });
       ```
   - **Kirim Email**:
     - Kirim link reset: `https://site.com/reset-password?token={token}&email={email}`.

**Validasi Field**:

- `email`: required, email

**Response (Success)**:

```json
{
  "notification": {
    "redirect": "/login",
    "status": "success",
    "message": "Instruksi reset password telah dikirim ke email Anda. Silakan cek inbox atau folder spam.",
    "expires_at": 1770955896,
    "duration": 8000
  }
}
```

**Response (Error - Email Not Found)**:

```json
{
  "notification": {
    "status": "error",
    "message": "Email tidak ditemukan. Silakan periksa kembali atau daftar akun baru.",
    "expires_at": 1770956016,
    "duration": 5000
  }
}
```

**Response (Warning - Rate Limit)**:

```json
{
  "notification": {
    "status": "warning",
    "message": "Anda sudah meminta reset password. Silakan cek email atau coba lagi dalam 5 menit.",
    "expires_at": 1770956016,
    "duration": 6000
  }
}
```

---

## 🛡️ Catatan Keamanan untuk Group AUTH

### 1. CSRF Protection

Semua POST request **WAJIB** menyertakan CSRF token.

**Implementasi Laravel:**

```php
@csrf
```

### 2. Rate Limiting

Batasi jumlah request untuk mencegah brute force dan abuse:

| Endpoint                        | Limit        | Waktu           | Action Jika Exceed |
| ------------------------------- | ------------ | --------------- | ------------------ |
| `POST /login/process`           | 5 percobaan  | 15 menit        | Block IP temporary |
| `POST /register/process`        | 3 registrasi | 1 jam           | Return error 429   |
| `POST /forgot-password/process` | 3 request    | 1 jam per email | Return warning     |

### 3. Password Hashing

Gunakan **bcrypt** dengan cost minimal **10** untuk hashing password.

**Implementasi Laravel:**

```php
$hashedPassword = Helper::hash_password($request->password);
```

### 4. Email Verification (Optional)

Untuk keamanan tambahan, implementasikan verifikasi email setelah registrasi:

1. Generate verification token saat registrasi
2. Kirim email dengan link verifikasi
3. User harus klik link sebelum bisa login
4. Token expire dalam 24 jam

### 5. Password Reset Token

Untuk fitur forgot password:

**Requirements:**

- Token harus **expire dalam 1 jam**
- **One-time use only** (hapus setelah digunakan)
- Minimum **32 karakter** random string
- Simpan **hashed token** di database, bukan plain text

---

## 📋 Checklist Implementasi Backend

- [ ] Setup CSRF protection untuk semua POST endpoints
- [ ] Implementasi rate limiting (login: 5/15min, register: 3/hour, forgot: 3/hour)
- [ ] Password hashing dengan bcrypt (cost 10)
- [ ] Session security flags (`httpOnly`, `secure`, `sameSite`)
- [ ] Password reset token system (1 hour expiry, one-time use)
- [ ] Email verification (optional)
- [ ] Input validation & sanitization
- [ ] Logging untuk audit trail
- [ ] Error handling yang proper (jangan expose sensitive info)
- [ ] Return consistent response structure

---

## 📋 Checklist Implementasi Frontend

- [ ] CSRF token di semua form
- [ ] Handle notification system (toast/alert dengan auto-hide)
- [ ] Handle redirect dari response
- [ ] Display validation errors per field
- [ ] Password strength indicator (optional)
- [ ] "Show/Hide Password" toggle
- [ ] "Remember Me" checkbox functionality
- [ ] Loading state saat submit form
- [ ] Disable button saat processing untuk prevent double submit

---

## 🔗 Referensi

- Group lain: `.BACKUP/PROJECT-CONTRACT/GUEST-CONTRACT.md`

---

## 📋 Panduan Implementasi Forgot Password (Lengkap)

### 1. Routes (`routes/web.php`)

```php
use TheFramework\Http\Controllers\AuthController;
use TheFramework\Middleware\WAFMiddleware;
use TheFramework\Middleware\CsrfMiddleware;
use TheFramework\Middleware\ThrottleForgotPasswordMiddleware;

Router::group(['middleware' => [WAFMiddleware::class]], function () {
    // 1. Halaman Form Lupa Password
    Router::add('GET', '/forgot-password', AuthController::class, 'forgotPasswordView');

    // 2. Proses Kirim Link Reset (Rate Limit: 3x/jam)
    Router::add('POST', '/forgot-password/process', AuthController::class, 'forgotPasswordProcess', [
        CsrfMiddleware::class,
        ThrottleForgotPasswordMiddleware::class
    ]);

    // 3. Halaman Form Reset Password (dari Email)
    Router::add('GET', '/reset-password', AuthController::class, 'resetPasswordView');

    // 4. Proses Update Password Baru
    Router::add('POST', '/reset-password/process', AuthController::class, 'resetPasswordProcess', [
        CsrfMiddleware::class
    ]);
});
```

### 2. Form Requests (Validasi Terpisah)

Buat class request secara manual atau via artisan (jika didukung). Letakkan di `app/Http/Requests/Auth/`.

**A. `ForgotPasswordRequest.php`**

```php
namespace TheFramework\Http\Requests\Auth;

use TheFramework\App\FormRequest;

class ForgotPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email' // Validasi email wajib ada di DB
        ];
    }
}
```

**B. `ResetPasswordRequest.php`**

```php
namespace TheFramework\Http\Requests\Auth;

use TheFramework\App\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email'            => 'required|email',
            'token'            => 'required',
            'password'         => 'required|min:8',
            'password_confirm' => 'required|same:password'
        ];
    }
}
```

### 3. Controller (`app/Http/Controllers/AuthController.php`)

```php
namespace TheFramework\Http\Controllers;

use TheFramework\App\Request;
use TheFramework\App\CacheManager;
use TheFramework\Helpers\Helper;
use TheFramework\Models\User;
// Import Request Classes
use TheFramework\Http\Requests\Auth\ForgotPasswordRequest;
use TheFramework\Http\Requests\Auth\ResetPasswordRequest;

class AuthController
{
    /**
     * Tampilkan form lupa password
     */
    public function forgotPasswordView()
    {
        return view('auth.forgot-password', ['title' => 'Lupa Password']);
    }

    /**
     * Proses generate token & kirim email (Mockup)
     * Menggunakan: ForgotPasswordRequest (Auto Validasi)
     */
    public function forgotPasswordProcess(ForgotPasswordRequest $request)
    {
        // 1. Ambil input tervalidasi
        $validated = $request->validated();
        $email = $validated['email'];

        // 2. Generate Token (32 bytes = 64 chars hex)
        $token = bin2hex(random_bytes(32));

        // 3. Simpan ke File Cache (Durasi 1 Jam)
        // Key: password_reset_MD5EMAIL
        $cacheKey = 'password_reset_' . md5($email);

        CacheManager::remember($cacheKey, 3600, function() use ($token) {
            return $token; // Closure ini hanya jalan jika cache belum ada/expired
        });

        // 4. Generate Link Reset
        // Format: /reset-password?email=...&token=...
        $link = Helper::url("/reset-password?email={$email}&token={$token}");

        // 5. Simulasi Kirim Email (Log ke Flash Message)
        return Helper::redirect('/login', 'success', "Link Reset: $link (Cek Email Anda)");
    }

    /**
     * Tampilkan form ganti password (validasi token di awal)
     */
    public function resetPasswordView(Request $request)
    {
        $email = $request->input('email');
        $token = $request->input('token');

        if (!$email || !$token) {
            return Helper::redirect('/forgot-password', 'error', 'Link tidak valid.');
        }

        return view('auth.reset-password', [
            'title' => 'Reset Password',
            'email' => $email,
            'token' => $token
        ]);
    }

    /**
     * Proses update password baru
     * Menggunakan: ResetPasswordRequest (Auto Validasi)
     */
    public function resetPasswordProcess(ResetPasswordRequest $request)
    {
        // 1. Ambil input tervalidasi
        $validated = $request->validated();
        $email = $validated['email'];
        $inputToken = $validated['token'];
        $newPassword = $validated['password'];

        // 2. Ambil Token dari Cache
        $cacheKey = 'password_reset_' . md5($email);

        // Trik: remember dengan return null, jika expired/hilang akan return null
        $cachedToken = CacheManager::remember($cacheKey, 3600, function() {
            return null;
        });

        // 3. Validasi Token (Harus Sama Persis & Tidak Expired)
        if (!$cachedToken || !hash_equals($cachedToken, $inputToken)) {
            return Helper::redirect('/forgot-password', 'error', 'Token kadaluarsa atau tidak valid.');
        }

        // 4. Update Password User
        $hashed = password_hash($newPassword, PASSWORD_BCRYPT);

        // Gunakan Model User update logic (Raw Query / Query Builder)
        User::where('email', $email)->update(['password' => $hashed]);

        // 5. Hapus Token (One-Time Use)
        CacheManager::forget($cacheKey);

        return Helper::redirect('/login', 'success', 'Password berhasil diubah. Silakan login.');
    }
}
```

### 3. View (`resources/views/auth/reset-password.blade.php`)

Pastikan form reset password mengirim `token` dan `email` sebagai hidden input.

```html
<form action="/reset-password/process" method="POST">
  <input type="hidden" name="_token" value="{{ csrf_token() }}" />

  <!-- Hidden Fields Penting -->
  <input type="hidden" name="email" value="{{ $email }}" />
  <input type="hidden" name="token" value="{{ $token }}" />

  <div class="form-group">
    <label>Password Baru</label>
    <input type="password" name="password" class="form-control" required />
    @if(has_error('password'))
    <span class="text-danger">{{ error('password') }}</span>
    @endif
  </div>

  <div class="form-group">
    <label>Konfirmasi Password</label>
    <input
      type="password"
      name="password_confirm"
      class="form-control"
      required
    />
    @if(has_error('password_confirm'))
    <span class="text-danger">{{ error('password_confirm') }}</span>
    @endif
  </div>

  <button type="submit" class="btn btn-primary">Reset Password</button>
</form>
```
