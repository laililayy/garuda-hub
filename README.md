# Garuda Hub

Garuda Hub adalah aplikasi berbasis web untuk mempertemukan klien yang membutuhkan jasa pengembangan proyek dengan developer yang menawarkan layanan pengembangan. Aplikasi ini dikembangkan sebagai proyek pembelajaran menggunakan Laravel dengan pendekatan MVC dan Eloquent ORM.

## Fitur Utama

- **Autentikasi:** registrasi, login, dan logout.
- **Manajemen Proyek:** klien dapat membuat, melihat, mengubah, dan menghapus proyek.
- **Pencarian Proyek:** pengguna dapat mencari proyek berdasarkan informasi yang tersedia.
- **Penawaran (Bidding):** developer dapat mengajukan penawaran harga, durasi pengerjaan, dan proposal.
- **Pemilihan Developer:** klien dapat memilih salah satu penawaran sebagai pemenang.
- **Dashboard:** menampilkan informasi sesuai peran pengguna.
- **Manajemen Pengguna:** admin dapat melihat, mencari, dan menghapus akun pengguna.

## Hak Akses Pengguna

| Role | Hak Akses |
|---|---|
| Klien | Mengelola proyek dan memilih developer pemenang. |
| Developer | Melihat proyek dan mengajukan penawaran. |
| Admin | Mengelola pengguna serta mengakses fitur administrasi. |

## Teknologi

- PHP 8.3
- Laravel 13
- MySQL
- Eloquent ORM
- Blade Template
- HTML dan CSS
- Git dan GitHub

## Persyaratan Sistem

Pastikan perangkat telah memiliki:

- PHP 8.3 atau versi yang kompatibel.
- Composer.
- MySQL.
- Node.js dan NPM.
- Web server lokal, seperti Laragon.

## Instalasi dan Menjalankan Aplikasi

1. Clone repository:

   ```bash
   git clone https://github.com/laililayy/garuda-hub.git
   ```

2. Masuk ke direktori proyek:

   ```bash
   cd garuda-hub
   ```

3. Install dependency PHP:

   ```bash
   composer install
   ```

4. Buat file konfigurasi lingkungan:

   ```bash
   cp .env.example .env
   ```

   Pada Windows, file `.env.example` juga dapat disalin secara manual menjadi `.env`.

5. Generate application key:

   ```bash
   php artisan key:generate
   ```

6. Buat database MySQL dengan nama `garuda_hub`, kemudian sesuaikan konfigurasi database pada file `.env`:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=garuda_hub
   DB_USERNAME=root
   DB_PASSWORD=
   ```

7. Jalankan migration:

   ```bash
   php artisan migrate
   ```

8. Install dependency frontend:

   ```bash
   npm install
   ```

9. Jalankan aplikasi:

   ```bash
   php artisan serve
   ```

10. Buka alamat berikut pada browser:

    `http://127.0.0.1:8000`

## Pengujian

Pengujian aplikasi dapat dijalankan menggunakan perintah:

```bash
php artisan test
```

## Struktur Database

Aplikasi menggunakan tiga tabel utama:

- **users:** menyimpan data akun dan peran pengguna.
- **projects:** menyimpan informasi proyek yang dibuat oleh klien.
- **bids:** menyimpan penawaran developer terhadap proyek.

Relasi antartabel dikelola menggunakan Eloquent ORM.

## Catatan

Garuda Hub dikembangkan untuk keperluan pembelajaran dan demonstrasi penerapan arsitektur MVC, ORM, autentikasi, otorisasi, serta operasi CRUD menggunakan Laravel.

Aplikasi ini belum ditujukan untuk penggunaan produksi.