# 📋 Panduan Penggunaan Sistem Rekomendasi Formatur IPM Jawa Tengah

## 🎯 Ringkasan Sistem
Sistem ini menggunakan metode **SAW (Simple Additive Weighting)** untuk menentukan kandidat formatur terbaik berdasarkan 7 kriteria penilaian yang telah ditetapkan dengan bobot yang spesifik.

## 🚀 Cara Menjalankan Sistem

### 1. Persiapan Awal
```bash
# Pastikan sudah di direktori proyek
cd E:\website\reza

# Install dependencies (jika belum)
composer install

# Setup database
php artisan migrate
php artisan db:seed

# Buat storage link untuk upload file
php artisan storage:link

# Generate application key
php artisan key:generate
```

### 2. Menjalankan Server
```bash
php artisan serve
```

### 3. Akses Sistem
- **URL**: http://localhost:8000
- **Login Admin**:
  - Username: `admin`
  - Password: `admin123`

## 📊 Kriteria Penilaian & Bobot

| No | Kriteria | Simbol | Bobot | Jenis | Keterangan |
|----|----------|--------|-------|-------|------------|
| 1  | Leadership | C1 | 18% | Benefit | Kemampuan memimpin dan mengambil keputusan |
| 2  | Komunikasi | C2 | 16% | Benefit | Kemampuan berbicara dan menyampaikan ide |
| 3  | Pengalaman Organisasi | C3 | 15% | Benefit | Lama dan luasnya pengalaman di IPM dan ortom |
| 4  | Pengetahuan Organisasi | C4 | 15% | Benefit | Pemahaman tentang IPM dan Muhammadiyah |
| 5  | Representasi Daerah | C5 | 12% | Benefit | Asal daerah untuk pemerataan wilayah |
| 6  | Komitmen Waktu | C6 | 12% | Benefit | Kesiapan mengabdi selama periode kepemimpinan |
| 7  | Networking (Jaringan) | C7 | 12% | Benefit | Relasi dan konektivitas dengan kader serta eksternal |

**Total Bobot**: 100% ✅

## 🔧 Fitur Sistem

### 1. Dashboard
- **Statistik**: Total kandidat, kriteria, penilaian
- **Progress Penilaian**: Indikator kelengkapan data
- **Hasil SAW Terbaru**: Preview ranking 5 teratas
- **Aksi Cepat**: Shortcut ke fitur utama

### 2. Kelola Kandidat
- **Tambah Kandidat**: Nama, asal daerah, foto, info tambahan
- **Edit Kandidat**: Update data kandidat
- **Hapus Kandidat**: Remove kandidat (dengan konfirmasi)
- **Lihat Detail**: Informasi lengkap kandidat

### 3. Kriteria & Bobot
- **Lihat Kriteria**: Daftar 7 kriteria dengan bobot
- **Visualisasi**: Chart bobot kriteria
- **Informasi**: Penjelasan jenis kriteria (benefit/cost)

### 4. Input Penilaian
- **Matriks Penilaian**: Tabel Kandidat × Kriteria
- **Skala 1-5**: Sangat Rendah sampai Sangat Tinggi
- **Daftar Penilaian**: Lihat, edit, hapus penilaian individual
- **Validasi**: Mencegah duplikasi penilaian

### 5. Hasil SAW
- **Ranking Kandidat**: Urutan berdasarkan nilai SAW
- **Detail Perhitungan**: Normalisasi, bobot, kontribusi
- **Statistik**: Nilai tertinggi, terendah, total kandidat
- **Rekomendasi**: 3 kandidat teratas

## 🧮 Algoritma SAW

### Langkah 1: Input Matriks Keputusan (X)
Admin menginput nilai 1-5 untuk setiap kandidat pada setiap kriteria.

### Langkah 2: Normalisasi Matriks (R)
Karena semua kriteria bersifat **benefit**, rumus normalisasi:
```
r_ij = x_ij / max(x_ij)
```
Dimana:
- `r_ij` = nilai normalisasi kandidat ke-i pada kriteria ke-j
- `x_ij` = nilai asli kandidat ke-i pada kriteria ke-j
- `max(x_ij)` = nilai tertinggi dari semua kandidat pada kriteria ke-j

### Langkah 3: Hitung Nilai Preferensi (V)
```
V_i = Σ(w_j × r_ij)
```
Dimana:
- `V_i` = nilai akhir SAW kandidat ke-i
- `w_j` = bobot kriteria ke-j
- `r_ij` = nilai normalisasi kandidat ke-i pada kriteria ke-j

### Langkah 4: Perangkingan
Kandidat diurutkan berdasarkan nilai `V_i` tertinggi.

## 📱 Cara Penggunaan Step-by-Step

### Step 1: Login Admin
1. Buka http://localhost:8000
2. Masukkan username: `admin`
3. Masukkan password: `admin123`
4. Klik "Login"

### Step 2: Tambah Kandidat
1. Klik menu "Kelola Kandidat"
2. Klik "Tambah Kandidat"
3. Isi form:
   - Nama Kandidat: *wajib*
   - Asal Daerah: *wajib*
   - Foto: *opsional*
   - Info Lain: *opsional*
4. Klik "Simpan Kandidat"

### Step 3: Input Penilaian
1. Klik menu "Input Penilaian"
2. Pilih nilai 1-5 untuk setiap kandidat pada setiap kriteria
3. Klik "Simpan Penilaian"

**Skala Penilaian:**
- 1 = Sangat Rendah
- 2 = Rendah
- 3 = Sedang
- 4 = Tinggi
- 5 = Sangat Tinggi

### Step 4: Hitung SAW
1. Klik menu "Hasil SAW"
2. Klik "Hitung Ulang" untuk memproses perhitungan
3. Lihat ranking kandidat berdasarkan nilai SAW

### Step 5: Lihat Detail
1. Klik "Detail" pada kandidat untuk melihat perhitungan lengkap
2. Lihat nilai normalisasi, bobot, dan kontribusi setiap kriteria

## 🔒 Keamanan & Validasi

### Authentication
- Login admin dengan hash password (bcrypt)
- Session management
- Middleware protection untuk semua route admin

### Validasi Input
- Nilai penilaian: 1-5 (numeric)
- Nama kandidat: required, string, max 255
- Asal daerah: required, string, max 255
- Foto: image, max 2MB, format: jpg, png, gif

### Data Integrity
- Unique constraint pada penilaian (kandidat + kriteria)
- Foreign key constraints
- Cascade delete untuk data terkait

## 📊 Database Schema

### Tabel `admins`
- `id`, `username`, `password`, `nama_lengkap`, `email`
- `remember_token`, `created_at`, `updated_at`

### Tabel `kandidats`
- `id`, `nama_kandidat`, `asal_daerah`, `foto`, `info_lain`
- `created_at`, `updated_at`

### Tabel `kriterias`
- `id`, `nama_kriteria`, `simbol`, `jenis_kriteria`, `bobot`, `keterangan`
- `created_at`, `updated_at`

### Tabel `penilaians`
- `id`, `kandidat_id`, `kriteria_id`, `nilai`
- `created_at`, `updated_at`
- Unique: `kandidat_id` + `kriteria_id`

### Tabel `hasils`
- `id`, `kandidat_id`, `nilai_total_saw`, `ranking`, `detail_perhitungan`
- `created_at`, `updated_at`

## 🛠️ Troubleshooting

### Error 500 - Server Error
```bash
# Cek log error
tail -f storage/logs/laravel.log

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### Database Error
```bash
# Reset database
php artisan migrate:fresh --seed
```

### File Upload Error
```bash
# Pastikan storage link ada
php artisan storage:link

# Cek permission folder storage
chmod -R 775 storage/
```

### Login Error
```bash
# Pastikan seeder admin sudah dijalankan
php artisan db:seed --class=AdminSeeder
```

## 📈 Fitur yang Tersedia

✅ **Sudah Tersedia:**
- Authentication admin
- CRUD kandidat
- Input penilaian (matriks)
- Perhitungan SAW otomatis
- Ranking dan detail perhitungan
- Dashboard dengan statistik
- Responsive design
- Validasi input

🔄 **Dalam Pengembangan:**
- Ekspor laporan PDF
- Ekspor laporan Excel
- Backup database
- Log aktivitas admin

## 📞 Support & Maintenance

### Backup Database
```bash
# Backup SQLite
cp database/database.sqlite backup/database_$(date +%Y%m%d_%H%M%S).sqlite
```

### Update Sistem
```bash
# Pull update
git pull origin main

# Update dependencies
composer update

# Run migration (jika ada)
php artisan migrate
```

### Monitoring
- Cek log: `storage/logs/laravel.log`
- Cek disk space: `df -h`
- Cek memory usage: `free -h`

---

## 🎉 Kesimpulan

Sistem Rekomendasi Formatur IPM Jawa Tengah telah berhasil diimplementasikan dengan fitur lengkap:

1. **Metode SAW** yang akurat dengan 7 kriteria dan bobot yang sudah ditetapkan
2. **Interface yang user-friendly** dengan Bootstrap 5
3. **Keamanan yang baik** dengan authentication dan validasi
4. **Perhitungan otomatis** yang transparan dan dapat diverifikasi
5. **Database yang terstruktur** dengan relasi yang tepat

Sistem siap digunakan untuk membantu panitia pemilihan dalam menentukan kandidat formatur terbaik secara objektif dan terukur.

**Selamat menggunakan sistem! 🚀**
