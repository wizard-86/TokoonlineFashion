# Toko Online Fashion

Website toko online fashion yang dikembangkan menggunakan Laravel sebagai tugas mata kuliah Pemrograman Web. Aplikasi ini memungkinkan pengguna untuk melihat katalog produk fashion, melakukan pembelian, serta mengelola data produk melalui sistem berbasis web.

## Deskripsi Proyek

Toko Online Fashion merupakan aplikasi e-commerce yang menyediakan berbagai produk fashion seperti pakaian, celana, jaket, dan aksesoris. Website ini dirancang dengan antarmuka yang responsif sehingga dapat diakses melalui perangkat desktop maupun mobile.

## Fitur Utama

- Menampilkan katalog produk fashion
- Detail produk
- Keranjang belanja (Shopping Cart)
- Sistem autentikasi pengguna
- Manajemen produk
- Manajemen kategori produk
- Responsive Design
- Dashboard Admin

## Teknologi yang Digunakan

- Laravel
- PHP
- MySQL
- Blade Template Engine
- Bootstrap
- Vite
- CSS
- JavaScript

## Struktur Proyek

```
TokoonlineFashion/
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
├── resources/
├── routes/
├── storage/
├── tests/
├── artisan
├── composer.json
├── package.json
└── vite.config.js
```

## Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/wizard-86/TokoonlineFashion.git
cd TokoonlineFashion
```

### 2. Install Dependency PHP

```bash
composer install
```

### 3. Install Dependency Frontend

```bash
npm install
```

### 4. Konfigurasi Environment

Salin file `.env.example` menjadi `.env`

```bash
cp .env.example .env
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Konfigurasi Database

Edit file `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tokoonlinefashion
DB_USERNAME=root
DB_PASSWORD=
```

### 7. Migrasi Database

```bash
php artisan migrate
```

### 8. Jalankan Server

```bash
php artisan serve
```

### 9. Jalankan Vite

```bash
npm run dev
```

Akses aplikasi melalui:

```
http://127.0.0.1:8000
```

## Tim Pengembang

| Nama | Peran |
|--------|--------|
| Moch. Vicky Ardiansyah |
| Revaldo Faiz |
| Rama Aditya |

## Tujuan Pembelajaran

- Menerapkan konsep MVC pada Laravel.
- Mengembangkan aplikasi web berbasis framework.
- Mengimplementasikan CRUD pada database.
- Memahami proses pengembangan aplikasi e-commerce.
- Mengelola proyek menggunakan Git dan GitHub.

## Lisensi

Proyek ini dibuat untuk keperluan akademik dan pembelajaran pada mata kuliah Pemrograman Web.

---

**Tugas Pemrograman Web 2025**  
**Kelompok: Moch. Vicky Ardiansyah, Revaldo Faiz, Rama Aditya**
