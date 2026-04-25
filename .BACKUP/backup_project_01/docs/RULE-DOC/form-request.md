# 📝 Form Request Validation

Auto-validation menggunakan dedicated Request class (seperti Laravel).

---

## 🚀 Quick Start

### 1. Generate Request

```bash
php artisan make:request CreateUserRequest
```

### 2. Define Rules

```php
// app/Http/Requests/CreateUserRequest.php
class CreateUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ];
    }

    public function labels(): array
    {
        return [
            'email' => 'Alamat Email',
            'password' => 'Kata Sandi',
        ];
    }
}
```

### 3. Use in Controller

```php
public function store(CreateUserRequest $request)
{
    // ✨ Validation happens automatically!
    // If we reach here, validation PASSED

    User::create($request->validated());
    return Helper::redirect('/users', 'success', 'User created!');
}
```

---

## 🔍 How It Works

### Auto-Validation Flow

```
HTTP Request
    ↓
Router matches /users (POST)
    ↓
Instantiate CreateUserRequest
    ↓
FormRequest Constructor:
    ├─→ Check authorize() → false? 403 & exit
    ├─→ Run validation on rules()
    ├─→ Validation FAILED?
    │       ├─→ Flash errors to session
    │       ├─→ Flash old input
    │       ├─→ Redirect back (HTTP_REFERER)
    │       └─→ exit (stop here!)
    └─→ Validation PASSED? → Continue
    ↓
Controller method executes
    ↓
$request->validated() → clean data
```

**Key Point:** Jika validation gagal, script **STOPS** sebelum masuk controller method!

---

## 📚 Complete Example

### Scenario: User Registration

**Step 1: Generate**

```bash
php artisan make:request RegisterUserRequest
```

**Step 2: Define Rules**

```php
<?php

namespace TheFramework\Http\Requests;

use TheFramework\App\FormRequest;

class RegisterUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Everyone can register
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => 'required|alpha_dash|min:4|max:20|unique:users,username',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'age'      => 'nullable|numeric|between:13,120',
            'terms'    => 'accepted',
        ];
    }

    public function labels(): array
    {
        return [
            'username' => 'Nama Pengguna',
            'email'    => 'Alamat Email',
            'password' => 'Kata Sandi',
            'age'      => 'Umur',
            'terms'    => 'Syarat & Ketentuan',
        ];
    }
}
```

**Step 3: Controller**

```php
<?php

namespace TheFramework\Controllers;

use TheFramework\Http\Requests\RegisterUserRequest;
use TheFramework\Models\User;
use TheFramework\Helpers\Helper;

class AuthController
{
    public function showRegisterForm()
    {
        return view('auth/register');
    }

    public function register(RegisterUserRequest $request)
    {
        // Auto-validated! No need to check

        $data = $request->validated();

        // Hash password
        $data['password'] = Helper::hash_password($data['password']);

        // Remove terms field (not in database)
        unset($data['terms']);

        // Create user
        $user = User::create($data);

        // Auto login
        $_SESSION['user_id'] = $user->id;

        return Helper::redirect('/dashboard', 'success', 'Welcome!');
    }
}
```

**Step 4: Route**

```php
// routes/web.php
Router::add('GET', '/register', AuthController::class, 'showRegisterForm');
Router::add('POST', '/register', AuthController::class, 'register');
```

**Step 5: View**

```php
<!-- resources/views/auth/register.php -->
<!DOCTYPE html>
<html>
<body>
    <h1>Register</h1>

    <!-- Errors auto-flashed by FormRequest -->
    <?php if ($errors = $_SESSION['errors'] ?? null): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= Helper::e($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="/register">
        <input type="hidden" name="_token" value="<?= Helper::generateCsrfToken() ?>">

        <div>
            <label>Nama Pengguna:</label>
            <input type="text" name="username" value="<?= Helper::old('username') ?>" required>
        </div>

        <div>
            <label>Email:</label>
            <input type="email" name="email" value="<?= Helper::old('email') ?>" required>
        </div>

        <div>
            <label>Password:</label>
            <input type="password" name="password" required>
        </div>

        <div>
            <label>Konfirmasi Password:</label>
            <input type="password" name="password_confirmation" required>
        </div>

        <div>
            <label>Umur (Opsional):</label>
            <input type="number" name="age" value="<?= Helper::old('age') ?>">
        </div>

        <div>
            <label>
                <input type="checkbox" name="terms" value="1"
                    <?= Helper::old('terms') ? 'checked' : '' ?>>
                Saya setuju dengan Syarat & Ketentuan
            </label>
        </div>

        <button type="submit">Register</button>
    </form>

    <?php unset($_SESSION['errors'], $_SESSION['old']); ?>
</body>
</html>
```

---

## 🔒 Authorization Example

Restrict access based on user role:

```php
class CreateAdminRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Only admins can create other admins
        $user = $_SESSION['user'] ?? null;

        if (!$user || $user['role'] !== 'admin') {
            // Auto redirect to 403 Forbidden
            return false;
        }

        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin,moderator,user',
        ];
    }
}
```

**Controller:**

```php
public function store(CreateAdminRequest $request)
{
    // If we reach here:
    // 1. User IS admin (authorize passed)
    // 2. Validation PASSED

    User::create($request->validated());
}
```

---

## 💡 Advanced Usage

### Reusing Request for Update

```php
class UpdateUserRequest extends FormRequest
{
    public function rules(): array
    {
        // Get user ID from route parameter
        $userId = $_GET['id'] ?? null;

        return [
            'email' => "required|email|unique:users,email,{$userId},id",
            'username' => "required|unique:users,username,{$userId},id",
        ];
    }
}
```

**Usage:**

```php
public function update(UpdateUserRequest $request, $id)
{
    $user = User::find($id);
    $user->fill($request->validated());
    $user->save();
}
```

---

## 📊 Comparison: Manual vs FormRequest

### Manual Validation

```php
public function store()
{
   $validator = new Validator();

   if (!$validator->validate($_POST, $rules)) {
       $_SESSION['errors'] = $validator->errors();
       $_SESSION['old'] = $_POST;
       return Helper::redirect()->back();
   }

   User::create($_POST);
}
```

**Lines:** ~10

### Form Request

```php
public function store(CreateUserRequest $request)
{
    User::create($request->validated());
}
```

**Lines:** 1

**Result:** 10x lebih clean! 🎉

---

## ✅ Best Practices

### DO:

```php
// ✅ Use validated() untuk mass assignment safety
User::create($request->validated());

// ✅ Reuse request for multiple methods
public function store(UserRequest $request) { /* ... */ }
public function update(UserRequest $request) { /* ... */ }

// ✅ Use labels untuk error messages user-friendly
public function labels(): array {
    return ['email' => 'Alamat Email'];
}
```

### DON'T:

```php
// ❌ Don't use all() untuk database insert
User::create($request->all()); // Vulnerable!

// ❌ Don't manually validate in controller when using FormRequest
if (!$request->validate()) { /* ... */ } // Not needed!

// ❌ Don't skip authorization check
public function authorize(): bool {
    return true; // OK hanya jika memang public
}
```

---

## 🎯 When to Use Form Request?

**Use Form Request if:**

- ✅ Form memiliki 3+ validation rules
- ✅ Form dipakai di multiple places (store + update)
- ✅ Need authorization check
- ✅ Production application
- ✅ Want clean controller

**Use Manual Validation if:**

- ✅ Simple 1-2 field validation
- ✅ Quick prototype
- ✅ One-time use form

---

## 🔗 See Also

- [Validation Rules](validation.md) - Daftar lengkap 50+ rules
- [Database Validation](validation.md#database-validation) - unique, exists
- [File Validation](validation.md#file-validation) - mimes, image, max

---

**Form Request = Laravel-like auto-validation untuk framework Anda!** 🚀
