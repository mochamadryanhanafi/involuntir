![Demo Aplikasi](demo-app.gif)

# API Involuntir

Ini adalah API REST sederhana untuk sistem Manajemen Acara Relawan, dibangun dengan Laravel.

## Instalasi

1.  Clone repositori.
2.  Instal dependensi: `composer install`
3.  Salin `.env.example` ke `.env` dan konfigurasikan database Anda.
4.  Jalankan migrasi database: `php artisan migrate`
5.  Jalankan seeder database: `php artisan db:seed` (Ini akan mengisi database dengan data dummy, termasuk user dan event).
6.  Mulai server: `php artisan serve`

## Menjalankan proyek dengan Docker

1.  Pastikan Docker sudah terinstal dan berjalan.
2.  Bangun Image dan jalankan kontainer: `docker-compose up -d --build`
3.  Aplikasi akan tersedia di `http://localhost:8000`.

## Titik Akhir API (API Endpoints)

### Otentikasi

*   `POST /api/register` - Mendaftarkan pengguna baru.
*   `POST /api/login` - Masuk sebagai pengguna dan dapatkan token API.
*   `POST /api/logout` - Keluar sebagai pengguna (membutuhkan otentikasi).

### Acara

*   `GET /api/events` - Dapatkan daftar semua acara (paginasi didukung, membutuhkan otentikasi).
*   `POST /api/events` - Buat acara baru (membutuhkan otentikasi).
*   `GET /api/events/{id}` - Dapatkan acara tunggal berdasarkan ID (membutuhkan otentikasi).
*   `PUT /api/events/{id}` - Memperbarui acara (membutuhkan otentikasi, hanya pemilik acara).
*   `DELETE /api/events/{id}` - Menghapus acara (membutuhkan otentikasi, hanya pemilik acara).
*   `POST /api/events/{id}/join` - Bergabung dengan acara (membutuhkan otentikasi).

## Fitur Tambahan yang Diimplementasikan

*   **API Resources:** Digunakan untuk memformat respons JSON secara konsisten.
*   **Pagination:** Endpoint `/api/events` sekarang mendukung paginasi untuk daftar acara.
*   **Seeders:** Database dapat diisi dengan data dummy untuk pengguna dan acara menggunakan `php artisan db:seed`.
*   **Policy / Authorization:** Kebijakan telah diterapkan untuk mengontrol akses ke acara. Hanya pemilik acara yang dapat memperbarui atau menghapus acara mereka.
*   **Format Respon Error Konsisten:** Penanganan kesalahan kustom dan helper respons API memastikan semua respons kesalahan mengikuti format standar.
*   **Clean Architecture:** Struktur kode telah direfaktor menggunakan lapisan Service dan Repository untuk pemisahan tanggung jawab yang jelas.

## Jawaban Pertanyaan

### 1. Apa bagian tersulit dari tugas ini?

Bagian tersulit adalah memastikan pengaturan lingkungan pengembangan yang benar, terutama saat berurusan dengan versi PHP, Composer, dan dependensi lainnya yang berbeda. Penyiapan awal database dengan Docker juga membutuhkan konfigurasi yang cermat. Selain itu, restrukturisasi ke arsitektur bersih membutuhkan perencanaan dan implementasi yang cermat untuk memastikan pemisahan kekhawatiran yang tepat.

### 2. Jika Anda diberi waktu 1 minggu, apa yang akan Anda tingkatkan?

*   **Pengujian (Testing):** Saya akan menulis pengujian unit dan fungsional yang komprehensif untuk semua lapisan (Repository, Service, Controller) untuk memastikan keandalan dan mencegah regresi.
*   **Validasi yang Lebih Lanjut:** Menggunakan Form Requests untuk validasi input yang lebih rapi dan terpisah.
*   **Notifikasi:** Mengimplementasikan notifikasi (misalnya, email) ketika pengguna bergabung dengan acara atau saat acara baru dibuat.
*   **Manajemen Token dengan Redis:** Menggunakan Redis untuk manajemen token guna meningkatkan kinerja dan skalabilitas.
*   **Rate Limiting:** Menerapkan pembatasan pada Endpoint API untuk mencegah penyalahgunaan.

### 3. Mengapa Anda memilih pendekatan teknis ini?

Saya memilih untuk menggunakan Laravel karena ini adalah framework yang kuat dan matang yang menyediakan fondasi yang kokoh untuk membangun API REST. Ia memiliki ekosistem paket dan fitur yang kaya yang membuat pengembangan lebih cepat dan mudah.

*   **Laravel Sanctum:** Saya menggunakan Sanctum untuk otentikasi karena ini adalah solusi yang sederhana dan ringan untuk otentikasi token API. Mudah diatur dan digunakan, serta terintegrasi dengan baik dengan Laravel.
*   **Eloquent ORM:** Saya menggunakan Eloquent untuk interaksi database karena menyediakan API yang indah dan intuitif untuk bekerja dengan database. Ini memudahkan untuk mendefinisikan hubungan antar model dan untuk melakukan kueri yang kompleks.
*   **Docker:** Saya menggunakan Docker untuk database untuk memastikan lingkungan pengembangan yang konsisten dan dapat direproduksi. Ini memudahkan untuk menyiapkan dan menjalankan database tanpa harus menginstalnya langsung di mesin host.
*   **API RESTful:** Saya merancang API agar RESTful untuk memastikan bahwa API tersebut dapat diskalakan, mudah dipelihara, dan mudah digunakan oleh klien yang berbeda.
*   **Clean Architecture:** Mengadopsi arsitektur bersih dengan lapisan Service dan Repository memungkinkan pemisahan tanggung jawab yang lebih baik, membuat kode lebih mudah dipelihara, diuji, dan diskalakan. Ini memisahkan logika bisnis dari implementasi detail, yang sangat penting untuk proyek yang berkembang.