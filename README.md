# Appointment System in Hospital

Sistem penjadwalan janji atau appointment system adalah mekanisme yang dirancang untuk mengelola pengalokasian sumber daya secara efisien, seperti tenaga kerja atau waktu layanan, dalam berbagai konteks, terutama dalam layanan kesehatan. Aplikasi ini membantu rumah sakit dalam mengatur jadwal dokter, pasien, dan penggunaan fasilitas secara terstruktur dan efektif.

## Fitur Utama

-   **Penjadwalan**: Sistem mendukung pembuatan/pendaftaran jadwal janji temu.
-   **Manajemen Pengguna**: Dokter, pasien, dan admin dapat dikelola dalam aplikasi.
-   **Riwayat Janji Temu**: Menyimpan data janji temu.

## Teknologi yang Digunakan

-   **Backend**: [Laravel 9](https://laravel.com/docs/9.x)
-   **Frontend**: Blade templates
-   **Database**: MySQL
-   **Server Requirements**:
    -   PHP >= 8.0.2
    -   Composer
    -   MySQL

---

## Cara Clone dan Instalasi

### Prasyarat

Pastikan Anda telah menginstal prasyarat berikut di mesin Anda:

-   PHP >= 8.0.2
-   Composer
-   MySQL

### Langkah-langkah

1. **Clone Repository**

    ```bash
    git clone https://github.com/aloysiusrio/BK-hospital-appointment-app.git
    cd BK-hospital-appointment-app
    ```

2. **Install Dependencies**
   Jalankan perintah berikut untuk menginstal dependensi Laravel:

    ```bash
    composer install
    ```

3. **Buat File `.env`**
   Salin file `.env.example` menjadi `.env`:

    ```bash
    cp .env.example .env
    ```

    Lalu, konfigurasi detail database Anda di file `.env`.

4. **Generate Application Key**
   Jalankan perintah berikut untuk menghasilkan application key:

    ```bash
    php artisan key:generate
    ```

5. **Migrasi Database**
   Jalankan migrasi untuk membuat tabel-tabel database:

    ```bash
    php artisan migrate
    ```

6. **Seed Database**
   untuk memasukkan data awal, jalankan perintah berikut:

    ```bash
    php artisan db:seed
    ```

7. **Jalankan Aplikasi**
   Untuk menjalankan aplikasi dalam development server:

    ```bash
    php artisan serve
    ```

    Buka browser dan akses: [http://localhost:8000](http://localhost:8000)

8. **Informasi Login Admin**
    - **Email**: `admin@admin.com`
    - **Password**: `admin`

---
