# 📘 PANDUAN LENGKAP BLADE TEMPLATING ENGINE

> **Tutorial Komprehensif Blade untuk TheFramework**
> Pelajari semua directive Blade dengan contoh praktis dan mudah dipahami

---

## 📑 Daftar Isi

1. [Pengenalan Blade](#pengenalan-blade)
2. [Template Inheritance](#template-inheritance)
3. [Displaying Data](#displaying-data)
4. [Control Structures](#control-structures)
5. [Looping](#looping)
6. [Including Sub-Views](#including-sub-views)
7. [Components &amp; Slots](#components--slots)
8. [PHP Blocks](#php-blocks)
9. [Comments](#comments)
10. [Best Practices](#best-practices)

---

## 🎯 Pengenalan Blade (Analogi Sederhana)

Bayangkan Blade itu seperti **"Cetakan Kue"** atau **"Bingkai Foto"**.

- **PHP Murni** itu seperti Anda **melukis** gambar dari nol setiap kali ingin membuat halaman baru. Menggambar bingkainya lagi, menggambar latar belakangnya lagi. Ribet dan lama.
- **Blade** memberi Anda **Bingkai (Layout)** yang sudah jadi. Anda tinggal mengganti **Fotonya (Konten)** saja sesuai kebutuhan.

**Analogi Sandwich 🥪**:

1. **Layout Master (`@yield`)**: Ini adalah Roti Atas dan Roti Bawah. Selalu sama untuk setiap pesanan.
2. **Konten (`@section`)**: Ini adalah isiannya (Daging, Keju, Sayur). Bisa beda-beda tiap pesanan.
3. **Extends**: Pelanggan memesan "Tolong buatkan saya Sandwich Paket A" (artinya pakai roti model A).

### 📘 Kamus Mini Syntax Blade

Daftar cepat perintah yang paling sering dipakai:

| Syntax                                             | Arti / Fungsi                             | Analogi                         |
| :------------------------------------------------- | :---------------------------------------- | :------------------------------ |
| **`@extends('layout')`**                   | Gunakan file layout ini                   | "Pakai bingkai foto yang itu!"  |
| **`@section('nama')` ... `@endsection`** | Mulai mendefinisikan isi konten           | "Ini foto yang mau dipasang"    |
| **`@yield('nama')`**                       | Tempat menaruh konten di layout           | "Lubang kosong di bingkai"      |
| **`@php ... @endphp`**                     | Tulis kode PHP biasa (variable, hitungan) | "Catatan kecil di balik foto"   |
| **`@foreach` ... `@endforeach`**         | Ulangi kode (looping)                     | "Fotocopy berulang kali"        |
| **`@if` ... `@endif`**                   | Logika jika-maka                          | "Pasang foto ini HANYA JIKA..." |
| **`{{ $var }}`**                           | Tampilkan variable (aman)                 | "Tulis nama di label"           |
| **`{!! $var !!}`**                         | Tampilkan HTML mentah (hati-hati!)        | "Tempel stiker asli"            |

---

## 🏗️ Template Inheritance

Template inheritance adalah fitur paling powerful di Blade. Konsepnya: **buat layout master**, lalu **extend** di halaman-halaman lain.

### 1. `@yield` - Placeholder untuk Konten

**Kegunaan**: Menandai area di layout master yang akan **diisi** oleh child template.

**Fungsi**: Seperti "lubang kosong" yang nanti diisi konten dari halaman lain.

#### Contoh Layout Master (`resources/views/layouts/app.blade.php`):

```blade
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ini judul</title>

    <!-- CSS Global -->
    <link rel="stylesheet" href="{{ url('/assets/css/style.css') }}">

    <!-- CSS Per Halaman (Optional) -->
    @yield('css')
</head>
<body>
    <!-- Header -->
    <header>
        <h1>Website Saya</h1>
        <nav>
            <a href="/">Home</a>
            <a href="/about">About</a>
        </nav>
    </header>

    <!-- Konten Utama (Diisi oleh Child) -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <p>© 2026 Website Saya</p>
    </footer>

    <!-- JS Global -->
    <script src="{{ url('/assets/js/app.js') }}"></script>

    <!-- JS Per Halaman (Optional) -->
    @yield('scripts')
</body>
</html>
```

**Penjelasan `@yield`**:

- `@yield('title', 'Default Title')` → Jika child tidak define title, pakai "Default Title"
- `@yield('content')` → Area utama untuk konten halaman (WAJIB diisi child)
- `@yield('css')` → Optional, bisa diisi CSS khusus per halaman
- `@yield('scripts')` → Optional, bisa diisi JS khusus per halaman

---

### 2. `@extends` - Menggunakan Layout Master

**Kegunaan**: Memberitahu Blade bahwa halaman ini **memakai** layout master tertentu.

**Fungsi**: Koneksi antara child template dengan parent layout.

### 3. `@section` - Mengisi Area Yield

**Kegunaan**: Mengisi "lubang" (`@yield`) yang sudah didefinisikan di layout master.

**Fungsi**: Container untuk konten yang akan dikirim ke layout.

#### Contoh Child Template (`resources/views/home.blade.php`):

```blade
@extends('layouts.app')

@section('css')
<style>
    .hero {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 50px;
        color: white;
    }
</style>
@endsection

@section('content')
<div class="hero">
    <h2>Selamat Datang di Website Kami!</h2>
    <p>Ini adalah halaman home.</p>
</div>

<div class="content">
    <h3>Produk Terbaru</h3>
    <ul>
        <li>Produk A</li>
        <li>Produk B</li>
        <li>Produk C</li>
    </ul>
</div>
@endsection

@section('scripts')
<script>
    console.log('Halaman Home loaded!');
</script>
@endsection
```

**Penjelasan**:

- `@extends('layouts.app')` → Pakai layout dari `layouts/app.blade.php`
- `@section('content') ... @endsection` → Isi konten utama
- Semua section akan "ditembakkan" ke `@yield` yang sesuai di layout master

---

## 📊 Displaying Data

### 1. `{{ $variable }}` - Echo Data (Auto-Escaped)

**Kegunaan**: Menampilkan data PHP ke HTML dengan **auto-escape** (aman dari XSS).

**Fungsi**: Sama seperti `<?= htmlspecialchars($variable) ?>`

#### 💡 Dari mana datanya?

Bayangkan Anda menerima data dari Controller atau API seperti ini:

```json
{
  "name": "Budi Santoso",
  "email": "budi@example.com",
  "price": 50000,
  "htmlContent": "<strong>Teks Bold</strong>",
  "user": null
}
```

Maka cara menampilkannya di Blade adalah:

```blade
<h1>Halo, {{ $name }}!</h1>
<p>Email: {{ $email }}</p>
<p>Total: Rp {{ rupiah($price) }}</p>
```

**Output** :

```html
<h1>Halo, Budi Santoso!</h1>
<p>Email: budi@example.com</p>
<p>Total: Rp 50.000</p>
```

---

### 2. `{!! $variable !!}` - Echo Raw HTML (Unescaped)

**Kegunaan**: Menampilkan HTML **tanpa escape** (hati-hati XSS!). contohnya seperti menampilkan deskripsi jika user menggunakan teks editor

**Fungsi**: Sama seperti `<?= $variable ?>`

**⚠️ WARNING**: Hanya pakai ini jika Anda **yakin** data sudah aman!

```blade
{!! $htmlContent !!}
```

**Contoh Use Case yang Aman**:

```php
// API
{
  "htmlContent": "<strong>ini isi dari deskripsi ini biasanya panjang<strong>",
}

```

```blade
<!-- View -->
<span>
	{!! $htmlContent !!}
</span>
```

**Output**:
    **ini isi dari deskripsi ini biasanya panjang**

**HTML**:

```html
<!-- View -->
<span>
	<strong>ini isi dari deskripsi ini biasanya panjang<strong>
</span>

```

---

### 3. `{{ $var ?? 'default' }}` - Null Coalescing

**Kegunaan**: Jika variabel tidak ada atau null, pakai nilai default.

```blade
<p>Nama: {{ $user['name'] ?? 'Guest' }}</p>
```

---

## 🔀 Control Structures

### 1. `@if`, `@elseif`, `@else`, `@endif`

**Kegunaan**: Conditional rendering (tampilkan sesuatu jika kondisi tertentu terpenuhi).

**Fungsi**: Sama seperti `if-else` PHP, tapi lebih bersih.

```blade
@if ($user['role'] === 'admin')
    <p>Selamat datang, Admin!</p>
    <a href="/admin/dashboard">Dashboard Admin</a>
@elseif ($user['role'] === 'member')
    <p>Selamat datang, Member!</p>
    <a href="/profile">Profil Saya</a>
@else
    <p>Harap login terlebih dahulu.</p>
    <a href="/login">Login</a>
@endif
```

---

### 2. `@unless`

**Kegunaan**: Kebalikan dari `@if`. Tampilkan jika kondisi **FALSE**.

**Fungsi**: Shorthand untuk `@if (!$condition)`

```blade
@unless ($user['is_banned'])
    <p>Akun Anda aktif.</p>
@endunless
```

Sama dengan:

```blade
@if (!$user['is_banned'])
    <p>Akun Anda aktif.</p>
@endif
```

---

### 3. `@isset` dan `@empty`

**Kegunaan**:

- `@isset`: Cek apakah variabel **ada** dan **tidak null**.
- `@empty`: Cek apakah variabel **kosong** (null, '', 0, [], false).

```blade
@isset($user)
    <p>User: {{ $user['name'] }}</p>
@endisset

@empty($cart)
    <p>Keranjang Anda kosong.</p>
@endempty
```

---

### 4. `@auth` dan `@guest`

**Kegunaan**:

- `@auth`: Tampilkan jika user **sudah login**.
- `@guest`: Tampilkan jika user **belum login**.

```blade
@auth
    <p>Halo, {{ session('user')['name'] }}!</p>
    <a href="/logout">Logout</a>
@endauth

@guest
    <a href="/login">Login</a>
    <a href="/register">Register</a>
@endguest
```

---

## 🔁 Looping

### 1. `@foreach`

**Kegunaan**: Loop melalui array/collection.

**Fungsi**: Sama seperti `foreach` PHP.

#### 💡 Dari mana datanya?

Misal data `products` dari API berupa Array of Objects:

```json
{
	"products": [
		{ "id": 1, "name": "Kopi Hitam", "price": 15000 },
		{ "id": 2, "name": "Roti Bakar", "price": 12000 },
		{ "id": 3, "name": "Teh Manis", "price": 5000 }
  ]
}
```

Maka cara looping-nya:

```blade
<h3>Daftar Produk</h3>
<ul>
@foreach ($products as $product)
    <li>
        <strong>{{ $product['name'] }}</strong> - Rp {{ number_format($product['price']) }}
    </li>
@endforeach
</ul>
```

**Loop Variable `$loop`**:

Blade menyediakan variabel `$loop` otomatis di dalam `@foreach`:

```blade
@foreach ($users as $user)
    <div class="user-card {{ $loop->first ? 'first' : '' }} {{ $loop->last ? 'last' : '' }}">
        <p>{{ $loop->iteration }}. {{ $user['name'] }}</p>

        @if ($loop->first)
            <span class="badge">Pertama</span>
        @endif

        @if ($loop->last)
            <span class="badge">Terakhir</span>
        @endif
    </div>
@endforeach
```

**Properti `$loop`**:

| Properti             | Deskripsi                | Contoh       |
| -------------------- | ------------------------ | ------------ |
| `$loop->index`     | Index mulai dari 0       | 0, 1, 2, ... |
| `$loop->iteration` | Iterasi mulai dari 1     | 1, 2, 3, ... |
| `$loop->first`     | TRUE di iterasi pertama  | true/false   |
| `$loop->last`      | TRUE di iterasi terakhir | true/false   |
| `$loop->even`      | TRUE di iterasi genap    | true/false   |
| `$loop->odd`       | TRUE di iterasi ganjil   | true/false   |
| `$loop->count`     | Total item               | 10           |
| `$loop->remaining` | Sisa iterasi             | 5            |
| `$loop->depth`     | Kedalaman nested loop    | 1, 2, 3      |
| `$loop->parent`    | Loop parent (nested)     | Object       |

---

### 2. `@forelse`

**Kegunaan**: Loop dengan fallback jika array **kosong**.

**Fungsi**: Kombinasi `@foreach` + `@if (empty($array))`

#### 💡 Kasus Data Kosong vs Ada Isi

Bayangkan variabel `$posts` bisa berisi data atau array kosong `[]`:

```json
// Skenario 1: Ada isinya
[
    { "title": "Berita Hari Ini", "excerpt": "Cuaca cerah..." }
]

// Skenario 2: Kosong
[]
```

Code Blade-nya sama, tapi dia pintar menangani kedua kondisi:

```blade
<h3>Daftar Post Terbaru</h3>
@forelse ($posts as $post)
    <article>
        <h4>{{ $post['title'] }}</h4>
        <p>{{ $post['excerpt'] }}</p>
    </article>
@empty
    <p class="text-muted">Belum ada post.</p>
@endforelse
```

---

### 3. `@for`

**Kegunaan**: Loop dengan counter manual.

```blade
@for ($i = 1; $i <= 5; $i++)
    <p>Baris ke-{{ $i }}</p>
@endfor
```

---

### 4. `@while`

**Kegunaan**: Loop selama kondisi TRUE.

```blade
@php
    $count = 0;
@endphp

@while ($count < 5)
    <p>Count: {{ $count }}</p>
    @php
        $count++;
    @endphp
@endwhile
```

---

### 5. `@break` dan `@continue`

**Kegunaan**: Keluar dari loop atau skip iterasi.

```blade
@foreach ($users as $user)
    @if ($user['is_banned'])
        @continue
    @endif

    @if ($user['id'] === 999)
        @break
    @endif

    <p>{{ $user['name'] }}</p>
@endforeach
```

Dengan kondisi inline:

```blade
@foreach ($users as $user)
    @continue($user['is_banned'])
    @break($user['id'] === 999)

    <p>{{ $user['name'] }}</p>
@endforeach
```

---

## 📦 Including Sub-Views

### 1. `@include`

**Kegunaan**: Memasukkan file view lain ke dalam view saat ini.

**Fungsi**: Code reuse untuk partial view (header, footer, card, dll).

#### Contoh Struktur:

```
resources/views/
├── layouts/
│   └── app.blade.php
├── partials/
│   ├── header.blade.php
│   ├── footer.blade.php
│   └── product-card.blade.php
└── products/
    └── index.blade.php
```

**File `partials/product-card.blade.php`**:

```blade
<div class="product-card">
    <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}">
    <h3>{{ $product['name'] }}</h3>
    <p class="price">Rp {{ number_format($product['price']) }}</p>
    <a href="/product/{{ $product['id'] }}" class="btn">Lihat Detail</a>
</div>
```

**File `products/index.blade.php`**:

```blade
@extends('layouts.app')

@section('content')
<h2>Katalog Produk</h2>
<div class="product-grid">
    @foreach ($products as $product)
        @include('partials.product-card', ['product' => $product])
    @endforeach
</div>
@endsection
```

**Passing Data ke Include**:

```blade
@include('partials.alert', ['type' => 'success', 'message' => 'Data berhasil disimpan!'])
```

---

### 2. `@includeIf`

**Kegunaan**: Include file **hanya jika** file tersebut **ada**.

```blade
@includeIf('partials.promo-banner')
```

Jika `partials/promo-banner.blade.php` tidak ada, tidak akan error.

---

### 3. `@includeWhen`

**Kegunaan**: Include file **berdasarkan kondisi**.

```blade
@includeWhen($user['is_admin'], 'partials.admin-panel')
```

---

## 🧩 Components & Slots

### 1. Component (Recommended for Reusable UI)

**Kegunaan**: Membuat komponen UI yang reusable dengan slot untuk konten dinamis.

#### Contoh Component `components/alert.blade.php`:

```blade
<div class="alert alert-{{ $type ?? 'info' }}">
    <strong>{{ $title }}</strong>
    <p>{{ $slot }}</p>
</div>
```

#### Usage:

```blade
@component('components.alert', ['type' => 'success', 'title' => 'Berhasil!'])
    Data Anda telah tersimpan dengan aman.
@endcomponent
```

---

### 2. Named Slots

**Kegunaan**: Komponen dengan multiple slot.

#### Component `components/card.blade.php`:

```blade
<div class="card">
    <div class="card-header">
        {{ $header }}
    </div>
    <div class="card-body">
        {{ $slot }}
    </div>
    <div class="card-footer">
        {{ $footer }}
    </div>
</div>
```

#### Usage:

```blade
@component('components.card')
    @slot('header')
        <h3>Judul Card</h3>
    @endslot

    <p>Ini adalah konten utama card.</p>

    @slot('footer')
        <button>Submit</button>
    @endslot
@endcomponent
```

---

## 💻 PHP Blocks

### 1. `@php ... @endphp`

**Kegunaan**: Menulis kode PHP multi-line di Blade.

**Fungsi**: Untuk logic kompleks yang tidak bisa diselesaikan dengan directive.

**⚠️ Best Practice**: Minimalisir penggunaan `@php`. Logic sebaiknya di Controller/Service.

```blade
@php
    $discount = 0;
    if ($user['is_member']) {
        $discount = 0.1;
    } elseif ($user['is_vip']) {
        $discount = 0.2;
    }

    $finalPrice = $price * (1 - $discount);
@endphp

<p>Harga Normal: Rp {{ number_format($price) }}</p>
<p>Diskon: {{ $discount * 100 }}%</p>
<p>Harga Akhir: Rp {{ number_format($finalPrice) }}</p>
```

---

### 2. Inline PHP (Single Statement)

```blade
@php($total = $price * $qty)

<p>Total: Rp {{ number_format($total) }}</p>
```

---

## 💬 Comments

### 1. Blade Comment (Tidak Muncul di HTML)

**Kegunaan**: Komentar yang **TIDAK** muncul di source code HTML.

```blade
{{-- Ini komentar Blade, tidak akan muncul di HTML client --}}
<p>Konten visible</p>
```

**Output HTML**:

```html
<p>Konten visible</p>
```

_(Komentar hilang total)_

---

### 2. HTML Comment (Muncul di HTML)

```blade
<!-- Ini komentar HTML biasa, akan muncul di source code -->
<p>Konten visible</p>
```

**Output HTML**:

```html
<!-- Ini komentar HTML biasa, akan muncul di source code -->
<p>Konten visible</p>
```

---

## 🎨 Helper Functions di Blade

### 1. `url()` - Generate URL

```blade
<link rel="stylesheet" href="{{ url('/assets/css/style.css') }}">
<a href="{{ url('/products') }}">Lihat Produk</a>
```

---

### 2. `old()` - Get Old Input (After Validation Fails)

```blade
<input type="text" name="name" value="{{ old('name') }}">
<input type="email" name="email" value="{{ old('email') }}">
```

**Fungsi**: Jika validasi gagal, form akan terisi kembali dengan input sebelumnya.

---

### 3. `e()` - Escape HTML

```blade
<p>{{ e($userInput) }}</p>
```

Same as `{{ $userInput }}` (auto-escaped).

---

### 4. `csrf_token()` - CSRF Token

```blade
@csrf

<!-- Sama dengan: -->
<input type="hidden" name="_token" value="{{ csrf_token() }}">
```

---

## 📋 Best Practices

### ✅ DO's

1. **Pisahkan Logic dari View**

   ```blade
   ❌ BAD:
   @php
       $users = User::query()->where('active', 1)->get();
   @endphp

   ✅ GOOD: (Di Controller)
   $users = User::query()->where('active', 1)->get();
   return View::render('users', ['users' => $users]);
   ```
2. **Gunakan Layout Inheritance**

   ```blade
   ✅ Buat layout master → Extend di child
   ❌ Copy-paste HTML header/footer di setiap file
   ```
3. **Gunakan Components untuk UI Berulang**

   ```blade
   ✅ @component('components.button')
   ❌ Copy-paste HTML button di 50 tempat
   ```
4. **Validasi Data Sebelum Render**

   ```blade
   ✅ @isset($user) ... @endisset
   ✅ {{ $user['name'] ?? 'Guest' }}
   ❌ {{ $user['name'] }} (bisa error jika $user null)
   ```
5. **Escape User Input**

   ```blade
   ✅ {{ $userInput }} (auto-escaped)
   ❌ {!! $userInput !!} (XSS vulnerability!)
   ```

---

### ❌ DON'Ts

1. **Jangan Taruh Query di View**

   ```blade
   ❌ @php $products = Product::all(); @endphp
   ```
2. **Jangan Pakai `{!! !!}` untuk User Input**

   ```blade
   ❌ {!! $request->input('comment') !!} (XSS!)
   ```
3. **Jangan Nested Loop Terlalu Dalam**

   ```blade
   ❌ @foreach @foreach @foreach @foreach (readability nightmare)
   ```
4. **Jangan Lupa `@csrf` di Form POST**

   ```blade
   ❌ <form method="POST"> (tanpa @csrf)
   ```

---

## 🎓 Contoh Lengkap: CRUD Blog

### Layout Master (`layouts/app.blade.php`):

```blade
<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'My Blog')</title>
    <link rel="stylesheet" href="{{ url('/css/style.css') }}">
    @yield('css')
</head>
<body>
    @include('partials.navbar')

    <main class="container">
        @yield('content')
    </main>

    @include('partials.footer')

    <script src="{{ url('/js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
```

---

### Halaman Index (`blog/index.blade.php`):

```blade
@extends('layouts.app')

@section('title', 'Semua Post - My Blog')

@section('content')
<div class="page-header">
    <h1>Blog Posts</h1>
    @auth
        <a href="/blog/create" class="btn btn-primary">Buat Post Baru</a>
    @endauth
</div>

@forelse ($posts as $post)
    @include('blog.partials.post-card', ['post' => $post])
@empty
    <div class="alert alert-info">
        <p>Belum ada post. Jadilah yang pertama menulis!</p>
    </div>
@endforelse

{{-- Pagination --}}
@if ($totalPages > 1)
    <div class="pagination">
        @for ($i = 1; $i <= $totalPages; $i++)
            <a href="?page={{ $i }}" class="{{ $i === $currentPage ? 'active' : '' }}">
                {{ $i }}
            </a>
        @endfor
    </div>
@endif
@endsection
```

---

### Post Card Partial (`blog/partials/post-card.blade.php`):

```blade
<article class="post-card">
    <h2>
        <a href="/blog/{{ $post['slug'] }}">{{ $post['title'] }}</a>
    </h2>

    <div class="meta">
        <span class="author">Oleh {{ $post['author'] }}</span>
        <span class="date">{{ $post['created_at'] }}</span>
    </div>

    <p class="excerpt">{{ $post['excerpt'] }}</p>

    <div class="tags">
        @foreach (explode(',', $post['tags']) as $tag)
            <span class="tag">{{ trim($tag) }}</span>
        @endforeach
    </div>

    @if ($post['is_featured'])
        <span class="badge badge-success">Featured</span>
    @endif

    <a href="/blog/{{ $post['slug'] }}" class="btn btn-sm">Baca Selengkapnya</a>
</article>
```

---

### Form Create/Edit (`blog/form.blade.php`):

```blade
@extends('layouts.app')

@section('title', isset($post) ? 'Edit Post' : 'Buat Post Baru')

@section('content')
<h1>{{ isset($post) ? 'Edit Post' : 'Buat Post Baru' }}</h1>

<form action="{{ isset($post) ? url('/blog/' . $post['id']) : url('/blog') }}" method="POST">
    @csrf

    @if (isset($post))
        <input type="hidden" name="_method" value="PUT">
    @endif

    <div class="form-group">
        <label for="title">Judul Post</label>
        <input type="text" name="title" id="title"
               value="{{ old('title', $post['title'] ?? '') }}"
               class="form-control {{ has_error('title') ? 'is-invalid' : '' }}">

        @if (has_error('title'))
            <div class="invalid-feedback">{{ error('title') }}</div>
        @endif
    </div>

    <div class="form-group">
        <label for="content">Konten</label>
        <textarea name="content" id="content" rows="10"
                  class="form-control {{ has_error('content') ? 'is-invalid' : '' }}">{{ old('content', $post['content'] ?? '') }}</textarea>

        @if (has_error('content'))
            <div class="invalid-feedback">{{ error('content') }}</div>
        @endif
    </div>

    <div class="form-group">
        <label for="tags">Tags (pisahkan dengan koma)</label>
        <input type="text" name="tags" id="tags"
               value="{{ old('tags', $post['tags'] ?? '') }}"
               class="form-control">
    </div>

    <div class="form-check">
        <input type="checkbox" name="is_featured" id="is_featured"
               value="1" {{ old('is_featured', $post['is_featured'] ?? false) ? 'checked' : '' }}>
        <label for="is_featured">Jadikan Post Featured</label>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">
            {{ isset($post) ? 'Update' : 'Publish' }}
        </button>
        <a href="/blog" class="btn btn-secondary">Batal</a>
    </div>
</form>
@endsection

@section('scripts')
<script src="{{ url('/js/markdown-editor.js') }}"></script>
@endsection
```

---

## 🚀 Kesimpulan

Blade adalah template engine yang powerful untuk membuat view yang:

- **Bersih** dan **mudah dibaca**
- **Reusable** dengan inheritance & components
- **Aman** dengan auto-escaping
- **Produktif** dengan directive yang ringkas

**Tips Terakhir**:

1. Selalu gunakan `{{ }}` untuk user input (auto-escaped)
2. Taruh logic di Controller, bukan di View
3. Manfaatkan layout inheritance untuk konsistensi
4. Buat component untuk UI yang sering dipakai

Selamat coding! 🎉

---

## 🏋️ Latihan Praktis: Membuat Template

Mari kita praktekkan teori di atas dengan studi kasus nyata.

### Latihan 1: Percobaan Awal (Tanpa Pewarisan)

Tujuan: Memahami bagaimana file Blade bekerja secara independen sebelum dihubungkan.

**Langkah 1: Buat File Template (Ibu)**
Buat file baru di: `resources/views/latihan/template/ibu.blade.php`
Isikan kode berikut:

```html
<h1>hallo ini ibu mada</h1>
<hr />
<p>Ini ceritanya adalah header/layout utama yang ingin kita pakai terus.</p>
```

**Langkah 2: Buat File Konten (Anak/Mada)**
Buat file baru di: `resources/views/latihan/mada.blade.php`
Isikan kode berikut:

```html
<h1>hallo ini mada</h1>
<p>Ini adalah konten khusus halaman Mada.</p>
```

**Langkah 3: Registrasi Route**
Buka file `routes/web.php` (atau file route Anda) dan tambahkan:

```php
Route::get('/mada', function () {
    return view('latihan.mada');
});
```

**Langkah 4: Uji Coba**
Buka browser dan akses url `/mada` (misal: `http://localhost:8000/mada`).

**Hasilnya:**
Maka **TIDAK MUNCUL** kata "hallo ini ibu mada", melainkan **HANYA** "hallo ini mada".

**Kenapa?**
Karena `mada.blade.php` berdiri sendiri. Dia belum "memanggil" atau "menggunakan" (`@extends`) file `ibu.blade.php`. Mereka masih seperti dua kertas yang terpisah.

Di latihan berikutnya, kita akan belajar cara "menjahit" keduanya menggunakan `@extends` dan `@section`.
