# 🏆 Sistem Rekomendasi Formatur IPM Jawa Tengah

<div align="center">

![IPM Logo](public/Logo_IPM.png)

**Sistem SAW (Simple Additive Weighting) untuk Seleksi Formatur IPM Jawa Tengah**

[![Laravel](https://img.shields.io/badge/Laravel-11.x-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.1+-blue.svg)](https://php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-4.x-38B2AC.svg)](https://tailwindcss.com)
[![Alpine.js](https://img.shields.io/badge/Alpine.js-3.x-8BC0D0.svg)](https://alpinejs.dev)
[![License](https://img.shields.io/badge/License-Proprietary-yellow.svg)](#copyright)

</div>

---

## 🚀 **Tentang Sistem**

Sistem Rekomendasi Formatur IPM Jawa Tengah adalah aplikasi web yang menggunakan metode **SAW (Simple Additive Weighting)** untuk membantu dalam proses seleksi formatur. Sistem ini dirancang khusus untuk Ikatan Pelajar Muhammadiyah Jawa Tengah dengan antarmuka yang modern, responsif, dan user-friendly.

### ✨ **Fitur Utama**

- 🎯 **Metode SAW**: Implementasi algoritma Simple Additive Weighting
- 👥 **Manajemen Kandidat**: Kelola data kandidat formatur
- 📊 **Kriteria & Bobot**: Pengaturan kriteria penilaian yang fleksibel
- ⭐ **Input Penilaian**: Interface yang intuitif untuk penilaian
- 🏆 **Hasil Ranking**: Peringkat kandidat berdasarkan nilai SAW
- 📱 **Responsive Design**: Optimal di desktop, tablet, dan mobile
- 🎨 **Modern UI**: Desain yang clean dan profesional

---

## 🛠️ **Teknologi yang Digunakan**

### **Backend**
- **Laravel 11.x** - PHP Framework
- **MySQL/SQLite** - Database
- **Eloquent ORM** - Database Management
- **Laravel Authentication** - Sistem Login

### **Frontend**
- **Tailwind CSS 4.x** - Utility-first CSS Framework
- **Alpine.js 3.x** - Lightweight JavaScript Framework
- **Font Awesome 6.x** - Icon Library
- **Google Fonts (Inter)** - Typography

### **Development Tools**
- **Vite** - Build Tool
- **Laravel Vite Plugin** - Asset Bundling
- **Composer** - PHP Dependency Manager
- **NPM** - Node Package Manager

---

## 📋 **Persyaratan Sistem**

### **Server Requirements**
- PHP >= 8.1
- Composer
- Node.js >= 18.x
- NPM >= 9.x
- MySQL 5.7+ atau SQLite 3.x
- Web Server (Apache/Nginx)

### **PHP Extensions**
- BCMath
- Ctype
- cURL
- DOM
- Fileinfo
- JSON
- Mbstring
- OpenSSL
- PDO
- Tokenizer
- XML

---

## 🚀 **Instalasi & Setup**

### **1. Clone Repository**
```bash
git clone https://github.com/tepe-dev/sistem-formatur-ipm.git
cd sistem-formatur-ipm
```

### **2. Install Dependencies**
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### **3. Environment Setup**
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### **4. Database Configuration**
```bash
# Edit .env file untuk database configuration
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite

# Atau untuk MySQL
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=formatur_ipm
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### **5. Database Migration & Seeding**
```bash
# Run migrations
php artisan migrate

# Seed database dengan data awal
php artisan db:seed
```

### **6. Build Assets**
```bash
# Development
npm run dev

# Production
npm run build
```

### **7. Start Server**
```bash
# Development server
php artisan serve

# Aplikasi akan berjalan di http://localhost:8000
```

---

## 👤 **Default Login**

```
Email: admin@ipmjateng.com
Password: admin123
```

> ⚠️ **Penting**: Ganti password default setelah login pertama!

---

## 📱 **Screenshots**

### **Dashboard**
![Dashboard](https://via.placeholder.com/800x400/009245/FFFFFF?text=Dashboard+IPM)

### **Input Penilaian**
![Penilaian](https://via.placeholder.com/800x400/FDCB0A/000000?text=Input+Penilaian)

### **Hasil SAW**
![Hasil](https://via.placeholder.com/800x400/E30613/FFFFFF?text=Hasil+SAW)

---

## 🎯 **Cara Penggunaan**

### **1. Login Admin**
- Akses aplikasi melalui browser
- Login menggunakan kredensial admin
- Dashboard akan menampilkan statistik sistem

### **2. Kelola Kandidat**
- Tambah data kandidat formatur
- Upload foto kandidat (opsional)
- Isi informasi tambahan

### **3. Atur Kriteria**
- Definisikan kriteria penilaian
- Set bobot untuk setiap kriteria
- Pastikan total bobot = 100%

### **4. Input Penilaian**
- Berikan nilai 1-5 untuk setiap kandidat
- Sistem akan menampilkan progress penilaian
- Simpan penilaian secara real-time

### **5. Lihat Hasil**
- Sistem akan menghitung ranking otomatis
- Tampilkan peringkat kandidat
- Export hasil (fitur coming soon)

---

## 🏗️ **Struktur Database**

### **Tables**
- `admins` - Data administrator
- `kandidats` - Data kandidat formatur
- `kriterias` - Kriteria penilaian
- `penilaians` - Data penilaian
- `hasils` - Hasil perhitungan SAW
- `kabupaten_kota` - Data wilayah

### **Relationships**
- Kandidat → Penilaian (One to Many)
- Kriteria → Penilaian (One to Many)
- Kandidat → Hasil (One to One)

---

## 🎨 **Customization**

### **Warna Brand IPM**
```css
:root {
    --ipm-green: #009245;
    --ipm-yellow: #FDCB0A;
    --ipm-red: #E30613;
}
```

### **Layout Components**
- Sidebar dengan toggle functionality
- Responsive grid system
- Modern card components
- Interactive buttons

---

## 🔧 **Development**

### **Local Development**
```bash
# Start development server
php artisan serve

# Watch for changes
npm run dev

# Run tests
php artisan test
```

### **Production Deployment**
```bash
# Build assets
npm run build

# Optimize Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 📊 **Performance**

- ⚡ **Fast Loading**: Optimized assets dan caching
- 📱 **Mobile First**: Responsive design untuk semua device
- 🎯 **SEO Ready**: Meta tags dan structured data
- 🔒 **Secure**: Laravel security best practices

---

## 🤝 **Contributing**

Kontribusi untuk proyek ini hanya diperbolehkan untuk tim pengembang yang telah diizinkan.

### **Development Team**
- **Lead Developer**: [Nama Developer]
- **UI/UX Designer**: [Nama Designer]
- **Backend Developer**: [Nama Backend Dev]
- **Frontend Developer**: [Nama Frontend Dev]

---

## 📞 **Support**

Untuk bantuan teknis atau pertanyaan, silakan hubungi:

- **Email**: support@tepe-dev.com
- **Website**: https://tepe-dev.com
- **Documentation**: [Link Documentation]

---

## 📄 **Copyright & License**

<div align="center">

### © 2024 **TEPE-DEV** - All Rights Reserved

**Sistem Rekomendasi Formatur IPM Jawa Tengah**

---

### ⚖️ **Lisensi Proprietary**

**PENGGUNAAN HANYA UNTUK YANG DIIZINKAN**

Aplikasi ini adalah properti intelektual **TEPE-DEV** dan dilindungi oleh hukum hak cipta. Penggunaan, distribusi, atau modifikasi aplikasi ini hanya diperbolehkan untuk pihak-pihak yang telah mendapatkan izin tertulis dari **TEPE-DEV**.

### 🚫 **Larangan**
- ❌ Distribusi tanpa izin
- ❌ Modifikasi kode sumber
- ❌ Reverse engineering
- ❌ Penggunaan komersial tanpa lisensi
- ❌ Penghapusan copyright notice

### ✅ **Yang Diizinkan**
- ✅ Penggunaan sesuai tujuan yang telah disepakati
- ✅ Backup untuk keperluan maintenance
- ✅ Customization dengan izin tertulis
- ✅ Reporting bugs dan feedback

### 📋 **Terms of Use**
Dengan menggunakan aplikasi ini, Anda menyetujui untuk:
1. Tidak melakukan reverse engineering
2. Tidak mendistribusikan ke pihak ketiga
3. Menghormati hak kekayaan intelektual
4. Menggunakan sesuai dengan perjanjian yang telah disepakati

### 🔒 **Confidentiality**
Semua informasi dalam aplikasi ini bersifat rahasia dan tidak boleh dibagikan kepada pihak yang tidak berwenang.

---

**Untuk informasi lisensi lebih lanjut, hubungi: legal@tepe-dev.com**

</div>

---

<div align="center">

**Dibuat dengan ❤️ oleh TEPE-DEV untuk IPM Jawa Tengah**

[![TEPE-DEV](https://img.shields.io/badge/TEPE--DEV-2024-blue.svg)](https://tepe-dev.com)

</div>