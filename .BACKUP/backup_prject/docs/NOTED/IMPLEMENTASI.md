# 🚀 PANDUAN ULTIMATE PENGEMBANGAN THEFRAMEWORK

**Edisi The Complete Active Record & Full Stack Architecture Guide**

> Dokumen referensi teknis paling komprehensif untuk mengembangkan aplikasi enterprise menggunakan TheFramework. Panduan ini mencerminkan fitur-fitur terbaru: **Active Record ORM**, **Powerful Validation**, **Relation Management**, dan **Transaction Handling**.

---

## 📋 DAFTAR ISI

1. [Arsitektur &amp; Request Lifecycle](#1-arsitektur--request-lifecycle)
2. [Layer-by-Layer Breakdown](#2-layer-by-layer-breakdown)
3. [Model &amp; ORM Active Record](#3-model--orm-active-record)
4. [Database Relationships](#4-database-relationships)
5. [Validation System](#5-validation-system)
6. [Database Transactions &amp; Race Conditions](#6-database-transactions--race-conditions)
7. [Tutorial: Authentication System](#7-tutorial-authentication-system)
8. [Tutorial: Blog CMS Full Stack](#8-tutorial-blog-cms-full-stack)
9. [Best Practices &amp; Tips](#9-best-practices--tips)
10. [Session Management &amp; Security](#10-session-management--security)
11. [Architecture Deep Dive](#11-architecture-deep-dive)

---

## 🏗️ 1. ARSITEKTUR & REQUEST LIFECYCLE

TheFramework menggunakan arsitektur berlapis yang clean dan scalable:

```
HTTP Request
    ↓
┌─────────────────────────────────────────┐
│  1. Router (routes/web.php)             │  ← Mencocokkan URL
├─────────────────────────────────────────┤
│  2. Middleware (app/Middleware/)        │  ← Auth, CSRF, Logging
├─────────────────────────────────────────┤
│  3. Request Validation (FormRequest)    │  ← Auto-validation & Otorisasi
├─────────────────────────────────────────┤
│  4. Controller (app/Http/Controllers/)  │  ← Orchestrator (Thin)
│     ↓                                   │
│  5. Service (app/Services/)             │  ← Business Logic & Processing
│     ↓                                   │
│  6. Model (app/Models/)                 │  ← ORM Active Record & Database
├─────────────────────────────────────────┤
│  7. View (resources/views/)             │  ← Blade Engine Render
└─────────────────────────────────────────┘
    ↓
HTTP Response
```

**Prinsip Separation of Concerns:**

- **Controller**: Hanya mengatur alur (_orchestrate_), JANGAN ada logika bisnis. Panggil Service dan kembalikan View/JSON.
- **Service**: Jantung aplikasi. Tempat logika bisnis, pengolahan data kompleks, dan penanganan file.
- **Model**: Representasi tabel database. Langsung menangani query via ORM atau Query Builder.
- **View**: Hanya menampilkan data menggunakan Blade. Tidak boleh ada query database di View.

---

## 📦 2. LAYER-BY-LAYER BREAKDOWN

### A. Route Layer (`routes/web.php`)

Route mendefinisikan endpoint dan mapping ke Controller menggunakan method `add()` atau `group()`.

```php
use TheFramework\App\Router;
use TheFramework\Http\Controllers\HomeController;
use TheFramework\Middleware\WAFMiddleware;
use TheFramework\Middleware\CsrfMiddleware;
use TheFramework\Middleware\LanguageMiddleware;

// 1. Basic Route
Router::add('GET', '/', HomeController::class, 'Welcome', [WAFMiddleware::class, LanguageMiddleware::class]);

// 2. Route with Parameters & Grouping
Router::group(
    [
        'prefix' => '/users',
        'middleware' => [
            CsrfMiddleware::class,
            WAFMiddleware::class,
            LanguageMiddleware::class
        ]
    ],
    function () {
        Router::add('GET', '/', HomeController::class, 'Users'); // Hasil: /users
        Router::add('POST', '/create', HomeController::class, 'CreateUser'); // Hasil: /users/create
        Router::add('POST', '/update/{uid}', HomeController::class, 'UpdateUser'); // Dynamic param {uid}
        Router::add('POST', '/delete/{uid}', HomeController::class, 'DeleteUser');
        Router::add('GET', '/information/{uid}', HomeController::class, 'InformationUser');
    }
);
```

**Poin Penting:**

- **Method**: Gunakan string `GET`, `POST`, dll sebagai parameter pertama di `Router::add()`.
- **Middleware**: Masukkan Middleware dalam bentuk array class constant (e.g. `[AuthMiddleware::class]`).
- **Grouping**: Gunakan `Router::group()` untuk mengelompokkan route dengan prefix dan middleware yang sama agar kode lebih clean.

---

### B. Middleware Layer (`app/Middleware/`)

Middleware memfilter request sebelum atau sesudah masuk ke Controller dengan mengimplementasikan `Middleware` interface.

**Struktur Middleware:**
Setiap middleware wajib memiliki method `before()` dan `after()`.

**Contoh: AuthMiddleware**

```php
namespace TheFramework\Middleware;

use TheFramework\Helpers\Helper;

class AuthMiddleware implements Middleware {
    public function before() {
        // Cek apakah user sudah login melalui Helper
        if (!Helper::session_get('user')) {
            // Redirect ke halaman login menggunakan Helper
            return Helper::redirect('/login', 'error', 'Silakan login terlebih dahulu.');
        }
    }

    public function after() {
        // Logika setelah controller dieksekusi (opsional)
    }
}
```

**Daftar Middleware Bawaan:**

- `WAFMiddleware`: Proteksi keamanan tingkat tinggi (XSS, SQL Injection, dll).
- `AuthMiddleware`: Validasi sesi user login untuk halaman web.
- `ApiAuthMiddleware`: Validasi token untuk akses API.
- `CsrfMiddleware`: Validasi CSRF token pada setiap request POST.
- `LanguageMiddleware`: Pengaturan bahasa aplikasi (Multi-language support).

---

### C. Request Layer (`app/Http/Requests/`)

Request object mengabstraksi data input user dan menangani validasi serta otorisasi secara otomatis sebelum masuk ke logic Controller.

**Contoh: CreatePostRequest**

```php
namespace TheFramework\Http\Requests;

use TheFramework\App\FormRequest;
use TheFramework\Helpers\Helper;

class CreatePostRequest extends FormRequest {
    /**
     * Otorisasi: Cek apakah user punya izin melakukan request ini melalui Helper
     */
    public function authorize(): bool {
        return Helper::session_get('user') !== null;
    }

    /**
     * Rules: Definisi aturan validasi
     */
    public function rules(): array {
        return [
            'title'       => 'required|min:5|max:255',
            'slug'        => 'required|alpha_dash|unique:posts,slug',
            'content'     => 'required|min:10',
            'category_id' => 'required|exists:categories,id'
        ];
    }

    /**
     * Labels: Nama kustom untuk field (opsional)
     */
    public function labels(): array {
        return [
            'category_id' => 'Kategori'
        ];
    }
}
```

**✨ Fitur Magic FormRequest:**

1.  **Auto-Validation**: Saat di-inject ke dalam Controller, framework otomatis menjalankan validasi. Jika gagal, user akan di-**redirect back** dengan membawa pesan error dan input lama (old input).
2.  **Validated Data**: Gunakan `$request->validated()` di Controller untuk mendapatkan data yang sudah bersih dan terverifikasi (mencegah _mass assignment vulnerability_).
3.  **Smart Context**: Otomatis mengembalikan respons **JSON** jika request datang dari API atau AJAX.

---

---

### D. Controller Layer (`app/Http/Controllers/`)

Controller mengatur alur request, memanggil Service, dan menyiapkan response (View atau JSON).

**Contoh: PostController**

```php
namespace TheFramework\Http\Controllers;

use TheFramework\App\View;
use TheFramework\Helpers\Helper;
use TheFramework\Services\PostService;
use TheFramework\Http\Requests\CreatePostRequest;

class PostController extends Controller {
    private PostService $postService;

    public function __construct() {
        $this->postService = new PostService();
    }

    public function index() {
        // Ambil pesan flash jika ada
        $notification = Helper::get_flash('notification');

        $posts = $this->postService->getAllPublishedPosts();

        return View::render('posts.index', [
            'posts' => $posts,
            'notification' => $notification
        ]);
    }

    public function store() {
        // ✨ Instansiasi FormRequest akan memicu auto-validation
        // Jika gagal, otomatis redirect back dengan error.
        $request = new CreatePostRequest();

        // Ambil data user dari session via Helper
        $user = Helper::session_get('user');

        $post = $this->postService->createPost(
            $request->validated(),
            $user['uid']
        );

        return Helper::redirect('/posts', 'success', 'Post berhasil dibuat!');
    }

    public function destroy($id) {
        $user = Helper::session_get('user');
        $deleted = $this->postService->deletePost($id, $user['uid']);

        if ($deleted) {
            return Helper::redirect('/posts', 'success', 'Post dihapus!');
        }

        return Helper::redirect('/posts', 'error', 'Gagal menghapus post!');
    }
}
```

**Prinsip Controller yang Baik:**

- **Thin Controller**: Hanya orchestrate alur, JANGAN ada logika bisnis (pindahkan ke Service).
- **Auto-Validation**: Manfaatkan `FormRequest` untuk validasi input yang clean.
- **Helper Usage**: Selalu gunakan `Helper` untuk redirect, session, dan flash message demi konsistensi.

---

### E. Service Layer (`app/Services/`)

Service adalah tempat utama untuk **Logika Bisnis**. Service menggabungkan operasi dari Model, Helper, dan library eksternal lainnya.

**Contoh: PostService**

```php
namespace TheFramework\Services;

use TheFramework\Models\Post;
use TheFramework\Helpers\Helper;
use TheFramework\Config\UploadHandler;
use TheFramework\App\Database;
use Exception;

class PostService {
    protected Post $model;

    public function __construct() {
        $this->model = new Post();
    }

    public function getAllPublished() {
        // Query langsung via Model
        return $this->model->query()
            ->where('is_published', '=', 1)
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function storePost(array $data, array $file = []) {
        // 1. Business Logic: Generate Slug & UUID
        $data['uid'] = Helper::uuid();
        $data['slug'] = Helper::slugify($data['title']);
        $data['is_published'] = 1;

        // 2. Handle Upload via UploadHandler
        if (!empty($file)) {
            $uploadResult = UploadHandler::handleUploadToWebP($file, '/posts', 'post_');
            if (UploadHandler::isError($uploadResult)) {
                return $uploadResult; // Kembalikan error upload
            }
            $data['image'] = $uploadResult;
        }

        // 3. Simpan via Model
        return $this->model->create($data);
    }

    public function deletePost(string $uid) {
        $db = Database::getInstance();
        try {
            $db->beginTransaction();

            $post = $this->model->find($uid);
            if (!$post) throw new Exception("Post tidak ditemukan");

            // Hapus file fisik jika ada
            if (!empty($post['image'])) {
                UploadHandler::delete($post['image'], '/posts');
            }

            // Hapus data di DB
            $result = $this->model->delete($uid);

            $db->commit();
            return $result;
        } catch (Exception $e) {
            $db->rollBack();
            throw $e;
        }
    }
}
```

**Kapan Menggunakan Service Layer:**

- **Logika Kompleks**: Jika ada pemrosesan data (seperti image processing, hashing, slugging) sebelum masuk ke database.
- **Multiple Models**: Jika satu aksi (misal: 'Checkout') mempengaruhi banyak tabel/model.
- **Database Transaction**: Pastikan transaksi (`beginTransaction`, `commit`, `rollBack`) dikelola di level Service agar atomik.
- **Pemisahan Responsibility**: Menjaga Controller agar tetap "Thin" (hanya menerima request dan memberikan response).

---

### F. Model sebagai Query Builder

Framework ini menggunakan **Active Record Pattern** yang dipadukan dengan **Fluent Query Builder**. Anda dapat melakukan query database kompleks langsung melalui Class Model tanpa perlu membuat Repository tambahan.

**Contoh Query Chaining:**

```php
namespace TheFramework\Services;

use TheFramework\Models\Post;

class PostService {
    public function getFilterPosts() {
        // Query Chaining langsung pada Model
        return Post::query()
            ->where('is_published', '=', 1)
            ->where('category_id', '=', 2)
            ->orderBy('created_at', 'DESC')
            ->limit(10)
            ->get();
    }

    public function findFirstActive(string $email) {
        // Mengambil hanya satu record pertama
        return Post::where('email', '=', $email)->first();
    }

    public function search(string $keyword) {
        // Advanced search with LIKE
        return Post::query()
            ->where('title', 'LIKE', "%$keyword%")
            ->get();
    }
}
```

**Kelebihan Pendekatan Ini:**

- **Clean Code**: Tidak perlu banyak boilerplate file Repository.
- **Fluent Interface**: Kode lebih mudah dibaca (readable) karena menggunakan chaining method.
- **Magic Methods**: Mendukung `__callStatic`, sehingga Anda bisa memanggil `Post::where()` secara langsung.
- **Auto Hydration**: Hasil query otomatis dikonversi menjadi instans Model (Object), bukan sekadar array array biasa.

---

### G. Model Layer (`app/Models/`)

Model adalah representasi tabel database dengan **ORM Active Record**. Framework secara otomatis memetakan kolom database menjadi properti objek.

**Contoh: User Model**

```php
namespace TheFramework\Models;

use TheFramework\App\Model;

class User extends Model {
    protected $table = 'users'; // Nama tabel (opsional jika nama class sudah sama)
    protected $primaryKey = 'uid'; // Default adalah 'id', jika menggunakan UUID/UID wajib didefinisikan

    // Kolom yang diizinkan untuk diisi secara massal (Security: Mass Assignment)
    protected $fillable = [
        'uid',
        'name',
        'email',
        'password',
        'profile_picture'
    ];

    // Kolom yang akan disembunyikan saat data di-convert ke JSON atau Array
    protected $hidden = [
        'password',
        'remember_token'
    ];

    // Mengaktifkan pengelolaan created_at & updated_at secara otomatis
    protected $timestamps = true;

    // Relasi: Satu User memiliki banyak Post
    public function posts() {
        return $this->hasMany(Post::class, 'user_id', 'uid');
    }
}
```

**Poin Penting:**

- **Object Syntax**: Data diakses menggunakan tanda panah, contoh: `$user->name`.
- **Relationships**: Gunakan `belongsTo`, `hasMany`, `hasOne` untuk menghubungkan antar tabel.
- **Mass Assignment**: Selalu definisikan `$fillable` untuk keamanan data.
- **Auto Hydrate**: Hasil query `Model::find()` atau `Model::all()` selalu mengembalikan instans objek Model, bukan array array mentah.

---

---

### H. View Layer (`resources/views/`)

View menggunakan **Blade Templating Engine** untuk memisahkan logika presentasi dengan HTML secara bersih. File view wajib berakhiran `.blade.php`.

**Contoh Template: `resources/views/template/main.blade.php`**

```html
<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title', 'The Framework')</title>
  </head>
  <body>
    @include('template.navbar')

    <main>@yield('content')</main>
  </body>
</html>
```

**Contoh View: `resources/views/posts/index.blade.php`**

```html
@extends('template.main') @section('title', 'Semua Post') @section('content')
<h1>Semua Post</h1>

@if($notification)
<div class="alert alert-{{ $notification['type'] }}">
  {{ $notification['message'] }}
</div>
@endif @foreach($posts as $post)
<article>
  <h2><a href="/posts/{{ $post->uid }}">{{ $post->title }}</a></h2>

  <p class="meta">Oleh: {{ $post->user->name ?? 'Anonim' }}</p>

  <p>{{ substr($post->content, 0, 150) }}...</p>
</article>
<hr />
@endforeach @endsection
```

**Fitur Utama Blade:**

- **{{ $variable }}**: Otomatis menjalankan `e()` helper untuk keamanan XSS.
- **Directives**: `@if`, `@foreach`, `@include`, `@extends`, `@section`.
- **Inheritance**: Memungkinkan pembuatan _Layout_ induk yang bisa di-reuse oleh banyak halaman.

---

## 💎 3. MODEL & ORM ACTIVE RECORD

Framework ini menggunakan **Active Record Pattern** (mirip Laravel Eloquent). Hasil query adalah **Object**, bukan array biasa.

### A. Mendefinisikan Model

```php
namespace TheFramework\Models;

use TheFramework\App\Model;

class User extends Model {
    protected $table = 'users';
    protected $primaryKey = 'uid'; // Custom primary key

    protected $fillable = ['uid', 'name', 'email', 'password'];
    protected $hidden = ['password'];
    protected $timestamps = true;
}
```

### B. CRUD Operations

#### 1. CREATE

```php
// Method 1: Static Create (Recommended)
$user = User::create([
    'uid'   => Helper::uuid(),
    'name'  => 'John Doe',
    'email' => 'john@example.com',
    'password' => password_hash('secret123', PASSWORD_BCRYPT)
]);

// Method 2: Instance + Save
$user = new User();
$user->name = 'Jane Doe';
$user->email = 'jane@example.com';
$user->save(); // Auto INSERT

// Method 3: Fill + Save (Batch assignment)
$user = new User();
$user->fill($request->validated());
$user->save();
```

#### 2. READ

```php
// Get All (Array of Objects)
$users = User::all();

// Find by ID/UID (Single Object)
$user = User::find('7d6a...1234');

// Fluent Query Chaining
$admins = User::query()
    ->where('role', '=', 'admin')
    ->orderBy('created_at', 'DESC')
    ->limit(10)
    ->get(); // Array of Objects

// Ambil Satu Saja
$user = User::where('email', '=', 'admin@example.com')->first();
```

**Penting:** Akses data selalu menggunakan **Object Syntax**:

```php
$users = User::all();
foreach ($users as $user) {
    echo $user->name; // ✅ Benar (Object)
}
```

#### 3. UPDATE

```php
// Method 1: Instance Update (Recommended)
$user = User::find($uid);
$user->name = 'New Name';
$user->save(); // Auto UPDATE berdasarkan primary key

// Method 2: Batch Update via Query
User::query()
    ->where('status', '=', 'inactive')
    ->update(['status' => 'active']);
```

#### 4. DELETE

```php
// Method 1: Instance Delete
$user = User::find($uid);
$user->delete();

// Method 2: Quick Delete by UID
User::delete($uid);

// Method 3: Batch Delete
User::query()->where('active', '=', 0)->delete();
```

---

## 🔗 4. DATABASE RELATIONSHIPS

### A. Mendefinisikan Relasi

**1. One-to-Many (hasMany)**

```php
class User extends Model {
    public function posts() {
        return $this->hasMany(Post::class, 'user_id', 'uid');
    }
}
```

**2. Belongs To (belongsTo)**

```php
class Post extends Model {
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'uid');
    }
}
```

### B. Menggunakan Relasi

#### 1. Lazy Loading (Property Access)

```php
$user = User::find($uid);

// Otomatis menjalankan query saat property dipanggil
$posts = $user->posts; // Array of Post objects

foreach ($posts as $post) {
    echo $post->title;
}
```

#### 2. Eager Loading (Mencegah N+1 Problem)

```php
// ✅ GOOD: Mengambil User beserta Post-nya dalam 2 query saja
$users = User::with(['posts'])->get();

foreach ($users as $user) {
    echo "User: " . $user->name;
    foreach ($user->posts as $post) {
        echo "- " . $post->title;
    }
}
```

**Nested Eager Loading:**

```php
// Load posts beserta user-nya dan comment-nya
$posts = Post::with(['user', 'comments'])->get();
```

#### 3. Relation Chaining (Filter Relasi)

```php
$user = User::find($uid);

// Ambil hanya post yang memiliki status khusus
$activePosts = $user->posts()
    ->where('status', '=', 'active')
    ->orderBy('created_at', 'DESC')
    ->get();
```

### C. Perbandingan Struktur Data

Agar lebih memahami manfaat Relasi, berikut adalah perbandingan data saat di-outputkan sebagai JSON.

#### 1. Skema Tabel Database (Normalized)

```sql
-- Tabel Users
CREATE TABLE users (
    uid CHAR(36) PRIMARY KEY,
    name VARCHAR(100)
);

-- Tabel Posts
CREATE TABLE posts (
    uid CHAR(36) PRIMARY KEY,
    user_id CHAR(36), -- Foreign Key ke users.uid
    title VARCHAR(255),
    content TEXT
);
```

#### 2. Ouput JSON: Tanpa Relasi (Flat / Denormalized)

Jika kita mendesain data tanpa relasi (misal: data user ditaruh di dalam posts), atau kita melakukan query secara manual tanpa ORM, datanya akan terlihat seperti ini (redundant):

```json
[
  {
    "post_uid": "p1-123",
    "title": "Belajar Framework",
    "user_name": "Chandra",
    "user_uid": "u1-456"
  },
  {
    "post_uid": "p2-789",
    "title": "Tutorial ORM",
    "user_name": "Chandra",
    "user_uid": "u1-456"
  }
]
```

_Kekurangan: Nama "Chandra" terduplikasi di setiap baris (Boros storage & sulit update)._

#### 3. Output JSON: Dengan Relasi (Nested / Eager Loading)

Menggunakan `User::with(['posts'])->get()`, data menjadi terstruktur secara hierarkis dan efisien:

```json
[
  {
    "uid": "u1-456",
    "name": "Chandra",
    "posts": [
      {
        "uid": "p1-123",
        "title": "Belajar Framework"
      },
      {
        "uid": "p2-789",
        "title": "Tutorial ORM"
      }
    ]
  }
]
```

_Kelebihan: Data User cukup satu kali, semua Post yang terkait dikelompokkan di dalamnya. Sangat ideal untuk API modern._

---

## 🛡️ 5. VALIDATION SYSTEM

### A. Manual Validation (Controller)

Gunakan `TheFramework\App\Validator` untuk validasi manual.

```php
use TheFramework\App\Validator;
use TheFramework\Helpers\Helper;

$validator = new Validator();

$isValid = $validator->validate($_POST, [
    'name'     => 'required|min:3',
    'email'    => 'required|email|unique:users,email',
    'password' => 'required|min:8|confirmed',
]);

if (!$isValid) {
    // Flash error ke session via Helper
    $_SESSION['errors'] = $validator->errors();
    $_SESSION['old'] = $_POST;

    return Helper::redirect('/register');
}
```

### B. Form Request Validation (Recommended ✨)

Cara terbaik adalah menggunakan class Request khusus yang menangani validasi secara otomatis.

```php
namespace TheFramework\Http\Requests;

use TheFramework\App\FormRequest;

class UserRequest extends FormRequest {
    public function rules(): array {
        return [
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
        ];
    }
}
```

**Di Controller:**

```php
public function store() {
    // Validasi otomatis dijalankan saat instansiasi
    $request = new UserRequest();

    // Jika sampai baris ini, data sudah valid
    $data = $request->validated();
}
```

### C. Database Validation Rules

| Rule                                   | Deskripsi                  | Contoh                          |
| :------------------------------------- | :------------------------- | :------------------------------ |
| `unique:table,column,except_id,id_col` | Cek keunikan di tabel      | `unique:users,email,{$uid},uid` |
| `exists:table,column`                  | Pastikan data ada di tabel | `exists:categories,id`          |

---

## ⚡ 6. DATABASE TRANSACTIONS & RACE CONDITIONS

### A. Pola Transaksi di dalam Service

Database Transaction menjamin bahwa serangkaian query berjalan sebagai satu kesatuan atomik. Jika satu query gagal, semua perubahan akan dibatalkan (_Rollback_).

**Contoh: Transfer Saldo (Service Layer)**

```php
namespace TheFramework\Services;

use TheFramework\App\Database;
use TheFramework\Models\User;
use Exception;

class BalanceService {
    public function transfer(string $fromUid, string $toUid, float $amount) {
        $db = Database::getInstance();

        try {
            $db->beginTransaction();

            $sender = User::find($fromUid);
            $receiver = User::find($toUid);

            if ($sender->balance < $amount) {
                throw new Exception("Saldo tidak mencukupi");
            }

            // 1. Kurangi saldo pengirim
            $sender->balance -= $amount;
            $sender->save();

            // 2. Tambah saldo penerima
            $receiver->balance += $amount;
            $receiver->save();

            $db->commit();
            return true;
        } catch (Exception $e) {
            $db->rollBack();
            return $e->getMessage();
        }
    }
}
```

**Di Controller:**

```php
public function processTransfer() {
    $service = new BalanceService();
    $result = $service->transfer($_POST['from'], $_POST['to'], $_POST['amount']);

    if ($result === true) {
        return Helper::redirect('/wallet', 'success', 'Transfer berhasil');
    }

    return Helper::redirect('/wallet', 'error', $result);
}
```

---

## 🔐 7. TUTORIAL: AUTHENTICATION SYSTEM

### Step 1: Model (`app/Models/User.php`)

```php
namespace TheFramework\Models;

use TheFramework\App\Model;

class User extends Model {
    protected $table = 'users';
    protected $primaryKey = 'uid';
    protected $fillable = ['uid', 'name', 'email', 'password'];
    protected $hidden = ['password'];
}
```

### Step 2: Service (`app/Services/AuthService.php`)

```php
namespace TheFramework\Services;

use TheFramework\Models\User;
use TheFramework\Helpers\Helper;
use Exception;

class AuthService {
    public function login(string $email, string $password) {
        $user = User::where('email', '=', $email)->first();

        if (!$user || !password_verify($password, $user->password)) {
            throw new Exception("Email atau password salah.");
        }

        // Set Session via Helper
        $_SESSION['user'] = $user->toArray();
        return true;
    }
}
```

### Step 3: Controller (`app/Http/Controllers/AuthController.php`)

```php
namespace TheFramework\Http\Controllers;

use TheFramework\Services\AuthService;
use TheFramework\Http\Requests\LoginRequest;
use TheFramework\Helpers\Helper;
use TheFramework\App\View;

class AuthController extends Controller {
    public function login() {
        try {
            $request = new LoginRequest(); // Auto-validate

            $service = new AuthService();
            $service->login($request->input('email'), $request->input('password'));

            return Helper::redirect('/dashboard', 'success', 'Selamat datang kembali!');
        } catch (\Exception $e) {
            return Helper::redirect('/login', 'error', $e->getMessage());
        }
    }
}
```

### Step 4: View (`resources/views/auth/login.blade.php`)

```html
@extends('template.main') @section('content')
<form action="/login" method="POST">
  <input
    type="hidden"
    name="csrf_token"
    value="{{ Helper::generateCsrfToken() }}"
  />

  <input type="email" name="email" value="{{ Helper::old('email') }}" />
  <input type="password" name="password" />

  <button type="submit">Login</button>
</form>
@endsection
```

---

## 📝 8. TUTORIAL: BLOG CMS FULL STACK

### Step 1: Model & Relasi (`app/Models/Post.php`)

```php
namespace TheFramework\Models;

use TheFramework\App\Model;

class Post extends Model {
    protected $table = 'posts';
    protected $primaryKey = 'uid';
    protected $fillable = ['uid', 'title', 'slug', 'content', 'image', 'user_id'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'uid');
    }
}
```

### Step 2: Service Layer (`app/Services/PostService.php`)

```php
namespace TheFramework\Services;

use TheFramework\Models\Post;
use TheFramework\Helpers\Helper;
use TheFramework\Config\UploadHandler;

class PostService {
    public function createFromRequest($request) {
        $data = $request->validated();
        $data['uid'] = Helper::uuid();
        $data['slug'] = Helper::slugify($data['title']);
        $data['user_id'] = Helper::session_get('user')['uid'];

        // Handle Image Upload premium conversion
        if ($request->hasFile('image')) {
            $data['image'] = UploadHandler::handleUploadToWebP($request->file('image'), '/post-images');
        }

        return Post::create($data);
    }
}
```

### Step 3: Controller (`app/Http/Controllers/PostController.php`)

```php
namespace TheFramework\Http\Controllers;

use TheFramework\Http\Requests\PostRequest;
use TheFramework\Services\PostService;
use TheFramework\Helpers\Helper;
use TheFramework\App\View;

class PostController extends Controller {
    public function store() {
        try {
            $request = new PostRequest();
            $service = new PostService();
            $service->createFromRequest($request);

            return Helper::redirect('/posts', 'success', 'Post berhasil diterbitkan!');
        } catch (\Exception $e) {
            return Helper::redirect('/posts/create', 'error', $e->getMessage());
        }
    }

    public function index() {
        // Eager Load user untuk performa optimal
        $posts = Post::with(['user'])->orderBy('created_at', 'DESC')->get();

        return View::render('posts.index', ['posts' => $posts]);
    }
}
```

### Step 4: Blade View (`resources/views/posts/index.blade.php`)

```html
@extends('template.app') @section('content') @foreach($posts as $post)
<div class="card">
  <img src="{{ Helper::url('uploads/post-images/' . $post->image) }}" />
  <h2>{{ $post->title }}</h2>
  <p>Penulis: {{ $post->user->name }}</p>
  <a href="/posts/{{ $post->uid }}">Baca Selengkapnya</a>
</div>
@endforeach @endsection
```

--- return Post::with(['author', 'category', 'comments.author'])
->where('slug', $slug)
->first();
}

    public function create(array $data): Post {
        return Post::create($data);
    }

    public function update(Post $post, array $data): bool {
        foreach ($data as $key => $value) {
            $post->$key = $value;
        }
        return $post->save();
    }

    public function delete(Post $post): bool {
        return $post->delete();
    }

}

````

### Step 4: Service

```php
namespace TheFramework\Services;

use TheFramework\Repositories\PostRepository;
use TheFramework\Models\Post;
use TheFramework\Helpers\Helper;

class PostService {
    private PostRepository $postRepo;

    public function __construct() {
        $this->postRepo = new PostRepository();
    }

    public function getAllPublishedPosts() {
        return $this->postRepo->getAllPublished();
    }

    public function getPostBySlug(string $slug) {
        return $this->postRepo->findBySlug($slug);
    }

    public function createPost(array $data, int $userId): Post {
        // Generate slug
        $data['slug'] = Helper::slug($data['title']);
        $data['user_id'] = $userId;

        // Handle image upload (if exists)
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $data['image'] = $this->uploadImage($_FILES['image']);
        }

        // Set published date if published
        if ($data['is_published'] ?? false) {
            $data['published_at'] = date('Y-m-d H:i:s');
        }

        return $this->postRepo->create($data);
    }

    public function updatePost(Post $post, array $data): bool {
        // Regenerate slug if title changed
        if (isset($data['title']) && $data['title'] !== $post->title) {
            $data['slug'] = Helper::slug($data['title']);
        }

        // Handle new image upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            // Delete old image
            if ($post->image) {
                @unlink(base_path('public/uploads/' . $post->image));
            }
            $data['image'] = $this->uploadImage($_FILES['image']);
        }

        return $this->postRepo->update($post, $data);
    }

    public function deletePost(Post $post): bool {
        // Delete image file
        if ($post->image) {
            @unlink(base_path('public/uploads/' . $post->image));
        }

        return $this->postRepo->delete($post);
    }

    private function uploadImage(array $file): string {
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . '.' . $ext;

        move_uploaded_file(
            $file['tmp_name'],
            base_path('public/uploads/' . $filename)
        );

        return $filename;
    }
}
````

### Step 5: Controller

```php
namespace TheFramework\Controllers;

use TheFramework\Services\PostService;
use TheFramework\Requests\CreatePostRequest;

class PostController extends Controller {
    private PostService $postService;

    public function __construct() {
        $this->postService = new PostService();
    }

    public function index() {
        $posts = $this->postService->getAllPublishedPosts();
        return view('posts.index', compact('posts'));
    }

    public function show($slug) {
        $post = $this->postService->getPostBySlug($slug);

        if (!$post) {
            abort(404);
        }

        return view('posts.show', compact('post'));
    }

    public function store(CreatePostRequest $request) {
        if (!$request->validate()) {
            return redirect('/posts/create')
                ->withErrors($request->errors())
                ->withInput();
        }

        $post = $this->postService->createPost(
            $request->all(),
            $_SESSION['user_id']
        );

        return redirect('/posts/' . $post->slug)
            ->with('success', 'Post berhasil dibuat!');
    }

    public function destroy($id) {
        $post = Post::find($id);

        // Authorization check
        if ($post->user_id != $_SESSION['user_id']) {
            abort(403);
        }

        $this->postService->deletePost($post);

        return redirect('/posts')
            ->with('success', 'Post berhasil dihapus!');
    }
}
```

### Step 6: View

**List Posts (`resources/views/posts/index.php`):**

```php
<!DOCTYPE html>
<html>
<head>
    <title>Blog</title>
    <style>
        .post { margin-bottom: 30px; padding: 20px; border: 1px solid #ddd; }
        .meta { color: #666; font-size: 0.9em; }
    </style>
</head>
<body>
    <h1>All Blog Posts</h1>

    <?php foreach ($posts as $post): ?>
        <div class="post">
            <?php if ($post->image): ?>
                <img src="/uploads/<?= e($post->image) ?>" width="200">
            <?php endif; ?>

            <h2>
                <a href="/posts/<?= e($post->slug) ?>">
                    <?= e($post->title) ?>
                </a>
            </h2>

            <div class="meta">
                By: <strong><?= e($post->author->username) ?></strong> |
                Category: <?= e($post->category->name ?? 'Uncategorized') ?> |
                <?= date('d M Y', strtotime($post->published_at)) ?>
            </div>

            <p><?= substr(e($post->content), 0, 300) ?>...</p>

            <a href="/posts/<?= e($post->slug) ?>">Read More →</a>
        </div>
    <?php endforeach; ?>
</body>
</html>
```

**Single Post (`resources/views/posts/show.php`):**

```php
<!DOCTYPE html>
<html>
<head>
    <title><?= e($post->title) ?></title>
</head>
<body>
    <article>
        <h1><?= e($post->title) ?></h1>

        <?php if ($post->image): ?>
            <img src="/uploads/<?= e($post->image) ?>" width="600">
        <?php endif; ?>

        <div class="meta">
            By: <strong><?= e($post->author->username) ?></strong> |
            Category: <?= e($post->category->name) ?> |
            <?= date('d M Y H:i', strtotime($post->published_at)) ?>
        </div>

        <div class="content">
            <?= nl2br(e($post->content)) ?>
        </div>
    </article>

    <hr>

    <h3>Comments (<?= count($post->comments) ?>)</h3>

    <?php foreach ($post->comments as $comment): ?>
        <div class="comment">
            <strong><?= e($comment->author->username) ?></strong>
            <p><?= e($comment->content) ?></p>
            <small><?= date('d M Y H:i', strtotime($comment->created_at)) ?></small>
        </div>
    <?php endforeach; ?>
</body>
</html>
```

---

## ✅ 9. BEST PRACTICES & TIPS

### A. Security

- **Blade Escaping**: Selalu gunakan `{{ $var }}` untuk otomatis proteksi XSS.
- **CSRF Protection**: Wajib sertakan token CSRF pada setiap form POST menggunakan `Helper::generateCsrfToken()`.
- **Password Hashing**: Gunakan `password_hash($pass, PASSWORD_BCRYPT)` via Service Layer.

### B. Performance

- **Eager Loading**: Gunakan `Model::with(['relation'])` jika ingin menampilkan data relasi di dalam loop (mencegah N+1 Problem).
- **UID vs ID**: Gunakan `uid` untuk _public facing URL_ agar ID database yang berurutan tidak terlihat oleh pihak luar.

### C. Clean Architecture

- **Thin Controller**: Controller hanya bertugas memanggil Service dan me-render View.
- **Fat Service**: Logika bisnis, transaksi, dan pengolahan data kompleks harus diletakkan di Service.
- **Active Record**: Gunakan kekuatan Model untuk query yang clean dan mudah dibaca (fluent chaining).

---

## 🔐 10. SESSION MANAGEMENT & SECURITY

Framework memiliki sistem session yang aman dan terpusat melalui **SessionManager** dan **Helper**.

**Fitur Keamanan Session:**

- **Secure Start**: Otomatis menggunakan _HttpOnly_, _Secure_ (jika HTTPS), dan _SameSite=Lax_.
- **Timeout**: Auto-expire setelah 30 menit inaktif.
- **Flash Data**: Mendukung data temporer (seperti notifikasi) via `Helper::set_flash` dan `Helper::get_flash`.

**Contoh di Controller:**

```php
Helper::session_write('user_uid', $user->uid);
return Helper::redirect('/dashboard', 'success', 'Selamat datang!');
```

**Contoh di View (Blade):**

```html
@if($message = Helper::get_flash('success'))
<div class="alert">{{ $message }}</div>
@endif
```

---

## 🏛️ 11. ARCHITECTURE DEEP DIVE

### Di mana Transaksi Harus Ditaruh?

**PRINSIP UTAMA**: Transaksi database wajib diletakkan di **Service Layer**, bukan Model atau Controller.

**Alasannya:**
Service Layer mengoordinasikan berbagai Model untuk menyelesaikan satu tugas bisnis (misal: _Checkout Order_). Transaksi memastikan jika pengubahan Stok gagal, maka pembuatan Order juga dibatalkan secara otomatis.

### Responsibility Matrix (Updated)

| Layer          | Transaction | Business Logic | Database Query | Kapan Digunakan?                 |
| :------------- | :---------: | :------------: | :------------: | :------------------------------- |
| **Controller** |     ❌      |       ❌       |       ❌       | Menerima request & kirim respon. |
| **Service**    | **✅ YES**  |   **✅ YES**   |       ❌       | Logika kompleks & multi-model.   |
| **Model**      |     ❌      |       ❌       |   **✅ YES**   | CRUD tabel tunggal & relasi.     |

---

## 📊 RANGKUMAN FITUR UTAMA

- **Active Record ORM**: Query builder fluent, Eager Loading (`with`), dan relasi otomatis.
- **Automated Validation**: `FormRequest` untuk validasi input tanpa kotori Controller.
- **Service-Oriented**: Logika bisnis terpusat, clean, dan mudah di-test.
- **Blade Engine**: View yang bersih dan aman dari serangan XSS.
- **Helper System**: Akses mudah ke session, redirect, UUID, dan utilitas lainnya.

---

## 🎯 KESIMPULAN

Framework ini dirancang untuk developer yang menginginkan **performa maksimal** tanpa mengorbankan **kerapihan kode**. Dengan mengikuti panduan ini, aplikasi Anda akan memiliki struktur yang scalable, aman, dan mudah dimengerti oleh tim lain.

**Happy Coding!** 🚀
