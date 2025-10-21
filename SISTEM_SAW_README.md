# Sistem Rekomendasi Formatur IPM Jawa Tengah
## Menggunakan Metode SAW (Simple Additive Weighting)

### 🎯 Deskripsi Sistem
Sistem ini dirancang untuk membantu panitia pemilihan dalam menentukan kandidat formatur terbaik secara objektif dan terukur menggunakan metode SAW berdasarkan 7 kriteria penilaian yang telah ditetapkan.

### 🔧 Fitur Utama
1. **Kelola Kandidat** - CRUD data kandidat formatur
2. **Input Penilaian** - Matriks penilaian kandidat × kriteria
3. **Perhitungan SAW** - Algoritma otomatis dengan normalisasi
4. **Hasil Ranking** - Peringkat kandidat berdasarkan nilai SAW
5. **Detail Perhitungan** - Transparansi proses perhitungan
6. **Dashboard** - Overview sistem dan progress penilaian

### 📊 Kriteria Penilaian & Bobot
| No | Kriteria | Simbol | Bobot | Jenis |
|----|----------|--------|-------|-------|
| 1  | Leadership | C1 | 18% | Benefit |
| 2  | Komunikasi | C2 | 16% | Benefit |
| 3  | Pengalaman Organisasi | C3 | 15% | Benefit |
| 4  | Pengetahuan Organisasi | C4 | 15% | Benefit |
| 5  | Representasi Daerah | C5 | 12% | Benefit |
| 6  | Komitmen Waktu | C6 | 12% | Benefit |
| 7  | Networking (Jaringan) | C7 | 12% | Benefit |

### 🧮 Algoritma SAW
1. **Input Matriks Keputusan (X)** - Nilai mentah dari admin
2. **Normalisasi Matriks (R)** - Rumus: `r_ij = x_ij / max(x_ij)`
3. **Hitung Nilai Preferensi (V)** - Rumus: `V_i = Σ(w_j × r_ij)`
4. **Perangkingan** - Urutkan berdasarkan nilai V_i tertinggi

### 🚀 Cara Menjalankan Sistem

#### 1. Setup Database
```bash
# Jalankan migrasi
php artisan migrate

# Jalankan seeder untuk data kriteria dan admin
php artisan db:seed
```

#### 2. Jalankan Server
```bash
php artisan serve
```

#### 3. Akses Sistem
- URL: http://localhost:8000
- Login Admin:
  - Username: `admin`
  - Password: `admin123`

### 📱 Cara Penggunaan

#### 1. Login Admin
- Akses halaman login
- Masukkan username dan password admin

#### 2. Kelola Kandidat
- Tambah data kandidat (nama, asal daerah, foto, info tambahan)
- Edit atau hapus kandidat yang sudah ada

#### 3. Input Penilaian
- Masuk ke halaman "Input Penilaian"
- Isi matriks penilaian dengan skala 1-5 untuk setiap kriteria
- Simpan penilaian

#### 4. Hitung SAW
- Masuk ke halaman "Hasil SAW"
- Klik "Hitung Ulang" untuk memproses perhitungan SAW
- Lihat ranking kandidat berdasarkan nilai SAW

#### 5. Lihat Detail
- Klik "Detail" pada kandidat untuk melihat perhitungan lengkap
- Lihat nilai normalisasi, bobot, dan kontribusi setiap kriteria

### 🔒 Keamanan
- Authentication admin dengan hash password
- Validasi input nilai (1-5)
- Session management
- CSRF protection

### 📁 Struktur Database
- `admins` - Data administrator
- `kandidats` - Data kandidat formatur
- `kriterias` - Data kriteria penilaian
- `penilaians` - Data penilaian kandidat
- `hasils` - Hasil perhitungan SAW

### 🎨 Teknologi
- **Backend**: Laravel 11
- **Frontend**: Bootstrap 5, Font Awesome
- **Database**: SQLite (default)
- **Authentication**: Laravel Auth

### 📈 Fitur yang Akan Ditambahkan
- [ ] Ekspor laporan PDF
- [ ] Ekspor laporan Excel
- [ ] Backup database
- [ ] Log aktivitas admin

### 🆘 Troubleshooting
1. **Error 500**: Pastikan storage link sudah dibuat (`php artisan storage:link`)
2. **Database Error**: Pastikan migrasi sudah dijalankan
3. **Login Error**: Pastikan seeder admin sudah dijalankan
4. **File Upload Error**: Pastikan folder storage/app/public ada dan writable

### 📞 Support
Untuk pertanyaan atau bantuan teknis, hubungi administrator sistem.

---
**Sistem Rekomendasi Formatur IPM Jawa Tengah v1.0**  
*Dibuat dengan ❤️ untuk IPM Jawa Tengah*
