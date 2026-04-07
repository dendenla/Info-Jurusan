# Panduan Instalasi Lengkap - Website SMKN 1 Garut

## 📖 Daftar Isi
- [Quick Start](#quick-start)
- [Instalasi Detail](#instalasi-detail)
- [Konfigurasi Database](#konfigurasi-database)
- [Test & Verifikasi](#test--verifikasi)
- [Tips Troubleshooting](#tips-troubleshooting)

---

## ⚡ Quick Start (5 Menit)

### Untuk yang sudah punya XAMPP:

1. **Copy Project**
   ```bash
   C:\xampp\htdocs\Info jurusan
   ```

2. **Import Database**
   - Buka: http://localhost/phpmyadmin
   - Tools → Import → Pilih `database.sql`

3. **Jalankan Website**
   - Akses: http://localhost/Info%20jurusan/

**Done!** ✅

---

## 📥 Instalasi Detail

### Prerequisite: Install XAMPP

**Langkah 1: Download XAMPP**

1. Buka https://www.apachefriends.org/
2. Klik tombol "Download" (pilih PHP 7.4 atau 8.x)
3. Tunggu download selesai (~200MB)

**Langkah 2: Install XAMPP**

Windows:
1. Double-click `xampp-windows-x64-installer.exe`
2. Pilih folder instalasi: `C:\xampp`
3. Uncheck "Learn more about BitnityPHP"
4. Klik "Next" hingga selesai
5. Klik "Finish"

macOS/Linux:
- Ikuti installer interaktif

**Langkah 3: Start XAMPP Services**

1. Buka XAMPP Control Panel
2. Klik tombol **Start** di Apache
3. Klik tombol **Start** di MySQL
4. Status berubah menjadi hijau ✅

```
Apache    [Start] ← Hijau
MySQL     [Start] ← Hijau
```

**Langkah 4: Verify XAMPP**

Buka browser, akses: http://localhost

Jika berhasil: "Welcome to XAMPP for Windows ..." akan tampil

---

## 📦 Setup Project

### Step 1: Copy Project Files

```
Source: Download folder / Email attachment / USB
Target: C:\xampp\htdocs\Info jurusan
```

**Struktur yang benar:**
```
C:\xampp\htdocs\
├── Info jurusan/           ← Project utama
│   ├── index.php
│   ├── config/
│   ├── assets/
│   ├── includes/
│   └── database.sql
└── ... (folder lain XAMPP)
```

### Step 2: Verify Project Files

Pastikan folder berisi:
- ✅ `index.php`
- ✅ `config/` (database.php)
- ✅ `assets/` (css, js, images)
- ✅ `database.sql`

Jika ada yang kurang, lihat file dari sumber lagi.

---

## 🗄️ Konfigurasi Database

### Method 1: phpMyAdmin (Recommended - Gampang)

**Langkah 1: Buka phpMyAdmin**

1. Di browser: http://localhost/phpmyadmin
2. Login screen muncul (jika diminta):
   - Username: `root`
   - Password: kosong (tinggal klik login)

**Langkah 2: Import Database**

1. Top menu → Click "Import"
2. Bagian "File to import":
   - Click "Browse" / "Choose File"
   - Cari file: `database.sql` (di folder project)
   - Click "Open"
3. Scroll ke bawah, click tombol **"Import"** (warna biru)
4. Tunggu... loading (hijau bar di atas)
5. Success message: "Import has been successful..." ✅

**Langkah 3: Verifikasi**

1. Di sidebar kiri, cari: `smkn1_garut` database
2. Click `smkn1_garut`
3. Keluar tabel-tabel:
   - ✅ majors
   - ✅ messages
   - ✅ posts
   - ✅ users

Jika keempat tabel ada = **Database berhasil!** ✅

---

### Method 2: Command Line (Untuk Advanced Users)

```bash
# Buka Command Prompt / Terminal
cd C:\xampp\mysql\bin

# Login MySQL
mysql -u root -p

# Kalo diminta password, tekan Enter aja

# Di MySQL prompt:
CREATE DATABASE smkn1_garut;
USE smkn1_garut;
source C:/xampp/htdocs/Info\ jurusan/database.sql;
EXIT;
```

---

## 🌐 Jalankan Website

### Method 1: Langsung di Browser

1. Buka browser
2. Akses: **http://localhost/Info%20jurusan/**
3. Halaman beranda SMKN 1 Garut akan tampil! 🎉

### Method 2: Dari File Explorer

1. Buka File Explorer
2. Navigasi ke: `C:\xampp\htdocs\Info jurusan`
3. Double-click `index.php`
4. Browser otomatis buka

### OK, Website Sudah Berjalan! ✅

---

## ✅ Test & Verifikasi

### Test 1: Halaman Utama

**Buka**: http://localhost/Info%20jurusan/

✅ Checks:
- [ ] Logo "SMKN 1 Garut" tampil di navbar
- [ ] Hero section dengan gambar
- [ ] Statistik sekolah (4 card)
- [ ] Preview 6 jurusan
- [ ] Testimoni siswa

**Status**: ✅ OK

---

### Test 2: Halaman Jurusan

**Buka**: http://localhost/Info%20jurusan/jurusan.php

✅ Checks:
- [ ] Semua jurusan dalam card
- [ ] Search box berfungsi (coba ketik "RPL")
- [ ] Card tersembunyiSetelah search
- [ ] Tombol "Detail Lengkap" bersifat link

**Status**: ✅ OK

---

### Test 3: Detail Jurusan

**Buka**: http://localhost/Info%20jurusan/detail.php?id=1

✅ Checks:
- [ ] Informasi jurusan tampil lengkap
- [ ] Sidebar dengan info course
- [ ] Gambar jurusan muncul
- [ ] Tombol "Hubungi Kami" & "Lokasi"
- [ ] Jurusan lain di bawah

**Status**: ✅ OK

---

### Test 4: Forum Diskusi

**Buka**: http://localhost/Info%20jurusan/forum.php

✅ Checks:
- [ ] Form input (Nama + Pesan)
- [ ] Input pesan, klik "Kirim"
- [ ] Pesan tampil di bawah
- [ ] Like button berfungsi (counter increment)
- [ ] Hapus pesan berfungsi

**Status**: ✅ OK

---

### Test 5: Kontak

**Buka**: http://localhost/Info%20jurusan/kontak.php

✅ Checks:
- [ ] Form: Nama, Email, Pesan
- [ ] Isi form, klik "Kirim Pesan"
- [ ] Alert sukses tampil
- [ ] Info kontak di sidebar

**Status**: ✅ OK

---

## 🔧 Konfigurasi Database Manual

### Jika default config tidak cocok:

Edit file: `config/database.php`

```php
<?php
$db_host = "localhost";    // Ganti jika perlu
$db_user = "root";         // Ganti username MySQL
$db_pass = "";             // Ganti password MySQL
$db_name = "smkn1_garut";  // Ganti nama database
```

**Contoh jika MySQL punya password "123456":**
```php
$db_pass = "123456";  // ← Ubah ke password Anda
```

Save file (Ctrl+S), maka website langsung ter-update.

---

## 📱 Test Responsive Design

### User yang mengakses dari berbagai device:

**Mobile (Smartphone)**
- F12 (buka DevTools)
- Icon "Toggle device toolbar"
- Refresh page
- Cek tampilan responsif

**Tablet**
- Resize browser ke 768px
- Cek layout

**Desktop**
- Full screen browser
- Cek layout penuh

---

## 🐛 Tips Troubleshooting

### Error 1: "Koneksi gagal: Access denied for user 'root'@'localhost'"

**Penyebab**: Database connection error

**Solusi**:
1. Pastikan MySQL sudah running (XAMPP Control Panel)
2. Check username/password di `config/database.php`
3. Verify database sudah diimport

```php
// Pastikan ini benar
$db_host = "localhost";
$db_user = "root";
$db_pass = "";  // Kosong kalau default
$db_name = "smkn1_garut";
```

---

### Error 2: "No database selected"

**Penyebab**: Database belum diimport

**Solusi**:
1. Buka phpMyAdmin: http://localhost/phpmyadmin
2. Import file `database.sql` sesuai Step di atas
3. Verify tabel sudah ada

---

### Error 3: Blank Page Putih

**Penyebab**: PHP error atau fatal error

**Solusi**:
1. Tekan F12 (buka DevTools)
2. Tab "Console" → Lihat error
3. Atau:
   - Edit `config/database.php`
   - Tambah di bawah `<?php`:
     ```php
     error_reporting(E_ALL);
     ini_set('display_errors', 1);
     ```
   - Refresh page, lihat error message

---

### Error 4: Gambar Placeholder Tidak Loading

**Penyebab**: URL placeholder timeout

**Solusi**:
- Ignore, placeholder dari URL eksternal
- Atau download gambar lokal, upload ke `assets/images/`

---

### Error 5: Forum Post Tidak Muncul

**Penyebab**: AJAX error atau database issue

**Solusi**:
1. F12 → Console → Lihat error
2. Verifikasi tabel `posts` ada di database
3. Cek network tab untuk error API

---

## 🚀 Next Steps

### Setelah semua berjalan:

1. **Customize Content**
   - Edit deskripsi jurusan di phpMyAdmin
   - Update nomor kontak dll

2. **Upload Real Images**
   - Ganti placeholder gambar
   - Upload ke `assets/images/`

3. **Deploy ke Internet** (Optional)
   - Host di Hostinger, IDCloudHost, etc
   - Upload files via FTP
   - Setup SSL certificate

4. **Backup Regular**
   - Export database weekly
   - Save file backup di folder terpisah

---

## 📞 Kontak Support

Jika ada masalah:

1. **Check README.md** - Dokumentasi lengkap
2. **Check Troubleshooting** di atas
3. **Google Chrome F12** - Lihat console error
4. **phpMyAdmin** - Verifikasi database

---

## ✨ Selamat!

**Website SMKN 1 Garut Anda sudah online!** 🎉

Nikmati dan jangan lupa backup database secara berkala.

**Happy Coding!** 🚀

---

**Created**: April 7, 2024
**Version**: 1.0
