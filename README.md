<div align="center">

# 📚 BookStore

### Aplikasi Pembelian Buku Berbasis Web

<p>
  Dibangun menggunakan <strong>Laravel 12</strong>, <strong>MySQL</strong>, <strong>Blade</strong>, dan <strong>Tailwind CSS</strong>.
</p>

<p>
  <img src="https://img.shields.io/badge/Laravel-12-red?style=for-the-badge&logo=laravel" alt="Laravel 12">
  <img src="https://img.shields.io/badge/PHP-8.3-blue?style=for-the-badge&logo=php" alt="PHP 8.3">
  <img src="https://img.shields.io/badge/MySQL-Database-orange?style=for-the-badge&logo=mysql" alt="MySQL">
  <img src="https://img.shields.io/badge/Tailwind-CSS-38B2AC?style=for-the-badge&logo=tailwindcss" alt="Tailwind CSS">
</p>

</div>

---

## 📖 Tentang Project

**BookStore** adalah aplikasi web pembelian buku yang dibuat untuk memudahkan pengguna dalam mencari, memilih, dan membeli buku secara online.

Aplikasi memiliki dua jenis pengguna:

- **User**, yang dapat melihat katalog buku, menggunakan keranjang, checkout, melihat status pesanan, dan menghubungi admin.
- **Admin**, yang dapat mengelola kategori, buku, user, pesanan, serta pesan dari pelanggan.

---

## ✨ Fitur Utama

### 👤 User

| Fitur | Keterangan |
|---|---|
| Register & Login | Membuat akun dan masuk ke sistem |
| Katalog Buku | Melihat koleksi buku yang tersedia |
| Pencarian Buku | Mencari buku berdasarkan informasi tertentu |
| Detail Buku | Melihat informasi lengkap buku |
| Keranjang | Menambahkan dan mengatur jumlah buku |
| Checkout | Membuat pesanan |
| Pesanan Saya | Melihat riwayat dan status pesanan |
| Contact Admin | Mengirim pesan kepada admin |
| Balasan Admin | Melihat balasan pesan dari admin |
| Profile | Mengelola data akun |

### 🛠️ Admin

| Fitur | Keterangan |
|---|---|
| Dashboard | Melihat ringkasan aktivitas aplikasi |
| Kategori | CRUD kategori buku |
| Buku | CRUD data buku dan upload cover |
| User | Melihat data pengguna |
| Pesanan | Melihat dan mengubah status pesanan |
| Pesan | Membaca, membalas, dan menghapus pesan |

---

## 🧰 Teknologi

<div align="center">

| Teknologi | Fungsi |
|---|---|
| Laravel 12 | Framework backend |
| PHP 8.3 | Bahasa pemrograman |
| MySQL | Database |
| Blade | Template engine |
| Laravel Breeze | Authentication |
| Eloquent ORM | Interaksi database |
| Tailwind CSS | Styling |
| Alpine.js | Interaksi frontend |
| Git & GitHub | Version control |
| Laragon | Local development environment |

</div>

---

## 🏗️ Arsitektur Aplikasi

Project menggunakan pola **MVC (Model-View-Controller)**.

```text
User
  │
  ▼
Route
  │
  ▼
Controller
  │
  ├──────────────► View
  │
  ▼
Model
  │
  ▼
Database
```

### Model
Digunakan untuk mengelola data dan berinteraksi dengan database menggunakan Eloquent ORM.

```text
app/Models/
├── User.php
├── Book.php
├── Category.php
├── Order.php
├── OrderItem.php
└── ContactMessage.php
```

### View
Digunakan untuk menampilkan antarmuka aplikasi.

```text
resources/views/
```

### Controller
Menangani logika aplikasi dan menjadi penghubung antara Model dan View.

```text
app/Http/Controllers/
```

### Route
Mengatur URL dan request aplikasi.

```text
routes/web.php
```

---

## 👥 Role dan Hak Akses

| Role | Hak Akses |
|---|---|
| **Admin** | Mengelola kategori, buku, user, pesanan, dan pesan |
| **User** | Melihat buku, menggunakan keranjang, checkout, melihat pesanan, dan menghubungi admin |

Akses Admin dibatasi menggunakan middleware:

```text
app/Http/Middleware/AdminMiddleware.php
```

---

## 🗄️ Database

Aplikasi menggunakan **MySQL**.

Data utama yang digunakan:

```text
users
categories
books
orders
order_items
contact_messages
```

Struktur database dikelola melalui:

```text
database/migrations/
```

---

## 🔄 Alur User

```text
Register / Login
        │
        ▼
Dashboard User
        │
        ▼
Katalog Buku
        │
        ▼
Detail Buku
        │
        ▼
Tambah ke Keranjang
        │
        ▼
Keranjang
        │
        ▼
Checkout
        │
        ▼
Pesanan
        │
        ▼
Status Pesanan
```

---

## 🔄 Alur Admin

```text
Login Admin
     │
     ▼
Dashboard Admin
     │
     ├── Kelola Kategori
     ├── Kelola Buku
     ├── Lihat User
     ├── Kelola Pesanan
     └── Kelola Pesan
```

---

## 📁 Struktur Project

```text
bookstore/
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   └── User/
│   │   └── Middleware/
│   │
│   └── Models/
│
├── database/
│   ├── migrations/
│   └── seeders/
│
├── public/
│
├── resources/
│   └── views/
│       ├── admin/
│       ├── user/
│       ├── auth/
│       ├── components/
│       └── layouts/
│
├── routes/
│   ├── web.php
│   └── auth.php
│
├── storage/
│
├── artisan
├── composer.json
└── README.md
```

---

## ⚙️ Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/ellienie/Bookstore.git
```

### 2. Masuk ke Folder Project

```bash
cd Bookstore
```

### 3. Install Dependency

```bash
composer install
```

### 4. Copy Environment

Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

Atau copy manual:

```text
.env.example → .env
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Konfigurasi Database

Ubah bagian database pada `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bookstore
DB_USERNAME=root
DB_PASSWORD=
```

### 7. Migration & Seeder

```bash
php artisan migrate --seed
```

### 8. Storage Link

```bash
php artisan storage:link
```

### 9. Jalankan Aplikasi

```bash
php artisan serve
```

Buka:

```text
http://127.0.0.1:8000
```

---

## 🔐 Keamanan

Beberapa fitur keamanan yang digunakan:

- Authentication
- Password hashing
- CSRF Protection
- Middleware
- Role-based access
- Server-side validation
- File upload validation
- Environment configuration melalui `.env`

---

## 📌 Repository

<div align="center">

### GitHub Repository

**https://github.com/ellienie/Bookstore**

</div>

---

## 👩‍💻 Developer

<div align="center">

**ellienie**

BookStore dibuat sebagai project aplikasi web pembelian buku untuk kebutuhan praktik dan asesmen kompetensi pemrograman.

</div>
