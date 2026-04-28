# 🚀 QUICK START - Menambahkan Logo Jurusan

## ⚡ 3 Langkah Cepat

### Langkah 1: Update Database (1 menit)
1. Buka phpMyAdmin → Database `smkn1_garut`
2. Klik tab **SQL**
3. Copy-paste dari file `update_majors_logo.sql`:
```sql
ALTER TABLE majors ADD COLUMN logo VARCHAR(255) DEFAULT NULL AFTER image;
```
4. Klik **Go**

✅ **Selesai!** Kolom logo sudah ditambah.

### Langkah 2: Upload Logo (2 menit per jurusan)
1. Login ke **Admin Panel** → http://localhost/Info-Jurusan/admin.php
2. Klik menu **"Kelola Jurusan"**
3. Klik tombol **"Tambah Jurusan"** atau **"Edit"** jurusan
4. Scroll ke bawah → **"Logo Jurusan"** field
5. Upload file PNG/JPG/SVG (max 2MB)
6. Klik **"Simpan"**

✅ **Selesai!** Logo sudah tersimpan.

### Langkah 3: Verifikasi (1 menit)
Buka browser dan cek:
- **Halaman Jurusan**: http://localhost/Info-Jurusan/jurusan.php
  - Logo harus tampil di **kanan atas card**
- **Beranda**: http://localhost/Info-Jurusan/index.php
  - Logo harus tampil di **preview card**
- **Detail Jurusan**: http://localhost/Info-Jurusan/detail.php?id=1
  - Logo di **header** (samping judul)
  - Logo di **sidebar info**

✅ **Selesai!** Logo feature sudah aktif!

---

## 📊 Status Implementasi

| Komponen | Status | File |
|----------|--------|------|
| Database Migration | ✅ | `update_majors_logo.sql` |
| Admin Form | ✅ | `admin.php` |
| Jurusan Page | ✅ | `jurusan.php` |
| Beranda | ✅ | `index.php` |
| Detail Page | ✅ | `detail.php` |
| CSS Styling | ✅ | `assets/css/style.css` |

---

## 🎨 Tips Desain Logo

✓ **Format**: PNG (transparan) atau SVG  
✓ **Ukuran**: 50-100px tinggi ideal  
✓ **Style**: Simple dan legible di ukuran kecil  
✓ **Warna**: Sesuai identitas jurusan  

**Contoh Ukuran**:
- RPL: Logo dengan server/monitor icon
- TKJ: Logo dengan network icon  
- Lainnya: Sesuai keahlian jurusan

---

## ⚠️ Jika Ada Masalah

| Masalah | Solusi |
|---------|--------|
| Logo tidak tampil | Clear cache (Ctrl+F5), check folder `uploads/majors/` |
| Upload error | File size max 2MB, format PNG/JPG/GIF/WebP/SVG |
| Blur/Pixel | Gunakan file resolusi lebih tinggi atau SVG |
| Folder permission | Set folder `uploads/majors/` chmod 777 |

---

## 📚 Dokumentasi Lengkap

Untuk detail lebih lanjut: Buka file `LOGO_IMPLEMENTATION_GUIDE.md`

---

**Waktu Setup Total**: ~5 menit  
**Kesulitan**: ⭐ Sangat Mudah  
**Status**: ✅ Production Ready
