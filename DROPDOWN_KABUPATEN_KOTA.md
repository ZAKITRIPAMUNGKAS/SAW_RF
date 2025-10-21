# 📍 Dropdown Asal Daerah - Kabupaten/Kota Jawa Tengah

## 🎯 Deskripsi Fitur
Sistem sekarang menggunakan dropdown untuk field "Asal Daerah" dengan daftar lengkap kabupaten/kota di Jawa Tengah dalam format **PD IPM (Nama Kab/Kota)**.

## 📊 Data Kabupaten/Kota yang Tersedia

### 29 Kabupaten:
1. **PD IPM Banjarnegara**
2. **PD IPM Banyumas**
3. **PD IPM Batang**
4. **PD IPM Blora**
5. **PD IPM Boyolali**
6. **PD IPM Brebes**
7. **PD IPM Cilacap**
8. **PD IPM Demak**
9. **PD IPM Grobogan**
10. **PD IPM Jepara**
11. **PD IPM Karanganyar**
12. **PD IPM Kebumen**
13. **PD IPM Kendal**
14. **PD IPM Klaten**
15. **PD IPM Kudus**
16. **PD IPM Magelang**
17. **PD IPM Pati**
18. **PD IPM Pekalongan**
19. **PD IPM Pemalang**
20. **PD IPM Purbalingga**
21. **PD IPM Purworejo**
22. **PD IPM Rembang**
23. **PD IPM Semarang**
24. **PD IPM Sragen**
25. **PD IPM Sukoharjo**
26. **PD IPM Tegal**
27. **PD IPM Temanggung**
28. **PD IPM Wonogiri**
29. **PD IPM Wonosobo**

### 6 Kota:
1. **PD IPM Kota Magelang**
2. **PD IPM Kota Pekalongan**
3. **PD IPM Kota Salatiga**
4. **PD IPM Kota Semarang**
5. **PD IPM Kota Surakarta**
6. **PD IPM Kota Tegal**

**Total: 32 PD IPM di Jawa Tengah**

## 🔧 Implementasi Teknis

### 1. Database Schema
```sql
CREATE TABLE kabupaten_kota (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(255) NOT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### 2. Model KabupatenKota
```php
class KabupatenKota extends Model
{
    protected $fillable = ['nama'];
    protected $table = 'kabupaten_kota';
}
```

### 3. Seeder KabupatenKotaSeeder
- Mengisi data 35 kabupaten/kota Jawa Tengah
- Format: "PD IPM [Nama Kab/Kota]"
- Diurutkan berdasarkan nama

### 4. Controller Update
```php
// KandidatController
public function create()
{
    $kabupatenKota = KabupatenKota::orderBy('nama')->get();
    return view('kandidat.create', compact('kabupatenKota'));
}

public function edit(Kandidat $kandidat)
{
    $kabupatenKota = KabupatenKota::orderBy('nama')->get();
    return view('kandidat.edit', compact('kandidat', 'kabupatenKota'));
}
```

### 5. View Update
```html
<!-- Form Create/Edit Kandidat -->
<select class="form-select" name="asal_daerah" required>
    <option value="">Pilih PD IPM</option>
    @foreach($kabupatenKota as $kab)
        <option value="{{ $kab->nama }}">{{ $kab->nama }}</option>
    @endforeach
</select>
```

## 📱 Cara Penggunaan

### 1. Tambah Kandidat
1. Masuk ke menu "Kelola Kandidat"
2. Klik "Tambah Kandidat"
3. Isi nama kandidat
4. **Pilih asal daerah dari dropdown** (wajib)
5. Upload foto (opsional)
6. Isi info tambahan (opsional)
7. Klik "Simpan Kandidat"

### 2. Edit Kandidat
1. Masuk ke menu "Kelola Kandidat"
2. Klik tombol "Edit" pada kandidat yang ingin diubah
3. **Ubah asal daerah dari dropdown** jika diperlukan
4. Klik "Update Kandidat"

## ✅ Keuntungan Dropdown

### 1. **Konsistensi Data**
- Format nama seragam: "PD IPM [Nama Kab/Kota]"
- Tidak ada typo atau variasi penulisan
- Data terstruktur dan mudah diolah

### 2. **User Experience**
- Mudah digunakan, tinggal pilih dari daftar
- Tidak perlu mengetik manual
- Validasi otomatis

### 3. **Data Integrity**
- Mencegah input yang tidak valid
- Memastikan semua kandidat berasal dari Jawa Tengah
- Format standar untuk laporan

### 4. **Maintenance**
- Mudah menambah/mengurangi kabupaten/kota
- Data terpusat di database
- Update sekali, berlaku di seluruh sistem

## 🔄 Cara Menambah/Mengurangi Data

### Menambah Kabupaten/Kota Baru:
```php
// Edit database/seeders/KabupatenKotaSeeder.php
$kabupatenKota = [
    // ... data existing ...
    'PD IPM [Nama Kab/Kota Baru]',
];

// Jalankan seeder
php artisan db:seed --class=KabupatenKotaSeeder
```

### Menghapus Kabupaten/Kota:
```php
// Hapus dari seeder dan jalankan ulang
// Atau hapus langsung dari database
App\Models\KabupatenKota::where('nama', 'PD IPM [Nama]')->delete();
```

## 📊 Statistik Data

- **Total Kabupaten**: 26
- **Total Kota**: 6
- **Total PD IPM**: 32
- **Format Kabupaten**: PD IPM [Nama Kabupaten]
- **Format Kota**: PD IPM Kota [Nama Kota]
- **Urutan**: Alfabetis berdasarkan nama

## 🎉 Hasil Implementasi

✅ **Dropdown berhasil dibuat** dengan 32 pilihan PD IPM Jawa Tengah  
✅ **Form kandidat** sudah menggunakan dropdown  
✅ **Validasi** memastikan pilihan valid  
✅ **User experience** lebih baik dan konsisten  
✅ **Data integrity** terjaga dengan format standar  

Sistem sekarang siap digunakan dengan dropdown asal daerah yang lengkap dan terstruktur! 🚀
