-- ========================================
-- DATABASE SQL - SMKN 1 Garut
-- ========================================

-- Create Database
CREATE DATABASE IF NOT EXISTS smkn1_garut;
USE smkn1_garut;

-- ========================================
-- Table: users
-- ========================================
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    role VARCHAR(20) DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- Table: majors (Jurusan)
-- ========================================
CREATE TABLE IF NOT EXISTS majors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    content LONGTEXT NOT NULL,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- Table: posts (Forum Diskusi)
-- ========================================
CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    message TEXT NOT NULL,
    likes INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- Table: messages (Kontak)
-- ========================================
CREATE TABLE IF NOT EXISTS messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- Insert Sample Data - Majors
-- ========================================
INSERT INTO majors (name, description, content, image) VALUES
(
    'Rekayasa Perangkat Lunak (RPL)',
    'Program keahlian yang melatih peserta didik untuk mengembangkan dan mengelola aplikasi software.',
    'Kurikulum RPL mencakup:\n
- Pemrograman dasar (PHP, Java, Python)\n
- Database (MySQL, Oracle)\n
- Web Development (HTML, CSS, JavaScript)\n
- Mobile Development (Android)\n
- UI/UX Design\n
- Software Testing\n
\nMateri pembelajaran disesuaikan dengan kebutuhan industri teknologi informasi terkini. Siswa mendapatkan pengalaman praktik langsung melalui proyek-proyek nyata dan magang di perusahaan IT ternama.\n
\nPeluang Kerja:\n
- Programmer Web\n
- Mobile Developer\n
- Software Developer\n
- Network Administrator\n
- Database Administrator\n
- Freelancer IT',
    'https://via.placeholder.com/400x300?text=RPL'
),
(
    'Teknik Komputer dan Jaringan (TKJ)',
    'Program keahlian yang fokus pada infrastruktur jaringan komputer dan sistem telekomunikasi.',
    'Kurikulum TKJ mencakup:\n
- Dasar-dasar Networking\n
- Konfigurasi Router dan Switch\n
- Sistem Operasi (Windows, Linux)\n
- TCP/IP dan Subnetting\n
- Cybersecurity Basics\n
- Network Troubleshooting\n
\nPeserta didik belajar mengelola infrastruktur jaringan, implementasi keamanan jaringan, dan pemeliharaan sistem computer. Program ini dilengkapi dengan lab networking berstandar internasional.\n
\nPeluang Kerja:\n
- Network Administrator\n
- Network Engineer\n
- Technical Support\n
- System Administrator\n
- IT Consultant\n
- Security Officer',
    'https://via.placeholder.com/400x300?text=TKJ'
),
(
    'Akuntansi Keuangan Lembaga (AKL)',
    'Program keahlian yang mempersiapkan peserta didik untuk bekerja di bidang akuntansi dan keuangan.',
    'Kurikulum AKL mencakup:\n
- Akuntansi Dasar dan Lanjut\n
- Akuntansi Keuangan\n
- Perpajakan\n
- Akuntansi Manajemen\n
- Auditing\n
- Software Akuntansi (MYOB, Zahir)\n
\nSiswa belajar mencatat, menganalisis, dan melaporkan transaksi keuangan sesuai standar akuntansi internasional. Tersedia sertifikasi MYOB dan Software Akuntansi lainnya.\n
\nPeluang Kerja:\n
- Staf Akuntansi\n
- Akuntan Publik\n
- Auditor\n
- Manajer Keuangan\n
- Cost Analyst\n
- Pajak Consultant',
    'https://via.placeholder.com/400x300?text=AKL'
),
(
    'Administrasi Perkantoran',
    'Program keahlian yang mempersiapkan lulusan untuk menjadi profesional administrasi di berbagai instansi.',
    'Kurikulum Administrasi Perkantoran mencakup:\n
- Manajemen Perkantoran\n
- Tata Kelola Administrasi\n
- Korespondensi Bisnis\n
- Arsip Management\n
- Customer Service\n
- Microsoft Office Applications\n
\nPeserta didik dilatih untuk mengelola dokumen, surat-menyurat, pertemuan, dan administrasi kantor secara profesional dan efisien.\n
\nPeluang Kerja:\n
- Administrative Officer\n
- Secretary\n
- Receptionist\n
- Office Manager\n
- Data Entry Specialist\n
- HR Administration',
    'https://via.placeholder.com/400x300?text=Admin'
),
(
    'Teknik Mekatronika',
    'Program keahlian yang menggabungkan mekanik, elektrik, dan elektronika untuk menghasilkan tenaga profesional bidang otomasi.',
    'Kurikulum Teknik Mekatronika mencakup:\n
- Dasar Listrik dan Elektronika\n
- Pneumatika dan Hidrolik\n
- PLC (Programmable Logic Controller)\n
- Robotika\n
- Maintenance Mesin Industri\n
- Sistem Otomasi\n
\nSiswa mendapatkan pengalaman praktik langsung dengan peralatan industri dan robotika modern di workshop berstandar manufaktur.\n
\nPeluang Kerja:\n
- Maintenance Technician\n
- Automation Engineer\n
- Production Operator\n
- Robotics Programmer\n
- Quality Control Specialist\n
- Industrial Technician',
    'https://via.placeholder.com/400x300?text=Mekatronika'
),
(
    'Penjualan dan Pemasaran',
    'Program keahlian yang mengembangkan keterampilan penjualan, pemasaran, dan manajemen bisnis.',
    'Kurikulum Penjualan dan Pemasaran mencakup:\n
- Manajemen Pemasaran\n
- Teknik Penjualan\n
- Perilaku Konsumen\n
- Komunikasi Bisnis\n
- Digital Marketing\n
- Customer Relationship Management\n
\nPeserta didik belajar strategi pemasaran modern, termasuk digital marketing dan e-commerce. Program ini fokus pada pengembangan soft skills dan entrepreneurship.\n
\nPeluang Kerja:\n
- Sales Executive\n
- Marketing Officer\n
- Business Development\n
- Event Organizer\n
- Digital Marketer\n
- Entrepreneur',
    'https://via.placeholder.com/400x300?text=Marketing'
);

-- ========================================
-- Insert Sample Data - Posts (Forum)
-- ========================================
INSERT INTO posts (name, message, likes, created_at) VALUES
(
    'Ahmad Rizki',
    'Halo semua! Saya siswa baru di RPL. Ada yang tahu tips untuk belajar programming yang efektif?',
    5,
    NOW()
),
(
    'Siti Nurhaliza',
    'Saya lulusan TKJ tahun 2023. Alhamdulillah sekarang sudah bekerja di perusahaan IT. Kurikulum TKJ sangat membantu.',
    12,
    DATE_SUB(NOW(), INTERVAL 1 HOUR)
),
(
    'Budi Santoso',
    'Bagi yang minat di bidang akuntansi, AKL adalah pilihan yang tepat. Guru-guru kami sangat berpengalaman.',
    8,
    DATE_SUB(NOW(), INTERVAL 2 HOUR)
);
