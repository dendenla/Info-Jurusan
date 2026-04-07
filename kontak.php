<?php
$page_title = "Kontak";
include 'includes/header.php';

$success_message = '';
$error_message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // Validasi
    if (empty($name) || empty($email) || empty($message)) {
        $error_message = "Semua field harus diisi!";
    } elseif (strlen($name) > 100 || strlen($email) > 100 || strlen($message) > 1000) {
        $error_message = "Input terlalu panjang!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Email tidak valid!";
    } else {
        // Escape input
        $name = mysqli_real_escape_string($conn, $name);
        $email = mysqli_real_escape_string($conn, $email);
        $message = mysqli_real_escape_string($conn, $message);

        // Insert ke database
        $sql = "INSERT INTO messages (name, email, message, created_at) VALUES ('$name', '$email', '$message', NOW())";
        
        if ($conn->query($sql) === TRUE) {
            $success_message = "Terima kasih! Pesan Anda telah dikirim. Kami akan segera membalasnya.";
            $_POST = array(); // Clear form
        } else {
            $error_message = "Gagal mengirim pesan. Silakan coba lagi.";
        }
    }
}
?>

    <!-- Page Header -->
    <section class="py-5" style="background: linear-gradient(135deg, #0d6efd 0%, #0055cc 100%); color: white;">
        <div class="container-lg">
            <h1 class="display-4 fw-bold mb-3">Hubungi Kami</h1>
            <p class="lead">Kami siap membantu Anda. Hubungi kami melalui formulir di bawah atau informasi kontak yang tersedia</p>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-5">
        <div class="container-lg">
            <div class="row g-5">
                <!-- Contact Form -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-4">Kirim Pesan</h5>

                            <?php if ($success_message): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="bi bi-check-circle me-2"></i><?php echo $success_message; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            <?php endif; ?>

                            <?php if ($error_message): ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="bi bi-exclamation-circle me-2"></i><?php echo $error_message; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            <?php endif; ?>

                            <form method="POST">
                                <div class="mb-3">
                                    <label for="contactName" class="form-label fw-bold">Nama <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" id="contactName" name="name" placeholder="Masukkan nama Anda" required value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>">
                                </div>

                                <div class="mb-3">
                                    <label for="contactEmail" class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control form-control-lg" id="contactEmail" name="email" placeholder="Masukkan email Anda" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                                </div>

                                <div class="mb-3">
                                    <label for="contactMessage" class="form-label fw-bold">Pesan <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="contactMessage" name="message" rows="6" placeholder="Tuliskan pesan Anda..." required><?php echo htmlspecialchars($_POST['message'] ?? ''); ?></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary btn-lg fw-bold">
                                    <i class="bi bi-send me-2"></i>Kirim Pesan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="col-lg-4">
                    <!-- Info Card -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-4">Informasi Kontak</h5>

                            <div class="mb-4">
                                <h6 class="fw-bold text-primary mb-2">
                                    <i class="bi bi-telephone me-2"></i>Telepon
                                </h6>
                                <p class="mb-0">
                                    <a href="tel:0262-1234567" class="text-decoration-none">(0262) 1234567</a>
                                </p>
                            </div>

                            <div class="mb-4">
                                <h6 class="fw-bold text-primary mb-2">
                                    <i class="bi bi-envelope me-2"></i>Email
                                </h6>
                                <p class="mb-0">
                                    <a href="mailto:info@smkn1garut.sch.id" class="text-decoration-none">info@smkn1garut.sch.id</a>
                                </p>
                            </div>

                            <div class="mb-4">
                                <h6 class="fw-bold text-primary mb-2">
                                    <i class="bi bi-geo-alt me-2"></i>Alamat
                                </h6>
                                <p class="mb-0">Jln. Jendral Sudirman No.123<br>Garut 44128<br>Jawa Barat</p>
                            </div>

                            <div class="mb-4">
                                <h6 class="fw-bold text-primary mb-2">
                                    <i class="bi bi-clock me-2"></i>Jam Operasional
                                </h6>
                                <p class="mb-1">Senin - Jumat: 07.00 - 15.30 WIB</p>
                                <p class="mb-0">Sabtu: Tutup</p>
                            </div>
                        </div>
                    </div>

                    <!-- Social Media -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-3">Ikuti Kami</h5>
                            <div class="d-flex gap-2">
                                <a href="#" class="btn btn-outline-primary btn-sm rounded-circle">
                                    <i class="bi bi-facebook"></i>
                                </a>
                                <a href="#" class="btn btn-outline-info btn-sm rounded-circle">
                                    <i class="bi bi-twitter"></i>
                                </a>
                                <a href="#" class="btn btn-outline-danger btn-sm rounded-circle">
                                    <i class="bi bi-instagram"></i>
                                </a>
                                <a href="#" class="btn btn-outline-dark btn-sm rounded-circle">
                                    <i class="bi bi-youtube"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
include 'includes/footer.php';
?>
