# Struktur Lengkap Project - Website SMKN 1 Garut

## 📁 File Tree

```
Info jurusan/
│
├── 📄 Core Files
│   ├── index.php                 # Halaman Beranda
│   ├── jurusan.php              # Halaman Daftar Jurusan
│   ├── detail.php               # Halaman Detail Jurusan
│   ├── forum.php                # Forum Diskusi
│   ├── kontak.php               # Halaman Kontak
│   ├── lokasi.php               # Halaman Lokasi
│   ├── stats.php                # Dashboard Statistik (Optional)
│   └── 404.php                  # Halaman Error 404
│
├── 📁 config/
│   ├── database.php             # Konfigurasi Database MySQL
│   ├── constants.php            # Konstanta Aplikasi
│   ├── helpers.php              # Fungsi-fungsi Helper
│   └── index.php                # Security: Prevent direct access
│
├── 📁 includes/
│   ├── header.php               # Navbar & Header Shared
│   ├── footer.php               # Footer & Scripts Shared
│   └── index.php                # Security: Prevent direct access
│
├── 📁 api/
│   ├── add_post.php             # API: Tambah Post Forum
│   ├── get_posts.php            # API: Ambil Semua Posts
│   ├── like_post.php            # API: Like Post
│   ├── delete_post.php          # API: Hapus Post
│   └── index.php                # Security: Prevent direct access
│
├── 📁 assets/
│   ├── css/
│   │   ├── style.css            # CSS Custom Utama
│   │   └── toast.css            # CSS Toast Notifications
│   │
│   ├── js/
│   │   └── main.js              # JavaScript Utama
│   │
│   └── images/                  # Folder gambar lokal (opsional)
│       ├── .gitkeep
│       └── (images di sini)
│
├── 📁 logs/                     # Folder logs (opsional)
│   └── .gitkeep
│
├── 📁 data/                     # Folder data (dari workspace sebelumnya)
│   ├── majors.json              # Data jurusan (JSON format)
│   └── posts.json               # Data posts (JSON format)
│
├── 📄 Documentation Files
│   ├── README.md                # Dokumentasi Utama
│   ├── INSTALL.md               # Panduan Instalasi Detail
│   ├── QUICK_START.md           # Panduan Cepat (5 menit)
│   ├── FEATURES.md              # Daftar Fitur Lengkap
│   ├── CHANGELOG.md             # Catatan Perubahan
│   ├── CHECKLIST.md             # Pre-launch Checklist
│   └── PROJECT_STRUCTURE.md     # File ini
│
├── 📄 Database Files
│   └── database.sql             # SQL untuk membuat database & table
│
├── 📄 Configuration Files
│   ├── .htaccess                # Apache Configuration
│   ├── .gitignore               # Git Ignore File
│   └── composer.json (optional) # PHP Dependencies
│
└── 📄 Server Files
    ├── Thumbs.db               # Windows cache (dapat dihapus)
    └── .git/                   # Git repository (opsional)
```

---

## 📊 Total Files & Stats

### File Count
- **PHP Files**: 15 files
- **CSS Files**: 2 files
- **JavaScript Files**: 1 file
- **SQL Files**: 1 file
- **Documentation**: 6 markdown files
- **Config Files**: 4 files
- **Total**: 29+ files

### Project Size
- **Total Size**: ~500 KB
- **Code**: ~100 KB
- **Documentation**: ~200 KB
- **Database**: ~50 KB
- **Assets**: ~150 KB

---

## 🔄 File Dependencies

### Dependency Tree

```
index.php
├── config/database.php
├── includes/header.php
│   └── config/database.php
│   └── assets/css/style.css
│   └── assets/js/main.js
└── includes/footer.php
    └── assets/js/main.js

jurusan.php
├── includes/header.php
├── config/database.php
└── includes/footer.php

detail.php
├── includes/header.php
├── config/database.php
└── includes/footer.php

forum.php
├── includes/header.php
├── config/database.php
├── includes/footer.php
├── assets/js/main.js
├── api/add_post.php
├── api/get_posts.php
├── api/like_post.php
└── api/delete_post.php

kontak.php
├── includes/header.php
├── config/database.php
└── includes/footer.php

lokasi.php
├── includes/header.php
└── includes/footer.php

stats.php
├── config/database.php
└── includes (header/footer tidak digunakan di sini)
```

---

## 📝 File Descriptions

### Core Page Files

#### index.php (Homepage)
- **Size**: ~5 KB
- **Purpose**: Halaman utama dengan hero section
- **Includes**: 
  - Header, footer
  - Database query untuk majors
  - Statistik sekolah
  - Testimonial section

#### jurusan.php (Majors List)
- **Size**: ~3 KB
- **Purpose**: Menampilkan daftar semua jurusan
- **Features**:
  - Card layout
  - Search functionality (JavaScript)
  - Detail links

#### detail.php (Major Detail)
- **Size**: ~4 KB
- **Purpose**: Detail page untuk setiap jurusan
- **Features**:
  - Full content display
  - Sidebar information
  - Related majors
  - URL parameter: ?id=1

#### forum.php (Discussion)
- **Size**: ~6 KB
- **Purpose**: Forum diskusi tanpa login
- **Features**:
  - Form input
  - Post list
  - AJAX integration
  - Like & delete system

#### kontak.php (Contact)
- **Size**: ~4 KB
- **Purpose**: Contact form & info
- **Features**:
  - Form validation
  - Database save
  - Contact information
  - Social media links

#### lokasi.php (Location)
- **Size**: ~3 KB
- **Purpose**: Lokasi & peta sekolah
- **Features**:
  - Google Maps embed
  - Address information
  - Direction guides
  - Facilities list

#### stats.php (Statistics)
- **Size**: ~4 KB
- **Purpose**: Dashboard statistik (optional admin)
- **Features**:
  - Stats cards
  - Recent posts
  - Recent messages

---

### Configuration Files

#### config/database.php
- **Size**: ~300 bytes
- **Purpose**: Koneksi MySQL
- **Contains**:
  - DB host, user, password
  - Connection setup
  - Charset configuration

#### config/constants.php
- **Size**: ~1 KB
- **Purpose**: Aplikasi constants
- **Contains**:
  - School information
  - Site settings
  - Timezone
  - Upload limits

#### config/helpers.php
- **Size**: ~3 KB
- **Purpose**: Helper functions
- **Contains**:
  - sanitize_input()
  - format_date_id()
  - get_relative_time()
  - email validation
  - string utilities
  - logging functions

---

### Template Files

#### includes/header.php
- **Size**: ~2 KB
- **Purpose**: Header & navbar template
- **Features**:
  - Navbar sticky
  - Dark mode toggle
  - Database query for majors count
  - Bootstrap integration

#### includes/footer.php
- **Size**: ~1 KB
- **Purpose**: Footer template
- **Features**:
  - Copyright info
  - Quick links
  - Contact info
  - Script includes

---

### API Files

#### api/add_post.php
- **Size**: ~400 bytes
- **Purpose**: Handle form post submission
- **Method**: POST
- **Response**: JSON
- **Database**: INSERT into posts

#### api/get_posts.php
- **Size**: ~300 bytes
- **Purpose**: Fetch all posts
- **Method**: GET
- **Response**: JSON array
- **Database**: SELECT from posts

#### api/like_post.php
- **Size**: ~400 bytes
- **Purpose**: Update post likes
- **Method**: POST
- **Response**: JSON with new count
- **Database**: UPDATE posts

#### api/delete_post.php
- **Size**: ~400 bytes
- **Purpose**: Delete post
- **Method**: POST
- **Response**: JSON success
- **Database**: DELETE from posts

---

### Asset Files

#### assets/css/style.css
- **Size**: ~12 KB
- **Purpose**: Custom styling
- **Features**:
  - Custom variables (colors)
  - Card hover effects
  - Dark mode styles
  - Responsive design
  - Animations
  - Utilities

#### assets/css/toast.css
- **Size**: ~2 KB
- **Purpose**: Toast notification styles
- **Features**:
  - Toast positioning
  - Animation effects
  - Mobile responsive
  - Color variants

#### assets/js/main.js
- **Size**: ~8 KB
- **Purpose**: Main JavaScript
- **Features**:
  - Dark mode toggle
  - Search functionality
  - AJAX handlers
  - Utility functions
  - Event listeners
  - LocalStorage management

---

### Documentation Files

#### README.md
- **Size**: ~15 KB
- **Purpose**: Main documentation
- **Contents**:
  - Project overview
  - Installation guide
  - Configuration
  - Troubleshooting
  - API docs
  - Features list

#### INSTALL.md
- **Size**: ~12 KB
- **Purpose**: Detailed installation
- **Contents**:
  - Step-by-step guide
  - XAMPP setup
  - Database setup
  - Configuration
  - Verification
  - Troubleshooting

#### QUICK_START.md
- **Size**: ~5 KB
- **Purpose**: Quick start (5 minutes)
- **Contents**:
  - Minimal steps
  - Key checklist
  - Navigation guide
  - Feature testing
  - Troubleshooting quick tips

#### FEATURES.md
- **Size**: ~15 KB
- **Purpose**: Features documentation
- **Contents**:
  - Feature list
  - UI/UX features
  - Technical features
  - Security features
  - Performance features
  - Future roadmap

#### CHANGELOG.md
- **Size**: ~8 KB
- **Purpose**: Version history
- **Contents**:
  - Version notes
  - Release dates
  - Feature additions
  - Bug fixes
  - Planned features

#### CHECKLIST.md
- **Size**: ~12 KB
- **Purpose**: Pre-launch checklist
- **Contents**:
  - Environment verification
  - Functional testing
  - UI/UX testing
  - Performance testing
  - Security testing
  - Sign-off

---

### Database & Config

#### database.sql
- **Size**: ~3 KB
- **Purpose**: Database schema & sample data
- **Contains**:
  - CREATE DATABASE
  - CREATE 4 TABLES:
    - users
    - majors (6 samples)
    - posts (3 samples)
    - messages
  - Sample data

#### .htaccess
- **Size**: ~1 KB
- **Purpose**: Apache configuration
- **Contains**:
  - Rewrite rules
  - Security headers
  - Caching directives
  - MIME types
  - Compression config

#### .gitignore
- **Size**: ~2 KB
- **Purpose**: Git ignore patterns
- **Contains**:
  - OS files
  - IDE files
  - Node modules
  - Log files
  - Sensitive files

---

## 🔗 File Relationships

### Database Related
```
config/database.php
    ↓ (Used by all PHP files)
├── index.php
├── jurusan.php
├── detail.php
├── forum.php
├── kontak.php
└── api/* (all API files)
```

### Template Related
```
includes/header.php ← (Used by all pages)
includes/footer.php ← (Used by all pages)
```

### Asset Related
```
assets/css/style.css ← (Loaded in header)
assets/css/toast.css ← (Loaded in header)
assets/js/main.js ← (Loaded in footer)
```

---

## 📦 How to Extend

### Add New Page
1. Create `newpage.php`
2. Include header & footer:
   ```php
   <?php include 'includes/header.php'; ?>
   <!-- content -->
   <?php include 'includes/footer.php'; ?>
   ```
3. Add link to navbar in `includes/header.php`

### Add New API
1. Create `api/new_action.php`
2. Include database:
   ```php
   <?php
   header('Content-Type: application/json');
   include '../config/database.php';
   // API logic here
   ?>
   ```
3. Call from JavaScript using fetch()

### Add New Style
1. Add to `assets/css/style.css`
2. Or create new CSS file and import in header.php

### Add New Function
1. Add to `config/helpers.php`
2. Call using function name

---

## 🔒 Security Checklist

Files yang handle security:
- ✅ config/database.php (SQL connection)
- ✅ includes/header.php (XSS protection in header)
- ✅ api/* (Input sanitization)
- ✅ .htaccess (Directory protection)

---

## 📈 Performance

### File Caching
- CSS minified for production
- JavaScript optimized
- Images lazy-loaded ready
- CDN used for Bootstrap/Icons

### Load Order
1. HTML parsing
2. CSS loading (blocking)
3. Page render
4. JavaScript (async possible)

---

## 🚀 Deployment Checklist

- [ ] All PHP files: PHP syntax correct
- [ ] All database files: .sql valid
- [ ] All config: .htaccess active
- [ ] All assets: CSS/JS linked correctly
- [ ] Documentation: README complete
- [ ] Security: No credentials exposed

---

**Total Documentation**: 600+ lines
**Total Code**: 200+ lines
**Estimated Learning Time**: 2-4 hours

Selamat belajar! 📚
