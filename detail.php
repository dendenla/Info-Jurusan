<?php
$page_title = "Detail Jurusan";
include 'includes/header.php';

// Validasi dan ambil ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: jurusan.php");
    exit;
}

$id = intval($_GET['id']);
$major_query = $conn->query("SELECT * FROM majors WHERE id = $id");

if ($major_query->num_rows == 0) {
    header("Location: jurusan.php");
    exit;
}

$major = $major_query->fetch_assoc();
?>

    <!-- Page Header -->
    <section class="py-4" style="background: linear-gradient(135deg, #0d6efd 0%, #0055cc 100%); color: white;">
        <div class="container-lg">
            <a href="jurusan.php" class="btn btn-light btn-sm mb-3">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <h1 class="display-4 fw-bold"><?php echo htmlspecialchars($major['name']); ?></h1>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-5">
        <div class="container-lg">
            <div class="row g-5">
                <div class="col-lg-8">
                    <!-- Gambar -->
                    <img src="<?php echo htmlspecialchars($major['image']); ?>" class="img-fluid rounded-3 shadow mb-5" alt="<?php echo htmlspecialchars($major['name']); ?>" style="max-height: 400px; object-fit: cover; width: 100%;">

                    <!-- Deskripsi Utama -->
                    <div class="mb-5">
                        <h3 class="fw-bold mb-3">Tentang Jurusan</h3>
                        <p class="text-muted lead"><?php echo nl2br(htmlspecialchars($major['description'])); ?></p>
                    </div>

                    <!-- Content -->
                    <div class="mb-5">
                        <h3 class="fw-bold mb-3">Kurikulum & Materi</h3>
                        <p class="text-muted"><?php echo nl2br(htmlspecialchars($major['content'])); ?></p>
                    </div>

                    <!-- Prospek Kerja -->
                    <div class="card border-0 bg-light mb-5">
                        <div class="card-body p-4">
                            <h4 class="card-title fw-bold mb-3">
                                <i class="bi bi-briefcase text-primary me-2"></i>Prospek Kerja
                            </h4>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Tenaga IT Professional di perusahaan teknologi</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Sistem Administrator</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Network Engineer</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Webmaster</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Entrepreneur di bidang teknologi</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Info Card -->
                    <div class="card border-0 shadow-sm sticky-top" style="top: 80px;">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-4">Informasi Jurusan</h5>
                            
                            <div class="mb-4">
                                <small class="text-muted d-block mb-2">Durasi Studi</small>
                                <h6 class="fw-bold">3 Tahun</h6>
                            </div>

                            <div class="mb-4">
                                <small class="text-muted d-block mb-2">Jenjang Pendidikan</small>
                                <h6 class="fw-bold">Sekolah Menengah Kejuruan</h6>
                            </div>

                            <div class="mb-4">
                                <small class="text-muted d-block mb-2">Status Akreditasi</small>
                                <span class="badge bg-success">A (Terakreditasi)</span>
                            </div>

                            <div class="mb-4">
                                <small class="text-muted d-block mb-2">Kapasitas Siswa</small>
                                <h6 class="fw-bold">120 - 150 Siswa/Tahun</h6>
                            </div>

                            <hr>

                            <a href="kontak.php" class="btn btn-primary w-100 mb-2">
                                <i class="bi bi-send me-2"></i>Hubungi Kami
                            </a>
                            <a href="lokasi.php" class="btn btn-outline-primary w-100">
                                <i class="bi bi-geo-alt me-2"></i>Lokasi Sekolah
                            </a>
                        </div>
                    </div>

                    <!-- Keunggulan -->
                    <div class="card border-0 shadow-sm mt-4">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-3">Keunggulan</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="bi bi-star-fill text-warning me-2"></i>Kurikulum relevan industri</li>
                                <li class="mb-2"><i class="bi bi-star-fill text-warning me-2"></i>Fasilitas modern</li>
                                <li class="mb-2"><i class="bi bi-star-fill text-warning me-2"></i>Guru bersertifikat</li>
                                <li class="mb-2"><i class="bi bi-star-fill text-warning me-2"></i>Peluang magang</li>
                                <li><i class="bi bi-star-fill text-warning me-2"></i>Alumni sukses</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Majors -->
    <section class="py-5 bg-light">
        <div class="container-lg">
            <h3 class="fw-bold mb-4">Jurusan Lainnya</h3>
            <div class="row g-4">
                <?php
                $related_query = $conn->query("SELECT * FROM majors WHERE id != $id LIMIT 3");
                if ($related_query->num_rows > 0) {
                    while ($rel_major = $related_query->fetch_assoc()) {
                        ?>
                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm card-hover">
                                <img src="<?php echo htmlspecialchars($rel_major['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($rel_major['name']); ?>" style="height: 150px; object-fit: cover;">
                                <div class="card-body">
                                    <h6 class="card-title fw-bold text-primary"><?php echo htmlspecialchars($rel_major['name']); ?></h6>
                                    <a href="detail.php?id=<?php echo $rel_major['id']; ?>" class="btn btn-outline-primary btn-sm">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </section>

<?php
include 'includes/footer.php';
?>
