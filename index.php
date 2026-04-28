<?php
$page_title = "Beranda";
include 'includes/header.php';

// Get total majors count
$total_result = $conn->query("SELECT COUNT(*) as count FROM majors");
$total_row = $total_result->fetch_assoc();
$total_majors = $total_row['count'];

// Get majors untuk preview
$majors_query = $conn->query("SELECT * FROM majors LIMIT 6");
?>

    <!-- Hero Section -->
    <section class="hero-section py-5" style="background: linear-gradient(135deg, #0d6efd 0%, #0055cc 100%); color: white;">
        <div class="container-lg py-5">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h1 class="display-4 fw-bold mb-3">Selamat Datang di SMKN 1 Garut</h1>
                    <p class="lead mb-4">Penyelenggara pendidikan vokasi terdepan dalam mengembangkan Sumber Daya Manusia yang berkualitas, profesional, dan siap menghadapi tantangan industri modern.</p>
                    <div class="d-flex gap-3">
                        <a href="jurusan.php" class="btn btn-light btn-lg fw-bold">
                            <i class="bi bi-book me-2"></i>Lihat Jurusan
                        </a>
                        <a href="forum.php" class="btn btn-outline-light btn-lg fw-bold">
                            <i class="bi bi-chat-dots me-2"></i>Forum
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="https://via.placeholder.com/500x400?text=Gedung+Sekolah" class="img-fluid rounded-3 shadow-lg" alt="Sekolah">
                </div>
            </div>
        </div>
    </section>

    <!-- Statistik Section -->
    <section class="py-5 bg-light">
        <div class="container-lg">
            <div class="row text-center g-4">
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body py-4">
                            <h2 class="text-primary fw-bold mb-2"><?php echo $total_majors; ?></h2>
                            <p class="text-muted mb-0">Jurusan</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body py-4">
                            <h2 class="text-primary fw-bold mb-2">1800+</h2>
                            <p class="text-muted mb-0">Siswa Aktif</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body py-4">
                            <h2 class="text-primary fw-bold mb-2">120+</h2>
                            <p class="text-muted mb-0">Tenaga Pendidik</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body py-4">
                            <h2 class="text-primary fw-bold mb-2">95%</h2>
                            <p class="text-muted mb-0">Lulusan Terserap</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Preview Jurusan Section -->
    <section class="py-5">
        <div class="container-lg">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">Jelajahi Jurusan Kami</h2>
                <p class="text-muted lead">Pilih bidang studi yang sesuai dengan minat dan potensimu</p>
            </div>

            <div class="row g-4 mb-5">
                <?php
                if ($majors_query->num_rows > 0) {
                    while ($major = $majors_query->fetch_assoc()) {
                        ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="card border-0 shadow-sm h-100 card-hover position-relative">
                                <img src="<?php echo htmlspecialchars($major['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($major['name']); ?>" style="height: 200px; object-fit: cover;">
                                <?php if (!empty($major['logo']) && file_exists($major['logo'])): ?>
                                    <div style="position: absolute; top: 10px; right: 10px; background: white; border-radius: 8px; padding: 5px; box-shadow: 0 2px 8px rgba(0,0,0,0.15);">
                                        <img src="<?php echo htmlspecialchars($major['logo']); ?>" alt="Logo" style="height: 50px; width: auto; max-width: 50px;">
                                    </div>
                                <?php endif; ?>
                                <div class="card-body">
                                    <h5 class="card-title fw-bold text-primary"><?php echo htmlspecialchars($major['name']); ?></h5>
                                    <p class="card-text text-muted text-truncate"><?php echo htmlspecialchars($major['description']); ?></p>
                                    <a href="detail.php?id=<?php echo $major['id']; ?>" class="btn btn-primary btn-sm">
                                        Selengkapnya <i class="bi bi-arrow-right ms-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo '<div class="col-12"><p class="text-center text-muted">Data jurusan belum tersedia</p></div>';
                }
                ?>
            </div>

            <div class="text-center">
                <a href="jurusan.php" class="btn btn-primary btn-lg">
                    Lihat Semua Jurusan <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Testimoni Section -->
    <section class="py-5 bg-light">
        <div class="container-lg">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">Testimoni Siswa</h2>
                <p class="text-muted lead">Dengarkan pengalaman mereka</p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="mb-3">
                                <span class="text-warning">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </span>
                            </div>
                            <p class="card-text">"SMKN 1 Garut memberikan pendidikan berkualitas dan membentuk kami menjadi profesional siap kerja. Guru-guru sangat supportif!"</p>
                            <p class="fw-bold mb-0">Adi Sutrisno</p>
                            <small class="text-muted">RPL Angkatan 2022</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="mb-3">
                                <span class="text-warning">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </span>
                            </div>
                            <p class="card-text">"Fasilitas lengkap dan kurikulum relevan dengan industri. Saya sudah bekerja di perusahaan IT ternama setelah lulus!"</p>
                            <p class="fw-bold mb-0">Siti Nurhaliza</p>
                            <small class="text-muted">TKJ Angkatan 2021</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="mb-3">
                                <span class="text-warning">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </span>
                            </div>
                            <p class="card-text">"Program magang yang bagus membuat kami mendapatkan pengalaman praktis. Sangat membantu dalam melamar kerja!"</p>
                            <p class="fw-bold mb-0">Budi Santoso</p>
                            <small class="text-muted">AKL Angkatan 2022</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
include 'includes/footer.php';
?>
