<div align="center">

<img src="/private-uploads/shared/favicon.ico" alt="The Framework Logo" width="120">

# The Framework

**Modern PHP Framework for Everyone**

[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)
[![PHP Version](https://img.shields.io/badge/php-%3E%3D%208.3-8892BF.svg)](https://php.net/)
[![Version](https://img.shields.io/badge/version-5.0.0-red.svg)](https://github.com/chandra2004/the-framework/releases)
[![Security](https://img.shields.io/badge/security-A%2B--grade-brightgreen.svg)](SECURITY.md)

[Website](https://framework.rf.gd) • [Documentation](#-documentation) • [Get Started](#-quick-start) • [Changelog](CHANGELOG.md)

</div>

---

## 🎯 About The Framework

**The Framework** is a modern, secure, and lightweight PHP framework designed with one mission: **make web development accessible to everyone**, including developers using free shared hosting without SSH access.

### Why The Framework?

```
✅ No VPS required          ✅ Laravel-like syntax
✅ Works on free hosting    ✅ Built-in security (WAF, CSRF)
✅ Zero configuration        ✅ Comprehensive documentation
✅ Web-based management     ✅ Production-ready
```

---

## 🚀 Quick Start

### Installation

```bash
# Clone the repository
git clone https://github.com/chandra2004/the-framework.git
cd the-framework

# Install dependencies
composer install

# Setup environment
php artisan setup

# Run development server
php artisan serve
```

Visit **http://127.0.0.1:8080** 🎉

---

## 📚 Documentation

Our documentation is comprehensive, well-organized, and beginner-friendly:

### **Getting Started**

- [📖 Introduction](docs/introduction.md) - What is The Framework?
- [⚙️ Installation](docs/installation.md) - Step-by-step installation guide
- [🏗️ Structure](docs/structure.md) - Understanding the folder structure
- [🔧 Configuration](docs/environment.md) - Environment variables guide

### **The Basics**

- [🛣️ Routing](docs/routing.md) - URL routing and parameters
- [🎨 Views &amp; Blade](docs/views.md) - Templating engine
- [🔐 Security](docs/security.md) - CSRF, XSS, WAF protection
- [✅ Validation](docs/validation.md) - Input validation rules

### **Database**

- [🗄️ Database](docs/database.md) - Query Builder & connections
- [📊 Migrations](docs/migrations.md) - Database version control
- [🔗 ORM &amp; Relations](docs/orm.md) - Eloquent-like ORM

### **Advanced Topics**

- [🏗️ Architecture](docs/architecture.md) - MVC pattern explained
- [🚀 Performance](docs/performance.md) - Caching & optimization
- [🧪 Testing](docs/testing-guide.md) - Unit & feature testing
- [🚢 Deployment](docs/deployment.md) - Deploy to production
- [🐳 Docker](docs/docker.md) - Containerization
- [🚨 Error Handling](docs/error-handling.md) - Exception patterns

### **Special Features**

- [🌐 Web Command Center](docs/web-command-center.md) - Manage without SSH
- [💻 Tinker (Interactive Shell)](docs/tinker.md) - Debug code live (CLI & Web) ⭐
- [🛠️ Artisan CLI](docs/artisan.md) - Command-line tools
- [🌍 Localization](docs/localization.md) - Multi-language support
- [🗺️ SEO & Sitemap](docs/seo.md) - SEO best practices
- [📧 Email](docs/email.md) - SMTP sending
- [💳 Payments](docs/payment.md) - Midtrans integration
- [📤 File Uploads](docs/file-uploads.md) - UploadHandler

📖 **[View Full Documentation](docs/README.md)**

---

## ✨ Key Features

### 🛡️ Security First (Grade A)

```php
// Built-in Web Application Firewall
WAFMiddleware::protect();

// Automatic CSRF protection
@csrf

// Secure headers out-of-the-box
X-Frame-Options, CSP, HSTS, XSS-Protection
```

### 🌐 Hosting Friendly (Unique!)

**The only PHP framework designed for shared hosting users:**

```bash
# No SSH? No problem! Use Web Command Center
https://yoursite.com/_system/migrate
https://yoursite.com/_system/seed
https://yoursite.com/_system/tinker  <-- NEW!
https://yoursite.com/_system/logs
```

Perfect for:

- ✅ InfinityFree, 000webhost, Hostinger
- ✅ Any shared hosting without SSH
- ✅ Students with limited budget

### ⚡ Developer Experience

```php
// Expressive routing (Laravel-like)
Router::get('/users/{id}', [UserController::class, 'show']);

// Powerful ORM
$users = User::with('posts')->where('active', true)->get();

// Clean blade templates
@extends('layouts.layout-homepage.app')
@section('content')
    <h1>{{ $title }}</h1>
@endsection
```

---

## 🎓 Learning Resources

### Official Guides

- 📘 [Getting Started Tutorial](docs/tutorial-blog.md)
- 📹 Video Tutorials _(coming soon)_
- 💬 Community Forum _(coming soon)_

### Example Projects

- 🛒 E-commerce Starter _(coming soon)_
- 📝 Blog Platform _(coming soon)_
- 🎫 Event Management _(coming soon)_

---

## 🔄 What's New in v5.0.0?

**Major Security & Stability Release**

### 🔐 Security & DX Enhancements

- ✅ **Fluent Migrations:** Chaining support for schema building (e.g., `->unique()`, `->index()`).
- ✅ **Smart Rate Limiting:** Local development bypass (never get blocked on localhost again).
- ✅ **Enhanced Helpers:** New `base_path()`, `storage_path()`, and `ip()` utilities.
- ✅ **Deep Optimization:** `php artisan optimize` now clears ratelimit and storage caches.
- ✅ **Premium Error UI:** Specialized dashboard for Blade errors with source mapping.

### 📖 [Read Full Changelog](CHANGELOG.md)

### 📖 [Upgrade Guide v4 → v5](UPGRADE_TO_5.0.0.md)

### 📖 [Release Notes](RELEASE_NOTES_5.0.0.md)

---

## 🤝 Contributing

We welcome contributions! Please see [CONTRIBUTING.md](CONTRIBUTING.md) for details.

### Ways to Contribute

- 🐛 Report bugs
- 💡 Suggest features
- 📝 Improve documentation
- 🔧 Submit pull requests

---

## 🛡️ Security Vulnerabilities

If you discover a security vulnerability, please email:

📧 **security@the-framework.ct.ws**

**DO NOT** create public GitHub issues for security vulnerabilities.

See [SECURITY.md](SECURITY.md) for our security policy.

---

## 📄 License

The Framework is open-sourced software licensed under the [MIT license](LICENSE).

---

## 💖 Credits

**Created with ❤️ by [Chandra Tri Antomo](https://framework.rf.gd)**

### Special Thanks

- Laravel team for inspiration
- Illuminate components
- All contributors and users

---

<div align="center">

**⭐ Star us on GitHub — it motivates us a lot!**

[Documentation](docs/README.md) • [Website](https://framework.rf.gd) • [GitHub](https://github.com/chandra2004/the-framework)

Made in 🇮🇩 Indonesia

</div>
