# Sistem Informasi Perpustakaan

Sistem Informasi Perpustakaan adalah aplikasi perpustakaan online yang dibangun menggunakan PHP dan MySQL. Aplikasi ini memungkinkan pengguna untuk mendaftar sebagai anggota, meminjam buku, dan mengelola buku yang mereka pinjam.

## Fitur

- **Registrasi Anggota**: Pengguna dapat mendaftar sebagai anggota perpustakaan.
- **Manajemen Buku**: Admin dapat menambahkan, mengedit, dan menghapus buku.
- **Peminjaman Buku**: Anggota dapat meminjam dan mengembalikan buku.
- **Dashboard Admin**: Admin dapat mengelola anggota dan buku.
- **Dashboard Anggota**: Anggota dapat melihat dan mengelola buku yang mereka pinjam.

## Persyaratan Sistem

- PHP 7.4 atau lebih tinggi
- MySQL 5.7 atau lebih tinggi
- Server web (Apache, Nginx, dll.)
- Composer (untuk manajemen dependensi)

## Instalasi

1. **Clone Repository**

   ```bash
   git clone https://github.com/yogafhrzki/perpusonlen.git
   cd perpusonlen
   ```

2. **Instal Dependensi**

   ```bash
   composer install
   ```

3. **Konfigurasi Database**

   Buat database baru di MySQL dan impor file `database.sql` yang terdapat di dalam folder `database`.

   ```sql
   CREATE DATABASE perpustakaan_online;
   USE perpustakaan_online;
   SOURCE path/to/perpustakaan_online.sql;
   ```

   Ubah pengaturan database di file `config.php` sesuai dengan konfigurasi database Anda.

   ```php
   <?php
   $host = 'localhost';
   $db = 'perpustakaan_online';
   $user = 'root';
   $pass = 'password';
   ```



## Struktur Direktori

- `database/` - Berisi file SQL untuk membuat dan mengisi tabel database.
- `includes/` - Berisi file PHP untuk koneksi database dan fungsi umum.
- `templates/` - Berisi file HTML template.
- `public/` - Berisi file CSS, JS, dan gambar.
- `config.php` - File konfigurasi database.
- `index.php` - Berkas utama untuk menjalankan aplikasi.

## Kontribusi

Jika Anda ingin berkontribusi pada proyek ini, silakan buat pull request atau buka issue baru untuk diskusi.

Saya berharap ini memberikan gambaran yang jelas tentang bagaimana mengatur dan menjalankan aplikasi perpustakaan online. Jika Anda memiliki pertanyaan atau membutuhkan bantuan lebih lanjut, jangan ragu untuk menghubungi saya melalui [link repository GitHub](https://github.com/yogafhrzki/perpusonlen).
