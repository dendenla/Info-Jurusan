<?php
$page_title = "Jurusan";
include 'includes/header.php';

// Get semua jurusan
$majors_query = $conn->query("SELECT * FROM majors ORDER BY name ASC");
?>

    <!-- Page Header -->
    <section class="py-5" style="background: linear-gradient(135deg, #0d6efd 0%, #0055cc 100%); color: white;">
        <div class="container-lg">
            <h1 class="display-4 fw-bold mb-3">Semua Jurusan</h1>
            <p class="lead">Temukan jurusan yang sesuai dengan minat dan bakatmu</p>
        </div>
    </section>

    <!-- Search & Filter Section -->
    <section class="py-4 bg-light border-bottom">
        <div class="container-lg">
            <div class="row g-3">
                <div class="col-md-6">
                    <input type="text" class="form-control form-control-lg" id="searchInput" placeholder="🔍 Cari jurusan...">
                </div>
            </div>
        </div>
    </section>

    <!-- Jurusan Cards Section -->
    <section class="py-5">
        <div class="container-lg">
            <div class="row g-4" id="jurusanContainer">
                <?php
                if ($majors_query->num_rows > 0) {
                    while ($major = $majors_query->fetch_assoc()) {
                        ?>
                        <div class="col-md-6 col-lg-4 jurusan-card" data-name="<?php echo strtolower(htmlspecialchars($major['name'])); ?>">
                            <div class="card border-0 shadow-sm h-100 card-hover position-relative">
                                <img src="<?php echo htmlspecialchars($major['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($major['name']); ?>" style="height: 200px; object-fit: cover;">
                                <?php if (!empty($major['logo']) && file_exists(__DIR__ . DIRECTORY_SEPARATOR . $major['logo'])): ?>
                                    <div style="position: absolute; top: 10px; right: 10px; background: white; border-radius: 8px; padding: 5px; box-shadow: 0 2px 8px rgba(0,0,0,0.15);">
                                        <img src="<?php echo htmlspecialchars($major['logo']); ?>" alt="Logo" style="height: 50px; width: auto; max-width: 50px;">
                                    </div>
                                <?php endif; ?>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title fw-bold text-primary mb-2"><?php echo htmlspecialchars($major['name']); ?></h5>
                                    <p class="card-text text-muted flex-grow-1" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                        <?php echo htmlspecialchars($major['description']); ?>
                                    </p>
                                    <a href="detail.php?id=<?php echo $major['id']; ?>" class="btn btn-primary btn-sm mt-3">
                                        Detail Lengkap <i class="bi bi-arrow-right ms-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo '<div class="col-12"><p class="text-center text-muted py-5">Data jurusan belum tersedia</p></div>';
                }
                ?>
            </div>
            <div id="noResults" class="text-center py-5" style="display:none;">
                <i class="bi bi-search" style="font-size: 3rem; color: #ccc;"></i>
                <p class="text-muted mt-3">Tidak ada jurusan yang cocok dengan pencarian Anda</p>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-light">
        <div class="container-lg">
            <div class="card border-0 shadow-sm bg-primary text-white">
                <div class="card-body p-5 text-center">
                    <h3 class="card-title mb-3">Tertarik dengan Salah Satu Jurusan?</h3>
                    <p class="card-text mb-4">Daftar sekarang dan bergabunglah dengan ribuan siswa kami yang sukses</p>
                    <a href="kontak.php" class="btn btn-light btn-lg fw-bold">Hubungi Kami</a>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            const cards = document.querySelectorAll('.jurusan-card');
            let visibleCount = 0;

            cards.forEach(card => {
                const name = card.dataset.name;
                if (name.includes(searchTerm)) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            document.getElementById('noResults').style.display = visibleCount === 0 ? 'block' : 'none';
        });
    </script>

<?php
include 'includes/footer.php';
?>
