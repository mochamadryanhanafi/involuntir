# API Involuntir

Ini adalah API REST sederhana untuk sistem Manajemen Acara Relawan, dibangun dengan Laravel.

## Instalasi

1.  Clone repositori.
2.  Instal dependensi: `composer install`
3.  Salin `.env.example` ke `.env` dan konfigurasikan database Anda.
4.  Jalankan migrasi database: `php artisan migrate`
5.  Mulai server: `php artisan serve`

## Menjalankan proyek dengan Docker

1.  Pastikan Docker sudah terinstal dan berjalan.
2.  Bangun citra dan jalankan kontainer: `docker-compose up -d --build`
3.  Aplikasi akan tersedia di `http://localhost:8000`.

## Titik Akhir API (API Endpoints)

### Otentikasi

*   `POST /api/register` - Mendaftarkan pengguna baru.
*   `POST /api/login` - Masuk sebagai pengguna dan dapatkan token API.
*   `POST /api/logout` - Keluar sebagai pengguna (membutuhkan otentikasi).

### Acara

*   `GET /api/events` - Dapatkan daftar semua acara (membutuhkan otentikasi).
*   `POST /api/events` - Buat acara baru (membutuhkan otentikasi).
*   `GET /api/events/{id}` - Dapatkan acara tunggal berdasarkan ID (membutuhkan otentikasi).
*   `POST /api/events/{id}/join` - Bergabung dengan acara (membutuhkan otentikasi).

## Jawaban Pertanyaan

### 1. Apa bagian tersulit dari tugas ini?

Bagian tersulit adalah memastikan pengaturan lingkungan pengembangan yang benar, terutama saat berurusan dengan versi PHP, Composer, dan dependensi lainnya yang berbeda. Penyiapan awal database dengan Docker juga membutuhkan konfigurasi yang cermat.

### 2. Jika Anda diberi waktu 1 minggu, apa yang akan Anda tingkatkan?

*   **API Resources:** Saya akan menggunakan API Resources untuk memiliki kontrol lebih besar atas respons JSON dan untuk menstandardisasi format output.
*   **Pagination:** Saya akan menerapkan paginasi untuk daftar acara guna menangani data dalam jumlah besar dengan lebih efisien.
*   **Seeders:** Saya akan membuat seeder untuk mengisi database dengan data dummy agar lebih mudah dalam pengujian dan pengembangan.
*   **Kebijakan/Otorisasi (Policy/Authorization):** Saya akan mengimplementasikan kebijakan untuk memiliki kontrol yang lebih terperinci tentang siapa yang dapat melakukan tindakan tertentu (misalnya, hanya pembuat acara yang dapat menghapusnya).
*   **Penanganan Kesalahan (Error Handling):** Saya akan meningkatkan penanganan kesalahan untuk memberikan pesan kesalahan yang lebih spesifik dan membantu.
*   **Pengujian (Testing):** Saya akan menulis pengujian otomatis untuk memastikan API berfungsi dengan benar dan untuk mencegah regresi.

### 3. Mengapa Anda memilih pendekatan teknis ini?

Saya memilih untuk menggunakan Laravel karena ini adalah framework yang kuat dan matang yang menyediakan fondasi yang kokoh untuk membangun API REST. Ia memiliki ekosistem paket dan fitur yang kaya yang membuat pengembangan lebih cepat dan mudah.

*   **Laravel Sanctum:** Saya menggunakan Sanctum untuk otentikasi karena ini adalah solusi yang sederhana dan ringan untuk otentikasi token API. Mudah diatur dan digunakan, serta terintegrasi dengan baik dengan Laravel.
*   **Eloquent ORM:** Saya menggunakan Eloquent untuk interaksi database karena menyediakan API yang indah dan intuitif untuk bekerja dengan database. Ini memudahkan untuk mendefinisikan hubungan antar model dan untuk melakukan kueri yang kompleks.
*   **Docker:** Saya menggunakan Docker untuk database untuk memastikan lingkungan pengembangan yang konsisten dan dapat direproduksi. Ini memudahkan untuk menyiapkan dan menjalankan database tanpa harus menginstalnya langsung di mesin host.
*   **API RESTful:** Saya merancang API agar RESTful untuk memastikan bahwa API tersebut dapat diskalakan, mudah dipelihara, dan mudah digunakan oleh klien yang berbeda.
