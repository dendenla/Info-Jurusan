# Quick Start Guide - Website SMKN 1 Garut

⚡ **Mulai dalam 5 menit!**

---

## 📋 Requirement

- XAMPP (Apache + MySQL + PHP)
- Browser modern

---

## 🚀 Step 1: Setup XAMPP (Jika belum ada)

### Download & Install
1. Kunjungi: https://www.apachefriends.org/
2. Download XAMPP (choose your OS)
3. Install di `C:\xampp`
4. Buka XAMPP Control Panel

### Jalankan Services
```
[Apache]  → Start ✓ (Hijau)
[MySQL]   → Start ✓ (Hijau)
```

---

## 📦 Step 2: Copy Project

```
Copy folder "Info jurusan"
↓
To: C:\xampp\htdocs\Info jurusan
```

Verify struktur:
```
C:\xampp\htdocs\Info jurusan\
├── index.php
├── config/
├── database.sql
└── ... (files lain)
```

---

## 🗄️ Step 3: Setup Database

### Option A: phpMyAdmin (Recommended)

1. Browser → **http://localhost/phpmyadmin**
2. Click **"Import"** (Top Menu)
3. Click **"Browse"** → Select `database.sql`
4. Click **"Import"** ← Blue button
5. ✅ Done!

### Option B: Command Line

```bash
# Terminal/CMD
cd C:\xampp\mysql\bin
mysql -u root -p
# (tekan Enter jika no password)

CREATE DATABASE smkn1_garut;
USE smkn1_garut;
source C:/xampp/htdocs/Info\ jurusan/database.sql;
EXIT;
```

---

## 🌐 Step 4: Open Website

### Browser:
```
http://localhost/Info%20jurusan/
```

### Or File Explorer:
```
C:\xampp\htdocs\Info jurusan\index.php
  ↓
  Double-click → Auto open di browser
```

---

## ✅ Verify Installation

### Checklist:
- [ ] Homepage tampil (blue & white design)
- [ ] Logo SMKN 1 Garut terlihat
- [ ] Jurusan cards muncul
- [ ] Search box berfungsi
- [ ] Forum dapat diakses
- [ ] Dark mode toggle ada

**Jika semua ✓ → Selesai!** 🎉

---

## 🎯 Navigation

| Page | URL |
|------|-----|
| Beranda | `/` |
| Jurusan | `/jurusan.php` |
| Detail | `/detail.php?id=1` |
| Forum | `/forum.php` |
| Kontak | `/kontak.php` |
| Lokasi | `/lokasi.php` |

---

## 🧪 Test Features

### 1. Search Jurusan
```
Buka: /jurusan.php
Ketik: "RPL"
Hasil: Only RPL showing ✓
```

### 2. Forum Post
```
Buka: /forum.php
Isikan: Nama + Pesan
Klik: Kirim
Hasil: Post muncul di atas ✓
```

### 3. Like Post
```
Klik: 👍 Like button
Hasil: Counter increment ✓
```

### 4. Dark Mode
```
Klik: 🌙 Icon (navbar)
Hasil: Theme berubah ✓
```

---

## 📞 Troubleshooting

### Blank Page?
```
→ Check XAMPP (Apache & MySQL running?)
→ Check F12 Console (error?)
→ Restart Apache
```

### Can't Connect to Database?
```
→ phpMyAdmin: http://localhost/phpmyadmin
→ Check database exists: smkn1_garut
→ Check config/database.php
```

### Images Not Loading?
```
→ Normal (placeholder dari URL eksternal)
→ Or upload lokal ke assets/images/
```

---

## 📚 Learn More

| Document | For |
|----------|-----|
| [README.md](README.md) | Documentation lengkap |
| [INSTALL.md](INSTALL.md) | Instalasi detail |
| [FEATURES.md](FEATURES.md) | Daftar fitur |
| [CHECKLIST.md](CHECKLIST.md) | Verifikasi sistem |

---

## 🎓 Next Steps

1. ✅ Website running
2. 📝 Customize content (edit di phpMyAdmin)
3. 🖼️ Add your own images
4. 🔐 Change database password (production)
5. 🚀 Deploy to internet (hosting)

---

## 💡 Tips

- 🌙 Dark mode saves preference ke browser
- 🔍 Search real-time, no refresh
- 💬 Forum tanpa login (public)
- 📱 Mobile-friendly design
- ⚡ Fast loading (< 2 sec)

---

## 🆘 Emergency

**Website error?**
1. F12 → Console → Copy error
2. Check README.md troubleshooting
3. Restart XAMPP
4. Re-import database

**All else fails?**
- Delete database
- Re-import from `database.sql`
- Clear browser cache (Ctrl+Shift+Del)
- Restart browser & XAMPP

---

## ✨ You're All Set!

🎉 **Website SMKN 1 Garut ready to use!**

Enjoy! 🚀

---

**Last Updated**: April 7, 2024
**Version**: 1.0
