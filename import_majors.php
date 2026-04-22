<?php
/**
 * Script untuk Update Data Jurusan SMKN 1 Garut
 * Jalankan sekali untuk mengupdate database dengan data jurusan yang benar
 */

require_once 'config/database.php';

// Array data jurusan SMKN 1 Garut
$majors = [
    [
        'name' => 'Management Perkantoran dan Layanan Bisnis (MPL)',
        'description' => 'Program keahlian yang melatih peserta didik menjadi profesional administrasi perkantoran dan layanan bisnis yang kompeten.',
        'content' => 'OVERVIEW:
Management Perkantoran dan Layanan Bisnis (MPL) adalah program keahlian yang dirancang untuk menghasilkan tenaga kerja yang profesional dalam bidang administrasi perkantoran modern dan layanan bisnis yang berkualitas.

KOMPETENSI UTAMA:
- Administrasi Perkantoran Modern
- Manajemen Arsip dan Dokumentasi
- Layanan Pelanggan Profesional
- Komunikasi Bisnis (Lisan dan Tertulis)
- Operasional Kantor Digital
- Protokol dan Tata Usaha
- Manajemen Waktu dan Prioritas
- Event Organizing

KURIKULUM PEMBELAJARAN:
- Dasar-dasar Administrasi Kantor
- Software Office (Ms. Office, Google Workspace)
- Manajemen Database Sederhana
- Komunikasi Bisnis Indonesia dan Inggris
- Customer Service Excellence
- Etika dan Profesionalisme Kerja
- Public Speaking
- Entrepreneurship

FASILITAS:
- Ruang Kantor Simulasi
- Komputer dan Printer Modern
- Software Kantor Terlengkap
- Ruang Meeting dan Event
- Perpustakaan Digital

PELUANG KARIR:
- Sekretaris Profesional
- Administrator Kantor
- Customer Service Officer
- Front Office Manager
- Executive Assistant
- Human Resources Administrator
- Office Manager
- Staf Administrasi di Berbagai Institusi
- Berwiraswasta (Konsultan Bisnis)

PROSPEK KERJA:
Lulusan MPL SMKN 1 Garut memiliki kompetensi tinggi yang dibutuhkan oleh:
- Perusahaan Multinasional
- Instansi Pemerintahan
- Bank dan Lembaga Keuangan
- Hotel dan Pariwisata
- Rumah Sakit dan Healthcare
- Universitas dan Sekolah
- Kantor Notaris dan Hukum

SERTIFIKASI:
- Sertifikat Keahlian dari SMKN 1 Garut
- Sertifikasi Microsoft Office Specialist (MOS)
- Sertifikasi Customer Service Internasional',
        'image' => 'https://via.placeholder.com/400x300?text=MPL'
    ],
    [
        'name' => 'Pemasaran (PM)',
        'description' => 'Program keahlian yang mempersiapkan peserta didik menjadi profesional pemasaran dan penjualan yang handal di era digital.',
        'content' => 'OVERVIEW:
Pemasaran (PM) adalah program keahlian yang fokus mengembangkan kemampuan peserta didik dalam strategi pemasaran, penjualan, dan komunikasi pemasaran di era digital modern.

KOMPETENSI UTAMA:
- Strategi Pemasaran Digital
- Social Media Marketing
- E-Commerce Management
- Sales Management
- Customer Relationship Management (CRM)
- Market Research
- Brand Management
- Content Marketing

KURIKULUM PEMBELAJARAN:
- Dasar-dasar Pemasaran
- Pemasaran Digital dan Media Sosial
- E-Commerce dan Marketplace
- Sales Techniques dan Negotiation
- Consumer Behavior Analysis
- Marketing Research
- Advertising dan Promotion
- Business English
- Entrepreneurship & Startup

FASILITAS:
- Lab Multimedia dan Digital Marketing
- Studio Produksi Content
- E-Commerce Platform Setup
- Komputer dan Software Marketing Modern
- Ruang Simulasi Penjualan
- Library Digital Resources

PELUANG KARIR:
- Digital Marketing Specialist
- Social Media Manager
- E-Commerce Administrator
- Sales Executive
- Brand Manager
- Market Research Analyst
- Content Creator & Influencer
- Sales Supervisor/Manager
- Berwiraswasta (Toko Online, Reseller)

PROSPEK KERJA:
Lulusan PM SMKN 1 Garut dibutuhkan oleh:
- Perusahaan Retail dan E-Commerce
- Agensi Marketing dan Advertising
- Digital Marketing Agency
- Perusahaan FMCG
- Startup dan Tech Companies
- Tourism dan Hospitality
- Media dan Entertainment
- Distributor dan Supplier

SERTIFIKASI:
- Sertifikat Keahlian Pemasaran
- Sertifikasi Google Digital Marketing
- Sertifikasi Social Media Marketing',
        'image' => 'https://via.placeholder.com/400x300?text=PM'
    ],
    [
        'name' => 'Teknologi Farmasi (TKF)',
        'description' => 'Program keahlian yang melatih peserta didik dalam proses produksi, quality control, dan distribusi produk farmasi yang berstandar internasional.',
        'content' => 'OVERVIEW:
Teknologi Farmasi (TKF) adalah program keahlian yang mempersiapkan tenaga kerja terampil dalam industri farmasi dengan standar GMP (Good Manufacturing Practice) dan regulasi farmasi nasional maupun internasional.

KOMPETENSI UTAMA:
- Proses Produksi Obat dan Kosmetik
- Quality Control dan Assurance Farmasi
- Manajemen Bahan Baku Farmasi
- Pengemasan Produk Farmasi
- Sanitasi dan Hygiene Farmasi
- Keselamatan Kerja Industri
- Regulatory dan Compliance
- Pharmaceutical Knowledge

KURIKULUM PEMBELAJARAN:
- Dasar-dasar Farmasi dan Kimia Farmasi
- Teknologi Produksi Obat
- Farmakologi Dasar
- Quality Control Produk Farmasi
- Sanitasi dan Sterilisasi
- Pengemasan dan Labeling Produk
- Regulasi dan Compliance Farmasi
- Safety, Health, Environment (SHE)
- Manajemen Inventory Farmasi

FASILITAS:
- Laboratorium Farmasi Berstandar GMP
- Ruang Produksi Simulasi
- Alat-alat Laboratorium Modern
- Mesin Pengemasan dan Bottling
- Ruang Quality Control
- Instrumen Analisis Farmasi

PELUANG KARIR:
- Production Operator Farmasi
- Quality Control Officer
- Pharmaceutical Technician
- Warehouse Supervisor
- Packaging Specialist
- Safety Officer
- Product Development Assistant
- Pharmaceutical Sales Representative
- Regulatory Specialist

PROSPEK KERJA:
Lulusan TKF SMKN 1 Garut sangat dibutuhkan oleh:
- Industri Farmasi Besar (PT IDI, Kalbe, Dexa, Sanbe)
- Pabrik Kosmetik
- Biotech Company
- Pharmaceutical Distribution
- Rumah Sakit dan Apotek
- Laboratorium Klinik
- Quality Assurance Company

SERTIFIKASI:
- Sertifikat Keahlian Teknologi Farmasi
- Sertifikasi GMP Basic Training
- Sertifikasi Quality Control Farmasi',
        'image' => 'https://via.placeholder.com/400x300?text=TKF'
    ],
    [
        'name' => 'Teknik Jaringan Komputer (TJK)',
        'description' => 'Program keahlian yang fokus pada perancangan, implementasi, dan maintenance infrastruktur jaringan komputer dan sistem telekomunikasi.',
        'content' => 'OVERVIEW:
Teknik Jaringan Komputer (TJK) adalah program keahlian yang mempersiapkan peserta didik untuk menjadi Network Administrator dan Network Engineer yang professional di era networking modern.

KOMPETENSI UTAMA:
- Desain dan Implementasi Jaringan
- Konfigurasi Router dan Switch Enterprise
- Network Security dan Firewall
- Administrasi Sistem Linux dan Windows Server
- Cloud Networking
- Network Troubleshooting
- VoIP dan Telecommunications
- Cybersecurity

KURIKULUM PEMBELAJARAN:
- Dasar-dasar Networking dan TCP/IP
- Cisco (CCNA Routing & Switching)
- Linux System Administration
- Windows Server Administration
- Network Security dan Firewalls
- VoIP dan Unified Communications
- Cloud Services (AWS, Azure)
- Network Troubleshooting dan Maintenance
- Data Center Basics

FASILITAS:
- Lab Networking Lengkap dengan Cisco Equipment
- Server Rack dan Switch Enterprise
- Linux dan Windows Server Lab
- Firewall dan Security Appliances
- Simulator Network (Cisco Packet Tracer)
- Subnetting dan IP Planning Tools
- WiFi dan Wireless Testing Equipment

PELUANG KARIR:
- Network Administrator
- Network Engineer
- Cisco Network Technician
- System Administrator
- Security Administrator
- Technical Support Engineer
- IT Manager
- Network Consultant
- Berwiraswasta (ISP, Network Services)

PROSPEK KERJA:
Lulusan TJK SMKN 1 Garut sangat dibutuhkan oleh:
- Internet Service Provider (ISP)
- Data Center Company
- Perusahaan Multinasional
- Bank dan Lembaga Keuangan
- Institusi Pemerintah
- Universitas dan Sekolah
- Hospital Networks
- Telekomunikasi Company

SERTIFIKASI:
- Sertifikat Keahlian TJK
- Sertifikasi CCNA (Cisco)
- Sertifikasi Network+
- Sertifikasi Linux+',
        'image' => 'https://via.placeholder.com/400x300?text=TJK'
    ],
    [
        'name' => 'Pengembangan Perangkat Lunak dan Gim (PPLG)',
        'description' => 'Program keahlian yang melatih peserta didik menjadi software developer dan game developer profesional dengan teknologi terkini.',
        'content' => 'OVERVIEW:
Pengembangan Perangkat Lunak dan Gim (PPLG) adalah program keahlian unggulan SMKN 1 Garut yang fokus pada pengembangan aplikasi desktop, web, mobile, dan game dengan standar industri internasional.

KOMPETENSI UTAMA:
- Programming (Python, Java, C++, JavaScript)
- Web Development (Frontend dan Backend)
- Mobile Development (Android, iOS)
- Game Development (Unity, Unreal Engine)
- Database Design dan Management
- UI/UX Design
- Software Testing dan QA
- DevOps dan Deployment

KURIKULUM PEMBELAJARAN:
- Pemrograman Dasar dan OOP
- Web Development (HTML, CSS, JavaScript, PHP, Laravel)
- Mobile App Development (Android Studio, Flutter)
- Database (MySQL, PostgreSQL, MongoDB)
- Game Development (Unity Engine)
- UI/UX Design Principles
- Software Testing dan Debugging
- API Development dan Integration
- Version Control (Git)
- Agile Development Methodology

FASILITAS:
- Lab Komputer dengan Spesifikasi Tinggi
- Game Engine Development Station
- IDE dan Development Tools Modern
- Version Control System
- Testing dan Debugging Tools
- Portfolio Development Platform
- Code Repository dan CI/CD Pipeline

PELUANG KARIR:
- Software Developer/Programmer
- Web Developer (Frontend/Backend)
- Mobile Developer (Android/iOS)
- Game Developer
- QA Engineer/Tester
- UI/UX Designer
- DevOps Engineer
- Technical Lead
- Startup Founder/Co-founder

PROSPEK KERJA:
Lulusan PPLG SMKN 1 Garut sangat dibutuhkan oleh:
- Software House dan IT Consulting
- Startup Tech (GAFAM, Fintech, Edtech)
- Game Development Studio
- E-Commerce Platform
- Banking dan Financial Services
- Healthcare IT Solutions
- Media dan Entertainment
- Bisa Freelance dan Remote Work

SERTIFIKASI:
- Sertifikat Keahlian PPLG
- Oracle Java Associate Programmer
- Sertifikasi Web Development
- Android Developer Certificate
- Unity Game Developer Certificate',
        'image' => 'https://via.placeholder.com/400x300?text=PPLG'
    ],
    [
        'name' => 'Teknik Logistik (TLG)',
        'description' => 'Program keahlian yang mempersiapkan peserta didik untuk mengelola supply chain dan distribusi barang secara efisien dan efektif.',
        'content' => 'OVERVIEW:
Teknik Logistik (TLG) adalah program keahlian yang fokus mengembangkan kemampuan peserta didik dalam manajemen supply chain, warehouse management, dan distribusi barang dengan teknologi logistik modern.

KOMPETENSI UTAMA:
- Supply Chain Management
- Warehouse Management System (WMS)
- Inventory Control dan Management
- Distribution dan Delivery
- Procurement Management
- Logistics Planning dan Optimization
- Transportation Management
- Quality Control dalam Logistik

KURIKULUM PEMBELAJARAN:
- Dasar-dasar Logistik dan Supply Chain
- Warehouse Management
- Inventory dan Stock Control
- Procurement Process
- Transportation Management
- Shipping dan Customs Documentation
- Logistik Software (WMS, TMS)
- Cost Analysis dan Optimization
- Safety dan Handling Material
- Entrepreneurship dalam Logistik

FASILITAS:
- Simulasi Warehouse Modern
- Barcode dan RFID Scanning Equipment
- Warehouse Management System Lab
- Forklift Training Area
- Packaging dan Labeling Station
- Logistics Software (SAP, Maximo)
- Simulation dan Planning Tools

PELUANG KARIR:
- Warehouse Supervisor
- Logistics Officer
- Supply Chain Manager
- Procurement Officer
- Inventory Controller
- Distribution Manager
- Logistics Coordinator
- Quality Control Inspector
- Customs Officer
- Berwiraswasta (Jasa Logistik)

PROSPEK KERJA:
Lulusan TLG SMKN 1 Garut sangat dibutuhkan oleh:
- E-Commerce Company (Tokopedia, Shopee, Bukalapak)
- Logistik Provider (JNE, J&T, Sicepat)
- Retail dan Distributor
- Manufacturing Plant
- Kimia dan Farmasi
- Food dan Beverage
- Automotive
- Port dan Shipping Company

SERTIFIKASI:
- Sertifikat Keahlian Logistik
- Sertifikasi Warehouse Management
- Sertifikasi Forklift & Material Handling
- APICS CSCP (Certified Supply Chain Professional)',
        'image' => 'https://via.placeholder.com/400x300?text=TLG'
    ],
    [
        'name' => 'Teknik Energi Terbarukan (TET)',
        'description' => 'Program keahlian yang melatih peserta didik dalam perancangan, instalasi, dan maintenance sistem energi terbarukan seperti surya, angin, dan biomassa.',
        'content' => 'OVERVIEW:
Teknik Energi Terbarukan (TET) adalah program keahlian yang mempersiapkan tenaga kerja terampil dalam industri energi bersih dan berkelanjutan sesuai dengan target net-zero emission Indonesia.

KOMPETENSI UTAMA:
- Instalasi Sistem Tenaga Surya (Solar PV)
- Tenaga Angin (Wind Energy) Basics
- Penyimpanan Energi (Battery Systems)
- Elektrik dan Elektronik Daya
- Maintenance dan Troubleshooting
- Energy Efficiency dan Management
- Project Management Energi Terbarukan
- Safety dan Environmental Protection

KURIKULUM PEMBELAJARAN:
- Dasar-dasar Energi Terbarukan
- Solar Photovoltaic (PV) Systems
- Wind Energy Fundamentals
- Battery Storage Systems
- Power Electronics
- Electrical Installation
- Project Design dan Planning
- Maintenance dan Service
- Energy Audit dan Efficiency
- Business Plan Renewable Energy

FASILITAS:
- Solar Panel Installation Demo
- Solar Simulator Lab
- Battery Storage Lab
- Electrical Testing Equipment
- Wind Turbine Model
- Solar Charge Controller Lab
- Inverter Testing Station
- Safety Equipment dan PPE

PELUANG KARIR:
- Solar Panel Technician
- Renewable Energy Technician
- Installation Specialist
- Project Supervisor
- Maintenance Engineer
- Sales Representative
- Technical Consultant
- Quality Control Inspector
- Berwiraswasta (Solar Installation)

PROSPEK KERJA:
Lulusan TET SMKN 1 Garut sangat dibutuhkan oleh:
- PT PLN (Persero)
- Solar Energy Company
- Wind Farm Operator
- Smart Grid Company
- Building Automation Services
- Industrial Power Systems
- Renewable Energy Consultant
- Government Energy Projects

SERTIFIKASI:
- Sertifikat Keahlian TET
- Sertifikasi Solar Installation (NABCEP)
- Sertifikasi Electrical Safety (OSHA)
- Sertifikasi Energy Auditor',
        'image' => 'https://via.placeholder.com/400x300?text=TET'
    ],
    [
        'name' => 'Akuntansi dan Keuangan Lembaga (AKL)',
        'description' => 'Program keahlian yang melatih peserta didik menjadi profesional akuntansi dan keuangan dengan kompetensi di bidang administrasi keuangan dan perpajakan.',
        'content' => 'OVERVIEW:
Akuntansi dan Keuangan Lembaga (AKL) adalah program keahlian yang fokus mengembangkan kemampuan peserta didik dalam pembukuan, pelaporan keuangan, dan manajemen keuangan sesuai standar akuntansi internasional.

KOMPETENSI UTAMA:
- Akuntansi Dasar dan Lanjutan
- Perpajakan dan Pajak Penghasilan
- Audit dan Internal Control
- Financial Statement Analysis
- Cost Accounting
- Manajemen Keuangan
- Banking dan Keuangan Syariah
- Bookkeeping dan Jurnal Entry

KURIKULUM PEMBELAJARAN:
- Prinsip-prinsip Akuntansi
- Siklus Akuntansi Lengkap
- Perpajakan Indonesia (PPh, PPN, PPB)
- Sistem Pembukuan Digital
- Financial Reporting (PSAK/IFRS)
- Internal Audit
- Banking System
- Islamic Banking dan Finance
- Payroll Management
- Compliance dan Regulatory

FASILITAS:
- Lab Akuntansi dengan Software Komprehensif
- MYOB dan QuickBooks Lab
- SAP Software Training
- E-Filing System
- Calculator dan Adding Machine
- Project Banking Simulation
- Meeting Room untuk Case Study
- Perpustakaan Akuntansi Digital

PELUANG KARIR:
- Accounting Staff
- Bookkeeper Profesional
- Tax Officer
- Finance Officer
- Audit Assistant
- Banking Officer
- Payroll Administrator
- Credit Analyst
- Accounting Manager
- Berwiraswasta (Tax Consultant, Konsultan Keuangan)

PROSPEK KERJA:
Lulusan AKL SMKN 1 Garut sangat dibutuhkan oleh:
- Bank dan Lembaga Keuangan
- Asuransi dan Finance Company
- Perusahaan Manufaktur
- Retail dan Distributor
- Konsultan Tax dan Accounting
- Kantor Akuntan Publik
- Instansi Pemerintahan
- NGO dan Lembaga Sosial

SERTIFIKASI:
- Sertifikat Keahlian Akuntansi
- Sertifikasi Brevet A dan B (Pajak)
- Sertifikasi Accounting Software
- ACCA (Association of Chartered Certified Accountants)',
        'image' => 'https://via.placeholder.com/400x300?text=AKL'
    ],
    [
        'name' => 'Teknik Laboratorium Medis (TLM)',
        'description' => 'Program keahlian yang melatih peserta didik menjadi teknisi laboratorium medis profesional dengan kemampuan pemeriksaan sampel dan analisis hasil laboratorium.',
        'content' => 'OVERVIEW:
Teknik Laboratorium Medis (TLM) adalah program keahlian yang mempersiapkan tenaga kerja terampil dalam pemeriksaan laboratorium medis, urinalisis, hematologi, dan imunologi dengan standar ISO dan regulasi laboratorium.

KOMPETENSI UTAMA:
- Pemeriksaan Hematologi (Darah)
- Pemeriksaan Kimia Klinik
- Urinalisis dan Feses
- Pemeriksaan Imunologi dan Serologi
- Mikrobiologi Klinik
- Parasitologi
- Quality Control Laboratorium
- Keselamatan Kerja Laboratorium

KURIKULUM PEMBELAJARAN:
- Dasar-dasar Laboratorium Medis
- Flebotomi dan Specimen Handling
- Hematologi Klinik
- Kimia Klinik
- Urinalisis
- Feses dan Empedu
- Imunologi dan Serologi
- Mikrobiologi Klinik
- Quality Assurance Lab
- Biosafety dan Safety
- Informasi Lab dan Recording

FASILITAS:
- Laboratorium Medis Berstandar Internasional
- Alat Hematology Analyzer
- Biochemistry Analyzer
- Urinalysis Machine
- Microscope Professional Grade
- Centrifuge dan Spektrofotometer
- Peralatan Sterilisasi
- Cold Storage untuk Specimen
- Safety Equipment (Biosafety Cabinet)

PELUANG KARIR:
- Laboratorium Technician
- Phlebotomist
- Quality Control Lab
- Lab Supervisor
- Sales Representative (Medical Equipment)
- Product Development Specialist
- Public Health Officer
- Clinical Research Technician
- Hospital Lab Manager

PROSPEK KERJA:
Lulusan TLM SMKN 1 Garut sangat dibutuhkan oleh:
- Rumah Sakit dan Klinik
- Laboratorium Klinik Swasta
- Puskesmas dan Dinkes
- Blood Bank
- Laboratorium Farmasi
- Quality Control Industri
- Research Institute
- Health Laboratory Networks

SERTIFIKASI:
- Sertifikat Keahlian TLM
- Sertifikasi ISO 15189 (Medical Lab)
- Sertifikasi ELISA Technique
- Sertifikasi Infection Control',
        'image' => 'https://via.placeholder.com/400x300?text=TLM'
    ],
    [
        'name' => 'Desain Komunikasi Visual (DKV)',
        'description' => 'Program keahlian yang melatih peserta didik menjadi desainer grafis profesional dengan kemampuan mengcreate konten visual yang menarik dan efektif.',
        'content' => 'OVERVIEW:
Desain Komunikasi Visual (DKV) adalah program keahlian yang fokus mengembangkan kreativitas dan kemampuan teknis peserta didik dalam menciptakan desain grafis, animasi, dan konten visual modern untuk berbagai media.

KOMPETENSI UTAMA:
- Desain Grafis Professional
- Branding dan Corporate Identity
- Digital Photography dan Editing
- Motion Graphics dan Animasi
- UI/UX Design
- Web Design dan Development
- Video Production
- Content Creation untuk Media Sosial

KURIKULUM PEMBELAJARAN:
- Dasar-dasar Desain Komunikasi Visual
- Adobe Creative Suite (Photoshop, Illustrator, InDesign)
- Typography dan Layout Design
- Branding dan Logo Design
- Digital Photography
- Image Editing dan Manipulation
- Motion Graphics (After Effects)
- 3D Design Basics
- Video Editing (Premiere Pro, DaVinci Resolve)
- Web Design (UI/UX)
- Social Media Content Creation

FASILITAS:
- Design Studio dengan Komputer Spesifikasi Tinggi
- Adobe Creative Cloud License
- Professional Photography Equipment
- Studio Fotografi dan Lighting
- Video Production Equipment
- Green Screen Studio
- Printing Equipment
- Design Software Terlengkap
- Portfolio Development Station

PELUANG KARIR:
- Graphic Designer
- UI/UX Designer
- Motion Graphic Designer
- Video Editor dan Producer
- Photography Specialist
- Content Creator/Creator
- Branding Specialist
- Web Designer
- Creative Director
- Berwiraswasta (Design Agency, Freelance Designer)

PROSPEK KERJA:
Lulusan DKV SMKN 1 Garut sangat dibutuhkan oleh:
- Advertising Agency
- Design Agency dan Studio
- Media dan Broadcasting
- E-Commerce dan Startup
- Publishing Company
- Marketing Department Perusahaan
- Film Production House
- Creative Freelancer Platform (Upwork, Fiverr)
- Social Media Management Agency

SERTIFIKASI:
- Sertifikat Keahlian DKV
- Adobe Certified Associate
- Professional Photography Certificate
- Motion Graphics Designer Certificate
- UI/UX Design Certification',
        'image' => 'https://via.placeholder.com/400x300?text=DKV'
    ]
];

try {
    // Hapus data lama
    if ($conn->query("DELETE FROM majors") === TRUE) {
        echo "<div class='alert alert-info'>Data jurusan lama telah dihapus.</div>";
    }

    // Insert data baru dengan pengecekan duplikasi
    $inserted = 0;
    $duplicated = 0;
    
    foreach ($majors as $major) {
        $name = $conn->real_escape_string($major['name']);
        $description = $conn->real_escape_string($major['description']);
        $content = $conn->real_escape_string($major['content']);
        $image = $conn->real_escape_string($major['image']);

        // Check if major already exists by name (prevent duplicates)
        $check_sql = "SELECT id FROM majors WHERE name = '$name' LIMIT 1";
        $check_result = $conn->query($check_sql);
        
        if ($check_result && $check_result->num_rows > 0) {
            // Major already exists, skip insertion
            $duplicated++;
            continue;
        }

        $sql = "INSERT INTO majors (name, description, content, image) 
                VALUES ('$name', '$description', '$content', '$image')";

        if ($conn->query($sql) === TRUE) {
            $inserted++;
        }
    }

    echo "<div class='alert alert-success'>";
    echo "<h4>✓ Data Jurusan SMKN 1 Garut Berhasil Diperbarui!</h4>";
    echo "<p>Total jurusan yang ditambahkan: <strong>$inserted</strong>/10</p>";
    if ($duplicated > 0) {
        echo "<p class='text-warning'>Jurusan yang duplikat (tidak ditambahkan): <strong>$duplicated</strong></p>";
    }
    echo "<p><a href='jurusan.php' class='btn btn-primary mt-3'>Lihat Halaman Jurusan</a></p>";
    echo "</div>";

} catch (Exception $e) {
    echo "<div class='alert alert-danger'>";
    echo "<h4>Error: " . $e->getMessage() . "</h4>";
    echo "</div>";
}
?>
