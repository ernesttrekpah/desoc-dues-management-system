<p align="center">
  <img src="docs/screenshots/logo.png" width="120" alt="DESOC Logo">
</p>

<h1 align="center">DESOC Dues Management System (DDMS)</h1>

<p align="center">
  <em>A smart, secure way to manage and monitor Design Society dues and souvenirs.</em><br>
  Built with ❤️ using Laravel & Bootstrap.
</p>

---

## ✨ Features

- **Authentication & Security**
  - Login via **index number + password**
  - Lock screen / unlock flow
  - Roles: `student`, `admin`, `superadmin`

- **Levels**
  - Manage levels (e.g., Level 100, 200, etc.)
  - CRUD + PDF export

- **Academic Years**
  - Define years (e.g., 2024/2025)
  - CRUD + PDF export

- **Students**
  - Register students with **index number, name, level, academic year**
  - CRUD + PDF export

- **Souvenirs**
  - Assign to academic year & level
  - Status: available / unavailable
  - CRUD + PDF export

- **Dues Setup**
  - Define dues amounts by academic year + level
  - CRUD + PDF export

- **Dues Payments**
  - Record payments with date, amount, student, due, souvenirs collected
  - Smart filters: academic year + level → students auto-filter
  - Auto-load souvenirs
  - Status: `pending`, `confirmed`, `cancelled`
  - CRUD + PDF export

- **Reports**
  - Dues reports filtered by academic year + level
  - Export to PDF

- **UI/UX**
  - Branded **hero dashboard** with gradient overlay
  - Auth pages with **full-screen gradient background**
  - Clean responsive design (Bootstrap 5 Volt)

---

## 🧰 Tech Stack

- **Backend:** Laravel 12.x, PHP 8.2  
- **Database:** MySQL / MariaDB  
- **Frontend:** Blade, Bootstrap 5 (Volt), Vanilla JS (Fetch API)  
- **PDF Export:** barryvdh/laravel-dompdf  
- **Notifications:** SweetAlert2, Notyf  

---

## 🚀 Getting Started

### 1. Clone & Install

```bash
git clone <your-repo-url> desoc-ddms
cd desoc-ddms

cp .env.example .env
composer install
php artisan key:generate



2. Configure .env
APP_NAME="DESOC DDMS"
APP_URL=http://127.0.0.1:8181

DB_DATABASE=desoc_ddms
DB_USERNAME=root
DB_PASSWORD=


3. Migrate & Seed

php artisan migrate
php artisan db:seed

4. Serve
php artisan serve --host=127.0.0.1 --port=8181


📊 Routes Overview

Dashboard: /dashboard

Students: /dashboard/students

Levels: /dashboard/levels

Academic Years: /dashboard/academic-years

Souvenirs: /dashboard/souvenirs

Dues Setup: /dashboard/dues-setup

Dues Payments: /dashboard/dues-payments

Reports: /dashboard/reports/dues

Smart AJAX Endpoints:

/dashboard/students/{student}/info

/dashboard/students/by-year-level/{year}/{level}

/dashboard/souvenirs/{level_id}/{academic_year_id}



👥 Project Structure (simplified)
app/
  Http/Controllers/
    AcademicYearController.php
    AuthController.php
    DueController.php
    DuesPaymentController.php
    DuesPaymentReportController.php
    LevelController.php
    SouvenirController.php
    StudentController.php
  Models/
    AcademicYear.php
    Due.php
    DuesPayment.php
    Level.php
    Souvenir.php
    Student.php
    User.php
resources/views/
  auth/
  dashboard/
    layout/
    index/
    students/
    levels/
    academic_year/
    souvenirs/
    dues/
    dues_payments/
    reports/
docs/screenshots/  # screenshots for README


📝 License

Open-sourced under the MIT license.


📌 Credits

Laravel

Bootstrap Volt

barryvdh/laravel-dompdf

SweetAlert2, Notyf