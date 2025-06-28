<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</p>

---

# 🔐 Emarah0X Lab

This project is a deliberately vulnerable Laravel-based web application created for **web penetration testing practice**.

Use it to explore and exploit real-world vulnerabilities safely in a local environment.

---

## 🐞 Included Vulnerabilities

- Broken Authentication
- Insecure Direct Object References (IDOR)
- SQL Injection
- Cross-Site Scripting (XSS)
- CSRF
- and more...

---

## ⚙️ Requirements

- PHP >= 8.1
- Composer
- MySQL / MariaDB
- Laravel CLI (optional)

---

## 🚀 Installation

```bash
# 1. Clone the repository
git clone https://github.com/your-username/your-repo-name.git
cd your-repo-name

# 2. Install dependencies
composer install

# 3. Copy environment file
cp .env.example .env

# 4. Configure database credentials in .env

# 5. Generate application key
php artisan key:generate

# 6. Create an empty database with the name in your .env file

# 7. Run database migrations
php artisan migrate

# 8. Serve the app locally
php artisan serve
