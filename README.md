# 🏥 Sistem Informasi Obat dan Stok Apotek

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.3+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-5.7+-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

**Sistem Manajemen Apotek Modern Berbasis Web**

[Demo](#-demo) • [Fitur](#-fitur-utama) • [Instalasi](#-instalasi) • [Dokumentasi](#-dokumentasi)

</div>

---

## 📖 Tentang Proyek

Sistem Informasi Obat dan Stok Apotek adalah aplikasi web modern yang dirancang untuk membantu apotek dalam mengelola data obat, monitoring stok, dan menyediakan informasi obat kepada pelanggan secara online. Aplikasi ini dibangun menggunakan framework Laravel dengan antarmuka yang user-friendly dan responsive.

### 🎯 Tujuan

- Memudahkan pengelolaan data obat dan stok apotek
- Menyediakan platform informasi obat untuk masyarakat
- Meningkatkan efisiensi operasional apotek
- Memberikan akses mudah untuk pencarian obat

---

## ✨ Fitur Utama

### 🔐 Sistem Autentikasi

- ✅ Login & Register dengan validasi keamanan
- ✅ Multi-level user access (Admin & User)
- ✅ Session management
- ✅ Password encryption (bcrypt)
- ✅ Logout otomatis untuk keamanan

### 💊 Manajemen Obat

- ✅ **CRUD Lengkap** - Create, Read, Update, Delete data obat
- ✅ **Upload Gambar** - Gambar produk obat dengan preview
- ✅ **Kategori Obat** - Pengelompokan obat berdasarkan jenis
- ✅ **Detail Informasi** - Nama, harga, stok, deskripsi, dan kategori
- ✅ **Pencarian & Filter** - Cari obat berdasarkan nama dan kategori
- ✅ **Status Badge** - Indikator visual untuk status stok:
  - 🟢 **Tersedia** - Stok > 50
  - 🟡 **Stok Rendah** - Stok 10-1
  - 🔴 **Habis** - Stok < 0

### 📦 Manajemen Stok

- ✅ Monitoring stok real-time
- ✅ Alert otomatis untuk stok rendah
- ✅ Update stok otomatis saat transaksi
- ✅ Riwayat perubahan stok
- ✅ Laporan stok periodik

### 🌐 Halaman Publik

- ✅ **Landing Page** - Halaman utama dengan informasi apotek
- ✅ **Katalog Obat** - Dapat diakses tanpa login
- ✅ **Detail Obat** - Informasi lengkap setiap produk
- ✅ **Halaman About** - Profil dan informasi apotek
- ✅ **Halaman Lokasi** - Maps dan kontak apotek
- ✅ **Guest Access** - Pengunjung dapat browsing tanpa login

### 👥 Manajemen User

**Admin:**
- Kelola semua data obat (tambah, edit, hapus)
- Kelola data user
- Akses ke semua fitur sistem
- Monitoring stok dan laporan

**User:**
- Lihat katalog obat
- Cari dan filter obat
- Lihat detail informasi obat
- Update profil sendiri

### 🎨 User Interface

- ✅ **Modern Design** - Tampilan clean dan profesional
- ✅ **Responsive** - Optimal di desktop, tablet, dan mobile
- ✅ **Smooth Animations** - Transisi dan hover effects
- ✅ **Intuitive UX** - Navigasi mudah dan user-friendly
- ✅ **Dynamic Components** - Loading states dan feedback visual
- ✅ **Color-coded System** - Warna konsisten untuk berbagai status

---

## 🛠️ Teknologi

### Backend
- **Framework:** Laravel 12
- **Language:** PHP 8.3+
- **Database:** MySQL 5.7+ / MariaDB
- **Authentication:** Laravel Breeze / Built-in Auth
- **Storage:** Laravel File Storage System

### Frontend
- **Template Engine:** Blade
- **Styling:** Custom CSS3
- **JavaScript:** Vanilla JS (ES6+)
- **Icons:** Emoji & Custom Icons
- **Responsive:** Mobile-First Design

### Tools & Libraries
- **Composer** - PHP Dependency Manager
- **NPM** - Node Package Manager
- **Git** - Version Control

---

## 📋 Persyaratan Sistem

| Komponen | Versi Minimum |
|----------|---------------|
| PHP | 8.3 atau lebih tinggi |
| Composer | 2.x |
| MySQL / MariaDB | 5.7 / 10.3 |
| Node.js | 16.x (optional) |
| NPM | 8.x (optional) |
| Web Server | Apache 2.4+ / Nginx 1.18+ |

### PHP Extensions

Pastikan extension berikut sudah aktif di php.ini:

```ini
- OpenSSL
- PDO
- Mbstring
- Tokenizer
- XML
- Ctype
- JSON
- BCMath
- Fileinfo
- GD (untuk image processing)
```

---

## 🚀 Instalasi

### 1️⃣ Clone Repository

```bash
git clone https://github.com/DGxy24/informasi_obat_dan_stok_apotek.git
cd informasi_obat_dan_stok_apotek
```

### 2️⃣ Install Dependencies

```bash
# Install PHP dependencies via Composer
composer install


### 3️⃣ Environment Setup

```bash
# Copy file environment
cp .env.example .env
# Atau
copy .env.example .env
# Generate application key
php artisan key:generate
```

### 4️⃣ Konfigurasi Database

Edit file `.env` dan sesuaikan dengan konfigurasi database Anda:

```env
APP_NAME="Sistem Informasi Apotek"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=apotek_db
DB_USERNAME=root
DB_PASSWORD=

# Timezone (opsional)
APP_TIMEZONE=Asia/Jakarta
```

### 5️⃣ Setup Database

```bash
# Jalankan migrasi untuk membuat tabel
php artisan migrate

# Jalankan seeder untuk data dummy dan user testing
php artisan db:seed
```

> 💡 **Catatan:** Seeder akan otomatis mengisi database dengan:
> - Data obat dummy untuk testing
> - User admin default
> - 3 user testing dengan role berbeda

### 6️⃣ Storage Link

```bash
# Buat symbolic link untuk storage (untuk upload gambar)
php artisan storage:link
```

### 7️⃣ Set Permissions (Linux/Mac)

```bash
sudo chmod -R 775 storage
sudo chmod -R 775 bootstrap/cache
sudo chown -R www-data:www-data storage
sudo chown -R www-data:www-data bootstrap/cache
```

### 8️⃣ Jalankan Aplikasi

```bash
# Development server
php artisan serve
```

Akses aplikasi di browser: **http://localhost:8000**

---

## 👥 Akun Testing & Default

### 🔑 Akun Administrator (Default)

```
Username: Admin
Password: admin123
Role: Administrator
```

> ⚠️ **PERINGATAN KEAMANAN - SANGAT PENTING!**
>
> 🚨 **WAJIB GANTI PASSWORD ADMIN SETELAH INSTALASI!**
>
> Password default ini **HANYA** untuk keperluan development dan testing. 
> Untuk deployment production atau hosting:
>
> 1. ✅ Login dengan akun admin
> 2. ✅ Masuk ke menu Kelola User
> 3. ✅ Ganti password dengan kombinasi yang kuat:
>    - Minimal 8 karakter
>    - Kombinasi huruf besar & kecil
>    - Contoh: `HaloDunia`
> 4. ✅ Catat password baru di tempat aman
> 5. ✅ Jangan sampai lupa password karena fitur restore password belum ada

>
> **Mengabaikan langkah ini dapat mengakibatkan kerentanan keamanan serius!**

### 👤 Akun User Testing

Seeder menyediakan 3 akun user untuk testing berbagai skenario:

#### User 1 (Regular User)
```
Username: user1
Password: password123
Role: User
```

#### User 2 (Regular User)
```
Username: user2
Password: password123
Role: User
```

#### User 3 (Regular User)
```
Username: user3
Password: password123
Role: User
```

### 💊 Data Dummy Obat

Seeder akan mengisi database dengan **30+ data dummy obat** untuk testing, meliputi:

**Kategori Obat:**
- 💊 **Analgesik** - Pereda nyeri (Paracetamol, Ibuprofen, dll)
- 🦠 **Antibiotik** - Anti infeksi (Amoxicillin, Ciprofloxacin, dll)
- 💪 **Vitamin** - Suplemen (Vitamin C, B Complex, dll)
- 🤒 **Flu & Batuk** - Obat flu (Panadol Flu, OBH, dll)
- 🍽️ **Pencernaan** - Obat maag, diare (Antasida, Diapet, dll)
- ❤️ **Jantung** - Obat kardiovaskular
- 🌡️ **Antipiretik** - Penurun panas

**Variasi Data:**
- ✅ Stok bervariasi (tersedia, rendah, habis)
- ✅ Harga realistis (Rp 5.000 - Rp 150.000)
- ✅ Deskripsi lengkap untuk setiap obat
- ✅ Kategori yang beragam

**Kegunaan Data Dummy:**
- 🔍 Testing fitur pencarian dan filter
- 📋 Testing CRUD operations
- 🎨 Testing tampilan UI/UX
- 📊 Testing monitoring stok
- 🖼️ Testing upload gambar obat
- 📱 Testing responsive design

> 💡 **Tips:** Data dummy dapat dihapus setelah testing dengan cara:
> ```bash
> php artisan migrate:fresh
> # Lalu jalankan seeder manual jika diperlukan
> ```

---

## 📁 Struktur Project

```
informasi_obat_dan_stok_apotek/
├── app/
│   ├── Http/
│   │   ├── Controllers/         # Controller files
│   │   │   ├── Auth/           # Authentication controllers
│   │   │   ├── ObatController.php
│   │   │   ├── UserController.php
│   │   │   └── DashboardController.php
│   │   └── Middleware/         # Custom middleware
│   ├── Models/                 # Eloquent models
│   │   ├── User.php
│   │   ├── Obat.php
│   │   ├── Kategori.php
│   │   └── Apotek.php
│   └── Providers/              # Service providers
├── database/
│   ├── migrations/             # Database migrations
│   │   ├── create_users_table.php
│   │   ├── create_obat_table.php
│   │   └── create_kategori_table.php
│   └── seeders/                # Database seeders
│       ├── DatabaseSeeder.php
│       ├── UserSeeder.php
│       └── ObatSeeder.php
├── public/
│   ├── storage/                # Symlink to storage/app/public
│   ├── css/                    # Custom CSS files
│   └── js/                     # Custom JavaScript files
├── resources/
│   └── views/                  # Blade templates
│       ├── layouts/
│       │   ├── app.blade.php   # Main layout
│       │   └── guest.blade.php # Guest layout
│       ├── auth/               # Authentication views
│       ├── obat/               # Medicine views
│       ├── dashboard/          # Dashboard views
│       └── welcome.blade.php   # Landing page
├── routes/
│   ├── web.php                 # Web routes
│   └── api.php                 # API routes (if any)
├── storage/
│   ├── app/
│   │   └── public/             # Public file storage
│   │       └── obat/           # Medicine images
│   └── logs/                   # Application logs
├── .env.example                # Environment example
├── composer.json               # PHP dependencies
├── package.json               # NPM dependencies
└── README.md                   # This file
```

---

## 🔧 Konfigurasi Lanjutan

### Upload Size Limit

Untuk mengupload gambar obat yang lebih besar, edit `php.ini`:

```ini
upload_max_filesize = 10M
post_max_size = 10M
max_execution_time = 300
memory_limit = 256M
```

Restart web server setelah perubahan.

### Konfigurasi Email (Opsional)

Untuk fitur email (reset password, notifikasi), tambahkan di `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

### Timezone

Set timezone sesuai lokasi di `.env`:

```env
APP_TIMEZONE=Asia/Jakarta
```

---

## 🌐 Deployment ke Production

### Persiapan Server

1. **Pastikan server memenuhi requirements**
2. **Install PHP 8.1+, MySQL, Composer**
3. **Konfigurasi web server (Apache/Nginx)**

### Langkah Deployment

#### 1. Upload Files

```bash
# Upload semua file KECUALI:
# - node_modules/
# - .env (buat baru di server)
# - storage/logs/* (biarkan kosong)
```

#### 2. Set Environment Production

Buat file `.env` baru di server:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

# Database Production
DB_CONNECTION=mysql
DB_HOST=localhost
DB_DATABASE=production_db
DB_USERNAME=production_user
DB_PASSWORD=strong_password_here

# Security
SESSION_SECURE_COOKIE=true
SESSION_SAME_SITE=strict
```

#### 3. Install & Setup

```bash
# Install dependencies (production mode)
composer install --optimize-autoloader --no-dev

# Generate key
php artisan key:generate

# Run migrations
php artisan migrate --force

# Cache optimization
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Storage link
php artisan storage:link
```

#### 4. Set Permissions

```bash
chmod -R 755 storage
chmod -R 755 bootstrap/cache
chown -R www-data:www-data storage
chown -R www-data:www-data bootstrap/cache
```


### 🔒 Checklist Keamanan Production

- [ ] ✅ **Ganti password admin default**
- [ ] ✅ Set `APP_ENV=production`
- [ ] ✅ Set `APP_DEBUG=false`
- [ ] ✅ Gunakan HTTPS (SSL Certificate)
- [ ] ✅ Set strong `APP_KEY`
- [ ] ✅ Hapus atau disable route testing
- [ ] ✅ Backup database secara berkala (daily/weekly)
- [ ] ✅ Setup monitoring & logging
- [ ] ✅ Update dependencies secara berkala
- [ ] ✅ Set firewall rules
- [ ] ✅ Disable directory listing
- [ ] ✅ Setup CSRF protection
- [ ] ✅ Validate semua input user
- [ ] ✅ Gunakan prepared statements (sudah ada di Laravel)

---

## 📖 Dokumentasi Penggunaan

### Untuk Admin

#### Login
1. Buka halaman utama aplikasi
2. Klik tombol "Login" di navbar
3. Masukkan username dan password admin
4. Klik "Masuk Sistem"

#### Kelola Data Obat

**Menambah Obat Baru:**
1. Login sebagai admin
2. Masuk ke menu "Obat"
3. Klik tombol "Tambah Obat Baru"
4. Isi form:
   - Nama Obat
   - Kategori
   - Harga
   - Stok
   - Deskripsi
   - Upload gambar (opsional)
5. Klik "Simpan"

**Edit Data Obat:**
1. Di halaman daftar obat, klik tombol "Edit" pada obat yang ingin diubah
2. Ubah data yang diperlukan
3. Klik "Update"

**Hapus Obat:**
1. Klik tombol "Hapus" pada obat yang ingin dihapus
2. Konfirmasi penghapusan
3. Data akan terhapus permanen

#### Monitoring Stok
1. Masuk ke menu "Obat"
2. Lihat badge warna pada setiap obat:
   - 🟢 Hijau = Stok aman (>50)
   - 🟡 Kuning = Stok rendah (1-50)
   - 🔴 Merah = Hampir habis (<0)
3. Update stok secara berkala

### Untuk User

#### Browse Katalog Obat (Tanpa Login)
1. Buka halaman utama
2. Klik "Lihat Katalog Obat"
3. Browse obat yang tersedia
4. Gunakan pencarian untuk cari obat spesifik
5. Filter berdasarkan kategori

#### Register Akun
1. Klik "Register" di landing page
2. Isi form pendaftaran:
   - Nama Lengkap
   - Email
   - Nomor HP
   - Username
   - Password (min 8 karakter)
   - Konfirmasi Password
3. Klik "Daftar Sekarang"
4. Login dengan akun yang baru dibuat

#### Lihat Detail Obat
1. Klik pada card obat di katalog
2. Lihat informasi lengkap:
   - Nama dan kategori
   - Harga
   - Stok tersedia
   - Deskripsi lengkap
   - Gambar produk

#### Ubah nama Apotek
1. Klik menu pengaturan di dashboard Admin
2. Ubah informasi Apotek sesuai dengan kebutuhan
---

## 🐛 Troubleshooting

### Error: "No application encryption key"

**Solusi:**
```bash
php artisan key:generate
```

### Error: Storage link tidak berfungsi

**Solusi:**
```bash
# Hapus link lama jika ada
rm public/storage

# Buat link baru
php artisan storage:link
```

### Error: Permission denied (Linux)

**Solusi:**
```bash
sudo chmod -R 775 storage
sudo chmod -R 775 bootstrap/cache
sudo chown -R www-data:www-data storage
sudo chown -R www-data:www-data bootstrap/cache
```

### Database Connection Error

**Cek:**
1. Kredensial database di `.env` sudah benar
2. MySQL service sedang berjalan: `sudo service mysql status`
3. Database sudah dibuat
4. User memiliki akses ke database

### Gambar tidak muncul

**Solusi:**
1. Pastikan sudah menjalankan `php artisan storage:link`
2. Cek path gambar di database
3. Cek permissions folder `storage/app/public`
4. Cek file gambar benar-benar ada di storage

### Error 500 Internal Server Error

**Debug:**
1. Set `APP_DEBUG=true` di `.env` (sementara)
2. Cek error di `storage/logs/laravel.log`
3. Clear cache: `php artisan cache:clear`
4. Cek permissions folder storage dan bootstrap/cache

### Seeder gagal

**Solusi:**
```bash
# Reset database dan ulang migrasi
php artisan migrate:fresh

# Jalankan seeder lagi
php artisan db:seed
```

### Upload gambar gagal

**Cek:**
1. Size gambar tidak melebihi limit (default 2MB)
2. Format file didukung (jpg, jpeg, png, gif)
3. Folder storage writable
4. PHP upload_max_filesize cukup besar

---

## 🔄 Maintenance & Update

### Update Dependencies

```bash
# Update Composer packages
composer update

# Update NPM packages
npm update

# Clear & rebuild cache
php artisan optimize:clear
npm run build
```

### Clear Application Cache

```bash
# Clear semua cache
php artisan optimize:clear

# Atau satu per satu:
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Backup Database

**Export (Manual):**
```bash
mysqldump -u username -p database_name > backup_$(date +%Y%m%d).sql
```

**Restore:**
```bash
mysql -u username -p database_name < backup_20240101.sql
```

**Backup Otomatis (Cron Job):**
```bash
# Edit crontab
crontab -e

# Tambahkan line berikut (backup setiap hari jam 2 pagi)
0 2 * * * mysqldump -u username -p'password' database_name > /path/to/backup/db_$(date +\%Y\%m\%d).sql
```

### Monitoring Aplikasi

**Check Logs:**
```bash
# Lihat log terbaru
tail -f storage/logs/laravel.log

# Cari error spesifik
grep "ERROR" storage/logs/laravel.log
```

**Monitor Performance:**
```bash
# Cek query slow
php artisan telescope:install  # Untuk development

# Monitor resource usage
top
htop
```

---

## 🤝 Kontribusi

Kontribusi selalu diterima! Jika Anda ingin berkontribusi:

1. **Fork** repository ini
2. **Buat branch** baru untuk fitur Anda:
   ```bash
   git checkout -b feature/AmazingFeature
   ```
3. **Commit** perubahan Anda:
   ```bash
   git commit -m 'Add some AmazingFeature'
   ```
4. **Push** ke branch:
   ```bash
   git push origin feature/AmazingFeature
   ```
5. **Buat Pull Request** dengan deskripsi lengkap

### Guidelines Kontribusi

- Ikuti coding standards Laravel
- Tulis kode yang clean dan readable
- Tambahkan komentar untuk logic yang complex
- Update dokumentasi jika perlu
- Test fitur sebelum submit PR

---

## 📝 Changelog

### Version 1.0.0 (Initial Release)
- ✅ Sistem autentikasi login & register
- ✅ Multi-level user (Admin & User)
- ✅ CRUD management obat
- ✅ Upload & manage gambar obat
- ✅ Kategori obat
- ✅ Pencarian & filter obat
- ✅ Monitoring stok dengan badge system
- ✅ Landing page & halaman publik
- ✅ Guest access untuk browse katalog
- ✅ Responsive design
- ✅ Database seeder untuk testing
- ✅ Halaman About & Lokasi

---

## 📧 Kontak & Support

- **Developer:** DGxy24
- **Repository:** [github.com/DGxy24/informasi_obat_dan_stok_apotek](https://github.com/DGxy24/informasi_obat_dan_stok_apotek)
- **Issues:** [Report Bug](https://github.com/DGxy24/informasi_obat_dan_stok_apotek/issues)

Jika menemukan bug atau memiliki saran, silakan buat issue di GitHub repository.

---

## 📄 Lisensi

Project ini menggunakan lisensi MIT. Lihat file `LICENSE` untuk informasi lebih lanjut.

```
MIT License

Copyright (c) 2025 DGxy24

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```

---

## 🙏 Acknowledgments

- **Laravel Framework** - The best PHP framework
- **PHP Community** - For amazing resources
- **Contributors** - Everyone who contributed to this project

---

## ⚡ Quick Start Guide

Ingin langsung mulai? Ikuti quick start ini:

```bash
# 1. Clone
git clone https://github.com/DGxy24/informasi_obat_dan_stok_apotek.git
cd informasi_obat_dan_stok_apotek

# 2. Install & Setup
composer install
cp .env.example .env
#or
copy .env.example .env
php artisan key:generate

# 3. Configure Database (edit .env)
# DB_DATABASE=apotek_db

# 4. Migrate & Seed
php artisan migrate
php artisan db:seed

# 5. Storage Link
php artisan storage:link

# 6. Run
php artisan serve

# 7. Login
# Username: Admin
# Password: admin123
```

**Selesai!** 🎉 Aplikasi siap digunakan di `http://localhost:8000`

---

<div align="center">
👨‍💻 Doly Boan Tua Gurning
Dikembangkan menggunakan Laravel Framework

**⚠️ INGAT: Segera ganti password admin setelah instalasi!**



**[⬆ Back to Top](#-sistem-informasi-obat-dan-stok-apotek)**

</div>
