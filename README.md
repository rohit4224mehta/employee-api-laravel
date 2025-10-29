<a href="https://github.com/rohitmehta/employee-api" target="_blank">
  <img src="https://img.shields.io/github/stars/rohitmehta/employee-api?style=social" alt="GitHub Stars">
</a>
<a href="https://laravel.com" target="_blank">
  <img src="https://img.shields.io/badge/Laravel-10-ff2d20?logo=laravel&logoColor=white" alt="Laravel 10">
</a>
<a href="https://github.com/rohitmehta/employee-api/blob/main/LICENSE" target="_blank">
  <img src="https://img.shields.io/github/license/rohitmehta/employee-api" alt="License">
</a>

---

# 👨‍💻 Employee Management API (Laravel + Sanctum)

> **A secure, production-ready REST API** for managing employees with **token-based authentication** using **Laravel Sanctum**.  
> Built for **Werkstudent / Internship portfolios** — clean code, full testing, and Render-ready deployment.

---

## 🚀 Features

| Feature | Description |
|----------|-------------|
| 🔐 Laravel Sanctum Auth | Token generation (`/api/login`, `/api/register`) |
| ⚙️ Full CRUD | Create, Read, Update, Delete employees |
| 🔎 Pagination & Filtering | `?page=2`, `?position=Developer` |
| 🧾 Validation & Error Handling | Proper 422 JSON responses |
| 🖥️ Admin Panel | Web dashboard (Blade + Bootstrap 5) |
| 🧪 Postman Collection | Ready-to-import API tests |
| ☁️ Render Deploy | Free hosting setup guide |

---

## 🧰 Tech Stack

| Layer | Technology |
|-------|-------------|
| **Backend** | Laravel 10 |
| **Authentication (API)** | Laravel Sanctum |
| **Authentication (Web)** | Laravel Breeze (Session) |
| **Database** | MySQL |
| **Frontend** | Blade + Bootstrap 5 |
| **Testing** | Postman |
| **Hosting** | Render.com |

---

## 📡 API Endpoints

| Method | Endpoint | Description | Auth |
|--------|-----------|-------------|------|
| `POST` | `/api/register` | Register new user | No |
| `POST` | `/api/login` | Login & get token | No |
| `GET` | `/api/employees` | List all (paginated) | Yes |
| `GET` | `/api/employees?position=Developer` | Filter by position | Yes |
| `POST` | `/api/employees` | Create employee | Yes |
| `GET` | `/api/employees/{id}` | Show single employee | Yes |
| `PUT` | `/api/employees/{id}` | Update employee | Yes |
| `DELETE` | `/api/employees/{id}` | Delete employee | Yes |
| `POST` | `/api/logout` | Revoke current token | Yes |

---

## 🌍 Live Demo

<a href="https://employee-api.onrender.com" target="_blank">
  <img src="https://img.shields.io/badge/Live%20Demo-Click%20Here-brightgreen?style=for-the-badge&logo=vercel" alt="Live Demo">
</a>

- **API Base URL:** `https://employee-api.onrender.com/api`
- **Admin Panel:** `https://employee-api.onrender.com/employees` *(login required)*

---

## ⚙️ Setup Instructions

### 🧩 1. Clone Repository
```bash
git clone https://github.com/rohitmehta/employee-api.git
cd employee-api
