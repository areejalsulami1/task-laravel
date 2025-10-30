# Laravel Task Project

This project was built as part of a technical assessment using **PHP, Laravel, MySQL, HTML, CSS, and JavaScript**.

---

## 🚀 Project Overview
A simple web application with:
- **Login Page** — user authentication via AJAX without page reload.
- **Users Page** — display all users with options to Add, Edit, and Delete (AJAX-based CRUD).
- **Logs Page** — record every action (login, add, edit, delete) showing user, action, and timestamp.

---

## ⚙️ Technologies Used
- **PHP** (Laravel Framework)
- **MySQL** (Database)
- **HTML, CSS, JavaScript**
- **AJAX** for asynchronous requests (no page reload)
- **Bootstrap** for styling and layout

---

## 🗃️ Database Setup
1. Create a new database named `task_project` in phpMyAdmin.
2. Import the included SQL file (`database/sql/task_project.sql`).
3. Update `.env` file:


DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_db
DB_USERNAME=root
DB_PASSWORD=


---

## 🖥️ How to Run Locally
1. Clone the repository:
```bash
git clone https://github.com/areejalsulami1/task-laravel1.git

2-Navigate to the project:
cd task-laravel1


3-Install dependencies:
composer install


4-Run the local server:
php artisan serve


5-Open in browser:
http://127.0.0.1:8000

