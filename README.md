# ☕ Sistem Informasi Pemesanan & Manajemen Stok Coffeeshop (SIPAKAR)

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![Filament](https://img.shields.io/badge/Filament_v3-F2B329?style=for-the-badge&logo=laravel&logoColor=black)](https://filamentphp.com)
[![FastAPI](https://img.shields.io/badge/FastAPI-009688?style=for-the-badge&logo=fastapi&logoColor=white)](https://fastapi.tiangolo.com)
[![Python](https://img.shields.io/badge/Python_3.10+-3776AB?style=for-the-badge&logo=python&logoColor=white)](https://python.org)
[![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)

**SIPAKAR Coffeeshop** adalah aplikasi manajemen bisnis coffee shop modern berbasis web. Aplikasi ini mengintegrasikan platform pemesanan mandiri untuk pelanggan (*Self-Ordering System*), panel administrasi berbasis **Filament v3**, pemotongan stok bahan baku otomatis berbasis resep, serta **Machine Learning Microservice** untuk prediksi ketersediaan dan rekomendasi pemulihan stok.

---

## 👥 Tim Kontributor & Pengembang

| Nama Lengkap | NIM |
| :--- | :--- |
| **Arizal Firdaus Bagus Pratama** | `2413010683` |
| **Muhammad Hanif Hidayah Saputra** | `2413010698` |
| **Hanif Difa Syarifudin** | `2413010681` |
| **Ridwan Rafli Hidayat** | `2413010672` |

---

## 🛠️ Dokumentasi Development

Dokumentasi Development ini memuat panduan arsitektur teknis, prasyarat lingkungan, serta langkah-langkah dalam menyiapkan (*setup*) dan menjalankan lingkungan pengembangan (*local development environment*).

### 📐 Arsitektur Sistem
Aplikasi ini dibangun menggunakan pendekatan **Hybrid Microservice**:
1. **Laravel 10/11 (Main Core)**: Menangani routing pelanggan, otentikasi (Socialite & OTP), manajemen pesanan, dan Filament Admin Panel.
2. **FastAPI ML Microservice (`/ml-api`)**: Service Python terpisah yang mengeksekusi model Machine Learning (`model_dt.pkl`) untuk memprediksi kategori menu *Laris* vs *Kurang Laris* dan memberikan rekomendasi stok.
3. **Database Layer**: Menggunakan MySQL / PostgreSQL (Supabase) dengan dukungan migrasi & seeder penuh.

---

### 💻 Prasyarat Sistem (Prerequisites)
Sebelum menjalankan proyek, pastikan perangkat Anda telah terpasang software berikut:
- **PHP** `>= 8.2` (dengan ekstensi `pdo`, `mbstring`, `openssl`, `curl`, `gd`)
- **Composer** `>= 2.x`
- **Node.js** `>= 18.x` & **NPM**
- **Python** `>= 3.10` & `pip`
- **Database**: MySQL `>= 8.0` atau PostgreSQL (Supabase)

---

### 🚀 Langkah-Langkah Setup (Development Installation)

#### 1. Clone Repository & Install Dependensi PHP/JS
```bash
git clone https://github.com/kampusriset/24f_laravel_sipakar_coffeshop.git
cd 24f_laravel_sipakar_coffeshop

# Install dependensi Laravel
composer install

# Install dependensi Frontend
npm install
```

#### 2. Konfigurasi Environment (`.env`)
Salin file environment dan generate Application Key:
```bash
cp .env.example .env
php artisan key:generate
```

Pastikan pengaturan database di `.env` sudah sesuai:
```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=coffeeshop
DB_USERNAME=root
DB_PASSWORD=
```

#### 3. Migrasi & Seeder Database
Jalankan migrasi database beserta data awal (*default admin, kasir, menu, kategori, dan bahan baku*):
```bash
php artisan migrate:fresh --seed
php artisan storage:link
```

#### 4. Setup Microservice Machine Learning (Python FastAPI)
Masuk ke direktori `ml-api` dan siapkan virtual environment:
```bash
cd ml-api
python3 -m venv venv
source venv/bin/activate # Di Windows: venv\Scripts\activate
pip install -r requirements.txt
cd ..
```

---

### ⚡ Menjalankan Aplikasi

Anda dapat menjalankan seluruh komponen aplikasi (Laravel Web, Filament Admin, Vite Assets, dan FastAPI ML Service) secara **otomatis** dengan 1 perintah:

- **Linux / macOS**:
  ```bash
  ./start-dev.sh
  ```
- **Windows**:
  ```cmd
  start-dev.bat
  ```

Aplikasi akan aktif di alamat:
- 🌐 **Web Pelanggan**: `http://localhost:8000`
- ⚙️ **Admin Panel (Filament)**: `http://localhost:8000/admin`
- 🤖 **Machine Learning API**: `http://localhost:8001/docs`

#### 🔐 Kredensial Pengguna Bawaan (Default Credentials):
- **Super Admin**: `admin@coffeeshop.com` | Password: `admin123`
- **Kasir**: `kasir@coffeeshop.com` | Password: `kasir123`
- **Pelanggan Demo**: `user@coffeeshop.com` | Password: `user123`

---

## 📊 Alur & Flowchart Sistem

Berikut adalah diagram alur proses utama yang berjalan dalam aplikasi **SIPAKAR Coffeeshop**:

### 1. Alur Pemesanan Pelanggan & Pengurangan Stok Otomatis
Flowchart ini menjelaskan bagaimana pelanggan memilih menu, sistem mengecek stok bahan baku, hingga stok terpotong secara otomatis saat transaksi dibuat:

![Flowchart Pemesanan & Stok](public/flowchart/flowchart_pemesanan_stok.png)

<details>
<summary><b>Lihat Kode Mermaid</b></summary>

```mermaid
graph TD
    A["Pelanggan Buka Web Coffeeshop"] --> B["Lihat Daftar Menu & Status Stok"]
    B --> C{"Apakah Bahan Baku Menu Tersedia?"}
    C -->|Tidak| D["Tombol Add Mati & Tampil Badge Stok Habis"]
    C -->|Ya| E["Pelanggan Tambahkan Menu ke Keranjang"]
    E --> F["Isi Form Pemesanan: Nama, Meja, Metode Bayar"]
    F --> G["Klik Tombol Pesan Sekarang"]
    G --> H{"Sistem Pengecekan Ketersediaan Stok"}
    H -->|Stok Kurang| I["Tampilkan Pesan Peringatan Stok Tidak Cukup"]
    H -->|Stok Cukup| J["Simpan Data Pesanan & Detail Pesanan"]
    J --> K["Otomatis Reduction/Decrement Stok Bahan Baku di Database"]
    K --> L["Tampilkan Ringkasan & Struk Pesanan"]
    L --> M["Selesai"]
```
</details>

---

### 2. Alur Registrasi Akun Pelanggan (Email + OTP Dummy & Google Socialite)
Flowchart ini menggambarkan proses registrasi akun baru untuk pelanggan guna mendapatkan diskon promo acak:

![Flowchart Registrasi & OTP](public/flowchart/flowchart_registrasi_otp.png)

<details>
<summary><b>Lihat Kode Mermaid</b></summary>

```mermaid
graph TD
    Start["Pengguna Masuk Halaman Register"] --> Choice{"Pilih Metode Pendaftaran"}
    Choice -->|Google Socialite| GAuth["Klik Daftar dengan Google"]
    GAuth --> GCallback["Redirect ke Google OAuth Callback"]
    GCallback --> GCheck{"User Sudah Ada?"}
    GCheck -->|Ya| GLogin["Login Langsung"]
    GCheck -->|Tidak| GCreate["Buat Akun Baru + Set Role user"]
    GCreate --> GLogin

    Choice -->|Email & Password| FormSubmit["Isi Nama, Email, Password"]
    FormSubmit --> GenOTP["Sistem Generate 6-Digit OTP Dummy"]
    GenOTP --> SaveSession["Simpan Data Sementara di Sesi"]
    SaveSession --> OTPPage["Redirect ke Halaman Verifikasi OTP"]
    OTPPage --> Banner["Tampilkan Banner OTP Simulasi"]
    Banner --> InputOTP["Input 6 Digit Kode OTP"]
    InputOTP --> Verify{"Apakah Kode Match?"}
    Verify -->|Tidak| ErrorMsg["Tampilkan Pesan Error OTP Salah"]
    ErrorMsg --> InputOTP
    Verify -->|Ya| CreateAccount["Buat Akun User Baru & Hapus Sesi OTP"]
    CreateAccount --> AutoLogin["Otomatis Auth::login"]
    
    GLogin --> RedirectHome["Masuk ke Dashboard / Halaman Utama Menu"]
    AutoLogin --> RedirectHome
```
</details>

---

### 3. Alur Dashboard Laporan Penjualan & Prediksi Stok Machine Learning
Flowchart ini menjelaskan bagaimana admin mengelola bisnis dan memprediksi kebutuhan stok bahan baku:

![Flowchart Prediksi & Laporan](public/flowchart/flowchart_prediksi_laporan.png)

<details>
<summary><b>Lihat Kode Mermaid</b></summary>

```mermaid
graph TD
    Admin["Admin Login di Filament Panel"] --> Dashboard["Pilih Menu Prediksi Stok"]
    Dashboard --> FormInput["Input Parameter: Hari, Promo, Bulan"]
    FormInput --> MLRequest["Kirim HTTP Request ke FastAPI /predict"]
    MLRequest --> MLExecute["FastAPI Jalankan Model Scikit-Learn"]
    MLExecute --> MLResponse["Kembalikan Hasil Prediksi: Laris / Kurang Laris"]
    MLResponse --> DisplayRec["Tampilkan Status Prediksi & Rekomendasi Restock Bahan"]
    DisplayRec --> Action["Admin Lakukan Top-Up Stok di Kelola Bahan"]

    Admin --> ReportMenu["Pilih Menu Laporan Penjualan"]
    ReportMenu --> FilterDate["Pilih Filter Rentang Tanggal"]
    FilterDate --> ViewMetrics["Tampilkan Total Pendapatan, Transaksi & Item Terjual"]
    ViewMetrics --> ExportPDF["Klik Export PDF Laporan"]
    ExportPDF --> Download["Download File PDF Laporan Penjualan"]
```
</details>

---

## 📝 Lisensi
Proyek ini dibuat untuk keperluan tugas akademik dan pengembangan sistem informasi bisnis Coffee Shop. Open-source di bawah lisensi [MIT License](LICENSE).
