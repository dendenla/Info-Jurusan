# Panduan Implementasi Logo Jurusan

Dokumen ini menjelaskan bagaimana mengimplementasikan fitur logo untuk setiap jurusan di website SMKN 1 Garut.

## 📋 Daftar Perubahan

### 1. **Database Updates**
- ✅ Tambahan kolom `logo` ke tabel `majors`
- File SQL: `update_majors_logo.sql`

### 2. **Admin Panel Updates** 
- ✅ Form untuk upload logo di setiap jurusan (add & edit)
- ✅ File upload handler untuk logo dengan validasi:
  - Format yang didukung: PNG, JPG, GIF, WebP, SVG
  - Ukuran maksimal: 2MB
  - Disimpan di folder: `uploads/majors/`

### 3. **Frontend Updates**
- ✅ Tampilkan logo di halaman jurusan (jurusan.php)
- ✅ Tampilkan logo di preview jurusan di beranda (index.php)  
- ✅ Tampilkan logo di page header detail jurusan (detail.php)
- ✅ Tampilkan logo di sidebar info jurusan (detail.php)

### 4. **Styling Updates**
- ✅ CSS untuk logo badge di card jurusan
- ✅ CSS untuk logo di header
- ✅ CSS untuk logo di sidebar
- ✅ Responsive design untuk semua ukuran layar

## 🚀 Langkah-Langkah Implementasi

### Step 1: Update Database

Jalankan SQL migration script untuk menambahkan kolom logo:

```sql
-- File: update_majors_logo.sql
USE smkn1_garut;
ALTER TABLE majors ADD COLUMN logo VARCHAR(255) DEFAULT NULL AFTER image;
```

**Cara eksekusi:**
- Buka phpMyAdmin
- Pilih database `smkn1_garut`
- Tab "SQL"
- Copy-paste isi file `update_majors_logo.sql`
- Klik "Go"

### Step 2: Verify Upload Folder

Pastikan folder `uploads/majors/` sudah ada dan writable:

```
c:\xampp\htdocs\Info-Jurusan\
└── uploads/
    └── majors/   ← Harus sudah ada atau akan dibuat otomatis
```

Jika belum ada, buat folder secara manual dengan permissions `777`.

### Step 3: Upload Logo Melalui Admin Panel

1. Login ke admin panel
2. Masuk ke menu "Kelola Jurusan"
3. Klik tombol "Tambah Jurusan" atau "Edit" untuk jurusan yang ada
4. Scroll ke bawah dan cari field "Logo Jurusan"
5. Upload file logo (PNG, JPG, GIF, WebP, atau SVG)
6. Klik "Simpan" atau "Tambah Jurusan"

### Step 4: Verify Display

Cek apakah logo sudah tampil di:
- ✅ Halaman Jurusan (`/jurusan.php`) - Logo di kanan atas card
- ✅ Beranda (`/index.php`) - Logo di kanan atas card preview
- ✅ Detail Jurusan (`/detail.php?id=X`) - Logo di header dan sidebar

## 📐 Dimensi dan Spesifikasi Logo

### Rekomendasi Size & Format:

| Aspek | Spesifikasi |
|-------|------------|
| **Ukuran File** | Maksimal 2MB |
| **Format** | PNG, JPG, GIF, WebP, SVG |
| **Tinggi** | 50-100px ideal |
| **Background** | Transparan (PNG) atau White (JPG) |
| **Resolusi** | 72-96 DPI |

### Template Desain:
- **Format**: Square atau slightly rectangular
- **Warna**: Sesuai identitas jurusan
- **Padding**: Minimal 10px dari edge
- **Font**: Simple dan legible di ukuran kecil

## 🎨 Lokasi Display Logo

### 1. Card Jurusan (jurusan.php & index.php)
```
┌─────────────────────┐
│ [IMAGE]       [LOGO]│  ← Badge di kanan atas
│                     │
│ Nama Jurusan        │
│ Deskripsi singkat..│
│ [Detail Lengkap]    │
└─────────────────────┘
```

### 2. Page Header Detail (detail.php)
```
[LOGO] Nama Jurusan Lengkap
```
Logo ditampilkan di sebelah kiri judul dengan filter white.

### 3. Sidebar Info (detail.php)
```
Informasi Jurusan
─────────────────
   [LOGO]      ← Centered di atas info
─────────────────
Durasi Studi: 3 Tahun
...
```

## 💾 File-File Yang Diubah

1. **Database**
   - `update_majors_logo.sql` - Migration script (NEW)

2. **Backend**
   - `admin.php` - Upload handler & form fields
   
3. **Frontend**
   - `jurusan.php` - Logo display di card
   - `index.php` - Logo display di preview
   - `detail.php` - Logo display di header & sidebar
   
4. **Styling**
   - `assets/css/style.css` - Logo CSS classes

## 🐛 Troubleshooting

### Logo Tidak Tampil?

**Kemungkinan 1: Folder tidak ada**
```
✓ Pastikan folder uploads/majors/ sudah ada
✓ Set permissions ke 777
```

**Kemungkinan 2: File corrupt atau format tidak didukung**
```
✓ Gunakan file format: PNG, JPG, GIF, WebP, SVG
✓ Ukuran file harus < 2MB
✓ Test dengan file logo kecil dulu
```

**Kemungkinan 3: Path file di database tidak benar**
```sql
-- Check database
SELECT id, name, logo FROM majors WHERE logo IS NOT NULL;
-- Path harus seperti: uploads/majors/logo_1234567890.png
```

**Kemungkinan 4: File permissions error**
```
✓ Set folder permissions:
  chmod -R 777 uploads/majors/
✓ Atau via FTP: CHMOD 777
```

### Logo Blur/Pixel?

- Gunakan file dengan resolusi lebih tinggi
- Untuk logo kecil, gunakan SVG lebih baik dari raster
- Minimal 100x100px untuk kualitas optimal

### Logo Muncul di Admin tapi Tidak di Frontend?

- Check apakah file ada di `uploads/majors/`
- Verifikasi path di database cocok dengan folder
- Clear browser cache (Ctrl+F5)
- Check browser console untuk error

## 📝 Query Tambahan

### Lihat semua jurusan dengan logo
```sql
SELECT id, name, image, logo FROM majors WHERE logo IS NOT NULL;
```

### Update logo jurusan tertentu
```sql
UPDATE majors SET logo = 'uploads/majors/logo_baru.png' WHERE id = 1;
```

### Hapus logo jurusan
```sql
UPDATE majors SET logo = NULL WHERE id = 1;
```

## 🔒 Security Notes

- ✅ File extension validation
- ✅ File size validation  
- ✅ MIME type checking
- ✅ Timestamp-based filename untuk prevent overwrite
- ✅ File saved outside web root consideration untuk production

## 📱 Responsive Design

Logo display responsif untuk:
- ✅ Desktop (1920px+)
- ✅ Tablet (768px - 1024px)
- ✅ Mobile (< 768px)

## 🎯 Best Practices

1. **Logo Naming**: Gunakan nama deskriptif atau biarkan auto-generate
2. **Backup**: Backup folder uploads secara berkala
3. **Testing**: Test di berbagai browser sebelum go-live
4. **Documentation**: Update dokumentasi ini jika ada perubahan

## 📞 Support

Untuk pertanyaan atau masalah:
1. Check troubleshooting section
2. Review file yang diubah
3. Check browser developer tools (F12)
4. Check server error logs

---

**Dibuat**: April 2026  
**Status**: ✅ Production Ready  
**Version**: 1.0
