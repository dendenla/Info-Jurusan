<?php
session_start();
include 'config/database.php';
include 'config/auth.php';
include 'config/email.php';

// Jika sudah login, arahkan ke dashboard
if (isLoggedIn()) {
    header('Location: index.php');
    exit;
}

$register_error = '';
$register_success = '';

// Handle register
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'register') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';
    
    if ($password !== $password_confirm) {
        $register_error = 'Password tidak cocok!';
    } else {
        $result = registerUser($conn, $username, $email, $password);
        if ($result['success']) {
            // Send registration confirmation email (don't block registration if email fails)
            try {
                sendRegistrationConfirmation($username, $email);
            } catch (Exception $e) {
                // Log error but don't show to user - registration is successful
                error_log("Email sending failed for user $username: " . $e->getMessage());
            }
            
            $register_success = $result['message'];
        } else {
            $register_error = $result['message'];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - SMKN 1 Garut</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            background: linear-gradient(135deg, #0d6efd 0%, #0055cc 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .register-container {
            width: 100%;
            max-width: 450px;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }
        .card-header {
            background: linear-gradient(135deg, #0d6efd 0%, #0055cc 100%);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 30px;
            text-align: center;
        }
        .card-header h2 {
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0;
        }
        .form-control {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 0.95rem;
        }
        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }
        .btn-register {
            background: linear-gradient(135deg, #0d6efd 0%, #0055cc 100%);
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            font-size: 1rem;
        }
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(13, 110, 253, 0.4);
        }
        .login-link {
            text-align: center;
            margin-top: 20px;
        }
        .login-link a {
            color: #0d6efd;
            text-decoration: none;
            font-weight: 600;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
        .home-link {
            text-align: center;
            margin-bottom: 20px;
        }
        .home-link a {
            color: white;
            text-decoration: none;
            font-size: 0.9rem;
            opacity: 0.9;
        }
        .home-link a:hover {
            opacity: 1;
        }
        .password-requirements {
            background: #f8f9fa;
            border-left: 4px solid #0d6efd;
            padding: 12px;
            border-radius: 5px;
            margin-top: 15px;
            font-size: 0.85rem;
        }
        .password-requirements ul {
            margin: 0;
            padding-left: 20px;
        }
        .password-requirements li {
            margin: 3px 0;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="home-link">
            <a href="index.php">
                <i class="bi bi-house me-2"></i>Kembali ke Beranda
            </a>
        </div>

        <div class="card">
            <div class="card-header">
                <h2>
                    <i class="bi bi-person-plus me-2"></i>Daftar Akun
                </h2>
                <p class="mb-0 mt-2" style="opacity: 0.9; font-size: 0.9rem;">Buat akun untuk akses admin panel</p>
            </div>

            <div class="card-body p-4">
                <?php if ($register_error): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-circle me-2"></i><?php echo $register_error; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if ($register_success): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i><?php echo $register_success; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <p class="text-center text-muted mb-3">Silakan <a href="login.php" class="fw-bold" style="color: #0d6efd;">login di sini</a></p>
                <?php else: ?>
                    <form method="POST">
                        <input type="hidden" name="action" value="register">

                        <div class="mb-3">
                            <label for="username" class="form-label fw-bold">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required minlength="3">
                            <small class="text-muted">Minimal 3 karakter</small>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required minlength="6">
                        </div>

                        <div class="mb-3">
                            <label for="password_confirm" class="form-label fw-bold">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Ulangi password" required minlength="6">
                        </div>

                        <div class="password-requirements">
                            <strong>Syarat Password:</strong>
                            <ul>
                                <li>Minimal 6 karakter</li>
                                <li>Password dan konfirmasi harus cocok</li>
                            </ul>
                        </div>

                        <button type="submit" class="btn btn-register btn-primary w-100 mt-4">
                            <i class="bi bi-person-check me-2"></i>Daftar
                        </button>
                    </form>

                    <div class="login-link">
                        Sudah punya akun? <a href="login.php">Login di sini</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
