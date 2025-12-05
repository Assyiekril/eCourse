# eCourse - Platform Learning Management System (LMS) 🎓

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)

**eCourse** adalah aplikasi pembelajaran online berbasis web yang dibangun dengan Laravel. Aplikasi ini dirancang untuk menghubungkan pengajar dan siswa dengan antarmuka modern, sistem manajemen kursus yang lengkap, dan pembagian hak akses (role) yang aman.


---

## 🚀 Fitur Unggulan

### 1. Multi-Role Authentication
Sistem keamanan berbasis role yang memisahkan akses untuk:
* **Admin:** Mengelola User (Teacher/Student) dan Kategori Kursus.
* **Teacher:** Membuat Kursus, Menyusun Silabus/Materi, dan Mengelola Status Publikasi.
* **Student:** Melihat Katalog, Mendaftar Kursus (Enroll), dan Mengakses Materi Belajar.

### 2. Modern "Cyberpunk" Dashboard
Antarmuka pengguna (UI) yang unik dengan tema Dark Mode, sentuhan futuristik, tekstur noise, dan komponen interaktif yang responsif (Mobile Friendly).

### 3. Manajemen Kursus & Materi
* **Course Repository:** Guru dapat membuat kursus dengan status *Draft* atau *Published*.
* **Content Management:** Penambahan materi/bab pelajaran ke dalam setiap kursus.
* **Dynamic Categorization:** Pengelompokan kursus berdasarkan kategori (Web Dev, Data Science, Design, dll).

### 4. Sistem Enrollment (Pendaftaran)
* Siswa dapat bergabung (*Join*) ke kursus yang tersedia di katalog.
* Validasi otomatis mencegah pendaftaran ganda.
* Dashboard siswa menampilkan daftar kursus yang sedang aktif diikuti.

---

## 🛠️ Instalasi & Menjalankan Project

Ikuti langkah berikut untuk menjalankan project ini di komputer lokal (Localhost):

### 1. Clone Repository
Buka terminal dan clone project ini ke direktori lokal Anda:
```bash
git clone [https://github.com/Assyiekril/eCourse.git](https://github.com/Assyiekril/eCourse.git)
cd eCourse
```

### 2. Install Dependencies
Install library yang dibutuhkan menggunakan Composer dan NPM:
```bash
composer install
npm install
```

### 3. Konfigurasi Environment
Salin file konfigurasi .env dan sesuaikan database:
```bash
cp .env.example .env
```
Buka file .env dan atur koneksi database kamu:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_kamu
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate Key & Migrasi Database
Jalankan perintah berikut untuk mengenerate key aplikasi dan mengisi database dengan tabel serta data dummy (Seeder):

```bash
php artisan key:generate
php artisan migrate:fresh --seed
```

> Catatan: Perintah --seed sangat penting dijalankan karena akan membuatkan akun Admin, Teacher, Student, Kategori, dan Materi Kursus secara otomatis.

### 5. Build Assets & Jalankan Server
```bash
npm run build
php artisan serve
```

Akses aplikasi di browser melalui: http://127.0.0.1:8000

### 📂 Struktur Database Utama

users: Menyimpan data pengguna dan role (admin, teacher, student).

courses: Data utama kursus (judul, deskripsi, status).

contents: Materi pelajaran yang berelasi dengan courses.

categories: Master data kategori kursus.

course_user: Tabel pivot (Many-to-Many) yang menyimpan data siswa yang mendaftar di kursus.