# Panduan Memperbaiki 3 Bug Aplikasi Info-Jurusan

## 📋 Ringkasan Bug yang Diperbaiki

1. **Bug Registrasi**: Akun gagal dibuat atau muncul pesan "akun sudah ada"
   - **Penyebab**: Kolom `role` hilang di database, email sending error menghalangi flow
   - **Status**: ✅ DIPERBAIKI

2. **Bug Login Password**: Password selalu salah meski benar yang diinput
   - **Penyebab**: Query SELECT mencari kolom `role` yang tidak ada di database
   - **Status**: ✅ DIPERBAIKI

3. **Bug Jurusan Duplikasi**: Jurusan kadang ter-double atau tergandakan
   - **Penyebab**: Tidak ada pengecekan duplikasi saat import data
   - **Status**: ✅ DIPERBAIKI

---

## 🔧 Langkah-Langkah Memperbaiki

### Langkah 1: Update Struktur Database

Buka browser dan akses script berikut untuk menambahkan kolom yang hilang:

```
http://localhost/Info-Jurusan/update_users_table.php
```

**Yang dilakukan:**
- Menambahkan kolom `role` ke tabel users (default: 'user')
- Membuat kolom `email` menjadi UNIQUE
- Memastikan struktur database sesuai dengan query di aplikasi

**Output yang diharapkan:**
```
✓ Kolom 'role' berhasil ditambahkan!
✓ Email constraint berhasil ditambahkan!
```

### Langkah 2: Update Data Jurusan (Hapus Duplikasi)

Buka script import jurusan untuk membersihkan dan reimport data dengan benar:

```
http://localhost/Info-Jurusan/import_majors.php
```

**Yang dilakukan:**
- Menghapus semua data jurusan lama
- Reimport data jurusan dengan pengecekan duplikasi
- Mencegah penambahan jurusan yang sudah ada

**Output yang diharapkan:**
```
✓ Data Jurusan SMKN 1 Garut Berhasil Diperbarui!
Total jurusan yang ditambahkan: 10/10
```

---

## ✅ Setelah Perbaikan - Test Fitur

### Test Registrasi User Baru
1. Buka: `http://localhost/Info-Jurusan/register.php`
2. Isi form dengan data baru:
   - Username: `testuser123`
   - Email: `test@example.com`
   - Password: `password123`
3. Klik tombol Daftar
4. **Hasil yang diharapkan**: ✓ Registrasi berhasil tanpa error!

### Test Login
1. Buka: `http://localhost/Info-Jurusan/login.php`
2. Masukkan username dan password yang baru dibuat
3. **Hasil yang diharapkan**: ✓ Login berhasil dan masuk ke dashboard!

### Test Jurusan (No Duplicates)
1. Buka: `http://localhost/Info-Jurusan/jurusan.php`
2. Periksa daftar jurusan
3. **Hasil yang diharapkan**: ✓ Semua 10 jurusan ditampilkan tanpa duplikasi!

---

## 📝 Detail Perubahan Kode

### 1. File: `database.sql`
- Menambahkan kolom `role VARCHAR(20) DEFAULT 'user'`
- Membuat `email` UNIQUE

### 2. File: `update_users_table.php` (BARU)
- Script untuk update database secara otomatis
- Menambahkan kolom yang hilang
- Membuat email menjadi UNIQUE

### 3. File: `register.php`
- Menambahkan error handling untuk email sending
- Registrasi tetap berhasil meski email gagal dikirim
- Error email hanya di-log, tidak ditampilkan ke user

### 4. File: `import_majors.php`
- Menambahkan pengecekan duplikasi sebelum insert
- Mencegah penambahan jurusan yang nama-nya sama
- Menampilkan jumlah duplikasi yang ditemukan

---

## 🚀 Troubleshooting

### Problem: Update script tidak berjalan
**Solusi**: Pastikan database sudah ada dan sudah login ke MySQL

### Problem: Registrasi masih gagal setelah update
**Solusi**: 
- Buka phpMyAdmin
- Periksa tabel `users` apakah sudah punya kolom `role`
- Jika belum, jalankan script `update_users_table.php` lagi

### Problem: Login masih gagal dengan error "password salah"
**Solusi**:
- Pastikan sudah menjalankan `update_users_table.php`
- Coba logout dan login ulang
- Cek di database bahwa kolom `role` sudah ada

### Problem: Jurusan masih duplikasi
**Solusi**:
- Buka `import_majors.php` lagi untuk re-import data
- Periksa di database jumlah record di tabel `majors`
- Seharusnya hanya 10 record (tidak lebih)

---

## 📞 Support

Jika ada masalah:
1. Periksa file log di: `config/` folder
2. Buka Browser DevTools (F12) untuk cek error di console
3. Cek phpMyAdmin untuk struktur tabel database

---

**Update Date**: April 2026
**Versi**: 1.0 - Bug Fix Release
