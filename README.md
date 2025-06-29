<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</p>

---

# 🔐 Emarah0X Lab

**Emarah0X Lab** is a vulnerable application built for hands-on web penetration testing practice in a safe environment.

This project is deliberately designed with multiple security flaws to help learners and professionals practice identifying and exploiting real-world vulnerabilities.

Use it to explore and test common web security issues safely in a local setup.

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
git clone https://github.com/Mohammed-Emarah23/EmarahoXLab.git
cd EmarahoXLab

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
