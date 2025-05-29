# 🚀 Mini CRM - Laravel-Based CRM for Admins & Employees

Welcome to **mini_crm**, a Laravel-based mini customer relationship management system that provides role-based access and features for **Admins** and **Employees** with **real-time chat**. 🎯

---

## 📦 Features Overview

### 🔐 Authentication
- Admin authentication using Laravel’s built-in Auth routes.
- Separate authentication for employees.
- OTP-based password reset for employees.

### 👨‍💼 Admin Panel
- Employee management: create, edit, view, delete.
- Company management: create, edit, view, delete.
- Real-time chat with employees.
- Notification testing and chat filters.

### 👷 Employee Panel
- Login/logout system.
- Profile viewing and updating.
- Dashboard view.
- Real-time chat with admin (send/receive).
- OTP password reset system.

---

# ⚙️ Installation & Setup
```
git clone https://github.com/osamanisar-dev/mini_crm.git
cd mini_crm
composer install
cp .env.example .env
php artisan key:generate
```
Add you pusher credentials inside .env
# 🗄️ Migrate the database
```
php artisan migrate
```
# 🔥 Run the project
```
php artisan serve
```
# 🌟 License
This project is open-source and available under the MIT license.
