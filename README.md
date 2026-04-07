# Website SMKN 1 Garut - Dokumentasi

## 📋 Daftar Isi
1. [Gambaran Umum](#gambaran-umum)
2. [Persyaratan Sistem](#persyaratan-sistem)
3. [Instalasi](#instalasi)
4. [Konfigurasi](#konfigurasi)
5. [Struktur Folder](#struktur-folder)
6. [Fitur Utama](#fitur-utama)
7. [Penggunaan](#penggunaan)
8. [Troubleshooting](#troubleshooting)

---

## 🎯 Gambaran Umum

Website SMKN 1 Garut adalah platform informasi sekolah modern yang dirancang untuk memberikan informasi lengkap tentang jurusan dan menjadi wadah komunitas diskusi ringan bagi siswa dan calon siswa.

### Fitur Utama:
- ✅ Beranda dengan hero section dan statistik sekolah
- ✅ Halaman jurusan dengan search dan filter
- ✅ Detail jurusan dengan informasi lengkap
- ✅ Forum diskusi tanpa login
- ✅ Halaman kontak dan lokasi
- ✅ Dark mode toggle
- ✅ Responsive design (mobile, tablet, desktop)
- ✅ Scroll to top button
- ✅ Toast notifications

---

## 💻 Persyaratan Sistem

- **PHP**: 7.4 atau lebih tinggi
- **MySQL**: 5.7 atau lebih tinggi
- **Web Server**: Apache (XAMPP recommended)
- **Browser**: Chrome, Firefox, Safari, Edge (modern)

### Software yang Diperlukan:
1. **XAMPP** - Apache, MySQL, PHP Bundle
   - Download dari: https://www.apachefriends.org/
   
2. **Text Editor** - VS Code atau Sublime Text (optional)

---

## 🚀 Instalasi

### Langkah 1: Setup XAMPP

1. **Unduh dan Install XAMPP**
   - Download dari [apachefriends.org](https://www.apachefriends.org/)
   - Ikuti proses instalasi
   - Default lokasi: `C:\xampp` (Windows)

2. **Buka XAMPP Control Panel**
   - Pilih bahasa (Inggris/German)
   - Klik "Start" untuk Apache dan MySQL

### Langkah 2: Copy Project

1. Copy folder project "Info jurusan" ke:
   ```
   C:\xampp\htdocs\Info jurusan
   ```

2. Pastikan struktur folder sesuai dengan `tree struktur` di bawah

### Langkah 3: Setup Database

1. **Buka phpMyAdmin**
   - Buka browser dan akses: http://localhost/phpmyadmin
   - Username: `root`
   - Password: kosong (default)

2. **Import Database**
   - Top menu → Tools → Import
   - Pilih file: `database.sql`
   - Klik "Go"
   - Database berhasil dibuat!

3. **Verifikasi Database**
   - Di sidebar, klik `smkn1_garut`
   - Pastikan ada tabel: users, majors, posts, messages

### Langkah 4: Jalankan Website

1. **Buka Browser**
   - Akses: http://localhost/Info%20jurusan/

2. **Homepage Seharusnya Tampil**
   - Jika error, check **Troubleshooting** di bawah

---

## ⚙️ Konfigurasi

### Config Database (`config/database.php`)

Ubah jika database Anda berbeda:

```php
$db_host = "localhost";  // Host database
$db_user = "root";       // Username MySQL
$db_pass = "";           // Password MySQL
$db_name = "smkn1_garut"; // Nama database
```

### PHP.ini Settings (Opsional)

Buka `C:\xampp\php\php.ini`:

```ini
; Recommended settings
max_execution_time = 30
max_input_vars = 5000
memory_limit = 256M
upload_max_filesize = 64M
post_max_size = 64M
```

---

## 📁 Struktur Folder

```
Info jurusan/
├── index.php                 # Halaman beranda
├── jurusan.php              # Daftar semua jurusan
├── detail.php               # Detail jurusan (detail.php?id=1)
├── forum.php                # Forum diskusi
├── kontak.php               # Form kontak
├── lokasi.php               # Peta & lokasi sekolah
├── database.sql             # SQL database dump
├── README.md                # Dokumentasi ini
│
├── config/
│   └── database.php         # Konfigurasi database
│
├── includes/
│   ├── header.php           # Header & navbar
│   └── footer.php           # Footer
│
├── api/
│   ├── add_post.php         # API: Tambah post forum
│   ├── get_posts.php        # API: Ambil semua post
│   ├── like_post.php        # API: Like post
│   └── delete_post.php      # API: Hapus post
│
├── assets/
│   ├── css/
│   │   └── style.css        # Custom CSS
│   ├── js/
│   │   └── main.js          # Custom JavaScript
│   └── images/              # Folder images (opsional)
│
└── data/
    └── (folder untuk data sample)
```

---

## ✨ Fitur Utama

### 1. 🏠 Beranda (index.php)
- Hero section dengan CTA buttons
- Statistik sekolah (4 card)
- Preview 6 jurusan terbaru
- Testimoni siswa

**URL**: http://localhost/Info%20jurusan/

### 2. 📚 Halaman Jurusan (jurusan.php)
- Daftar semua jurusan dalam card
- **Search real-time** - cari jurusan tanpa refresh
- Tampil nama, deskripsi, gambar
- Tombol "Selengkapnya" ke detail

**URL**: http://localhost/Info%20jurusan/jurusan.php

**Fitur Search**:
```javascript
// Search otomatis saat user mengetik
- Case insensitive
- Real-time filtering
- Show/hide no results message
```

### 3. 📖 Detail Jurusan (detail.php)
- Informasi lengkap jurusan
- Materi pembelajaran
- Prospek kerja
- Sidebar informasi (durasi, akreditasi, kapasitas)
- Tombol hubungi & lokasi
- Jurusan lainnya yang terkait

**URL**: http://localhost/Info%20jurusan/detail.php?id=1

### 4. 💬 Forum Diskusi (forum.php)
- Pengunjung bisa menulis pesan tanpa login
- Input: Nama + Pesan (max 500 char)
- Fitur:
  - ✅ **Like Postingan** - counter like otomatis increment
  - ✅ **Hapus Pesan** - dengan konfirmasi
  - ✅ **Auto Refresh (AJAX)** - muatan tanpa reload page
  - ✅ **Toast Notification** - feedback action

**URL**: http://localhost/Info%20jurusan/forum.php

**API Endpoints**:
- POST `/api/add_post.php` - Tambah post
- GET `/api/get_posts.php` - Ambil semua post
- POST `/api/like_post.php` - Like post
- POST `/api/delete_post.php` - Hapus post

### 5. 📞 Kontak (kontak.php)
- Form: Nama, Email, Pesan
- Validasi input (email format, panjang)
- Data disimpan di database `messages`
- Alert sukses/error
- Info kontak sekolah di sidebar

**URL**: http://localhost/Info%20jurusan/kontak.php

### 6. 📍 Lokasi (lokasi.php)
- Google Maps embed
- Alamat lengkap
- Petunjuk arah (dari Bandara, Terminal)
- Jam operasional
- Fasilitas & transportasi

**URL**: http://localhost/Info%20jurusan/lokasi.php

---

## 🎨 Fitur UI/UX

### Dark Mode
- Toggle di navbar (ikon bulan/matahari)
- Preference disimpan di localStorage
- Otomatis load saat page refresh

### Responsive Design
- Mobile: < 768px
- Tablet: 768px - 1024px
- Desktop: > 1024px

### Animasi
- Fade-in cards saat scroll
- Hover effect pada card
- Smooth scrolling
- Slide up animation untuk search results

### Toast Notifications
```javascript
showToast('Pesan berhasil dikirim!', 'success');
// Types: success, danger, warning, info
```

---

## 🔐 Keamanan

### Implemented Security:
1. **Input Validation**
   - Max length check
   - Email validation (Kontak)
   - htmlspecialchars() untuk output

2. **SQL Injection Prevention**
   - mysqli_real_escape_string()
   - Prepared statements (opsional)

3. **XSS Prevention**
   - htmlspecialchars() pada output
   - Escape HTML entities

### Best Practices:
- Jangan expose database credentials
- Gunakan HTTPS di production
- Regular backups database
- Update PHP ke versi terbaru

---

## 📝 Penggunaan

### Menambah Jurusan Baru

Di phpMyAdmin:
1. Buka tabel `majors`
2. Klik "Insert"
3. Isi field:
   - name: Nama jurusan
   - description: Deskripsi singkat
   - content: Isi lengkap
   - image: URL gambar

### Edit Data Jurusan

```sql
UPDATE majors 
SET name = 'Nama Baru', description = 'Deskripsi Baru'
WHERE id = 1;
```

### Backup Database

```bash
# Command line MySQL
mysqldump -u root -p smkn1_garut > backup.sql

# Di phpMyAdmin
Database → Export
```

### Restore Database

```bash
mysql -u root -p smkn1_garut < backup.sql

# Di phpMyAdmin
Database → Import → Pilih file .sql
```

---

## 🐛 Troubleshooting

### Error: "Koneksi gagal: Access denied for user 'root'@'localhost'"

**Solusi:**
- Pastikan MySQL sudah running (XAMPP)
- Check username/password di `config/database.php`
- Default: username=root, password=kosong

```php
// Edit config/database.php
$db_user = "root";
$db_pass = ""; // Biarkan kosong jika default
```

### Error: "No database selected"

**Solusi:**
- Database belum diimport
- Import file `database.sql` di phpMyAdmin

### Error 404 - Halaman Tidak Ditemukan

**Solusi:**
- Check URL path: http://localhost/Info%20jurusan/
- Pastikan file ada di C:\xampp\htdocs\Info jurusan\

### Gambar Tidak Tampil

**Solusi:**
- Placeholder dari URL eksternal, jika tidak bisa muat:
- Download gambar lokal, letakkan di `assets/images/`
- Update URL di database

```sql
UPDATE majors 
SET image = 'assets/images/rpl.jpg'
WHERE id = 1;
```

### Dark Mode Tidak Simpan

**Solusi:**
- Pastikan JavaScript enabled di browser
- Clear cache browser
- Check console untuk error (F12)

### Forum Post Tidak Muncul

**Solusi:**
- Check database connection
- Lihat tabel `posts` di phpMyAdmin
- Check console browser (F12) untuk error AJAX

### PHP Error: "Unexpected token '<?'"

**Solusi:**
- Pastikan PHP versi 7.4+
- Check `php.ini` setting
- Restart Apache (XAMPP)

---

## 📚 Dokumentasi Teknis

### Database Schema

#### Table: majors
```sql
id (INT, PK)
name (VARCHAR 100)
description (TEXT)
content (LONGTEXT)
image (VARCHAR 255)
created_at (TIMESTAMP)
updated_at (TIMESTAMP)
```

#### Table: posts
```sql
id (INT, PK)
name (VARCHAR 50)
message (TEXT)
likes (INT, DEFAULT 0)
created_at (TIMESTAMP)
```

#### Table: messages
```sql
id (INT, PK)
name (VARCHAR 100)
email (VARCHAR 100)
message (TEXT)
created_at (TIMESTAMP)
```

### API Response Format

#### GET /api/get_posts.php
```json
[
  {
    "id": 1,
    "name": "Ahmad",
    "message": "Hello world",
    "likes": 5,
    "created_at": "2024-04-07 10:30:00"
  }
]
```

#### POST /api/add_post.php
```json
{
  "success": true,
  "message": "Pesan berhasil dikirim"
}
```

---

## 🎓 Tips & Trik

1. **Fast Development**
   - Gunakan Live Server extension (VS Code)
   - Auto reload saat file diubah

2. **Testing**
   - Test di berbagai browser
   - Test responsive design (F12 → Device toolbar)
   - Test dengan koneksi lambat

3. **Performance**
   - Optimize image size
   - Minify CSS/JS (production)
   - Enable gzip compression

4. **SEO**
   - Update meta tags di header.php
   - Gunakan semantic HTML
   - Optimize page titles

---

## 📞 Support & Contact

Jika ada pertanyaan atau issue:

1. **Check Documentation** - Baca README ini dulu
2. **Check phpMyAdmin** - Verifikasi database
3. **Check Console** - F12 → Console untuk error JS
4. **Check Error Log** - Lihat logs di XAMPP

---

## 📄 Lisensi

Website ini dibangun untuk SMKN 1 Garut. Penggunaan bebas untuk keperluan sekolah.

---

## 🎉 Sekarang Siap!

Website Anda sudah berjalan. Nikmati!

**Happy Coding! 🚀**

---

**Last Updated**: April 7, 2024
**Version**: 1.0
