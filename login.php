<?php
session_start();
include 'config/database.php';
include 'config/auth.php';

// Handle logout
if (isset($_GET['logout'])) {
    logout();
    // Redirect dengan pesan berhasil logout
    header('Location: login.php?msg=logout_success');
    exit;
}

// Jika sudah login, arahkan ke dashboard
if (isLoggedIn()) {
    if (isAdmin()) {
        header('Location: admin.php');
    } else {
        header('Location: index.php');
    }
    exit;
}

// Tentukan tipe login dari parameter
$login_type = $_GET['type'] ?? 'admin'; // default admin
$is_admin_login = ($login_type === 'admin');
$page_title = $is_admin_login ? 'Admin Panel' : 'User Login';
$subtitle = $is_admin_login ? 'Masuk ke Admin Panel' : 'Masuk ke Akun Anda';
$icon = $is_admin_login ? 'bi-shield-lock' : 'bi-person-circle';

$login_error = '';

// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'login') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    $result = loginUser($conn, $username, $password);
    
    if ($result['success']) {
        $_SESSION['user_id'] = $result['user_id'];
        $_SESSION['username'] = $result['username'];
        
        // Set role dari database
        setAdminAccess($result['user_id'], $result['role']);
        
        // Redirect ke halaman yang sesuai
        if ($result['role'] === 'admin') {
            header('Location: admin.php');
        } else {
            header('Location: index.php');
        }
        exit;
    } else {
        $login_error = $result['message'];
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SMKN 1 Garut</title>
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
        .login-container {
            width: 100%;
            max-width: 400px;
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
        .btn-login {
            background: linear-gradient(135deg, #0d6efd 0%, #0055cc 100%);
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            font-size: 1rem;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(13, 110, 253, 0.4);
        }
        .register-link {
            text-align: center;
            margin-top: 20px;
        }
        .register-link a {
            color: #0d6efd;
            text-decoration: none;
            font-weight: 600;
        }
        .register-link a:hover {
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
        .remember-me {
            font-size: 0.9rem;
        }
        .login-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }
        .login-tab-btn {
            flex: 1;
            padding: 10px;
            border: 2px solid #ddd;
            background: white;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
            text-decoration: none;
            color: #333;
            font-size: 0.9rem;
        }
        .login-tab-btn.active {
            border-color: #0d6efd;
            background: #0d6efd;
            color: white;
        }
        .login-tab-btn:hover {
            border-color: #0d6efd;
            color: #0d6efd;
        }
        .login-tab-btn.active:hover {
            color: white;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="home-link">
            <a href="index.php">
                <i class="bi bi-house me-2"></i>Kembali ke Beranda
            </a>
        </div>

        <div class="card">
            <div class="card-header">
                <h2>
                    <i class="bi <?php echo $icon; ?> me-2"></i><?php echo $page_title; ?>
                </h2>
                <p class="mb-0 mt-2" style="opacity: 0.9; font-size: 0.9rem;"><?php echo $subtitle; ?></p>
            </div>

            <div class="card-body p-4">
                <!-- Login Type Tabs -->
                <div class="login-tabs">
                    <a href="?type=admin" class="login-tab-btn <?php echo $is_admin_login ? 'active' : ''; ?>">
                        <i class="bi bi-shield-lock me-1"></i>Admin
                    </a>
                    <a href="?type=user" class="login-tab-btn <?php echo !$is_admin_login ? 'active' : ''; ?>">
                        <i class="bi bi-person me-1"></i>User
                    </a>
                </div>

                <?php if (isset($_GET['msg']) && $_GET['msg'] === 'logout_success'): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i>Anda berhasil logout
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>
                <?php if ($login_error): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-circle me-2"></i><?php echo $login_error; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <form method="POST">
                    <input type="hidden" name="action" value="login">

                    <div class="mb-3">
                        <label for="username" class="form-label fw-bold">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-bold">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                    </div>

                    <div class="mb-3 form-check remember-me">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">
                            Ingat saya
                        </label>
                    </div>

                    <button type="submit" class="btn btn-login btn-primary w-100">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Login
                    </button>
                </form>

                <?php if (!$is_admin_login): ?>
                    <div class="register-link">
                        Belum punya akun? <a href="register.php">Daftar di sini</a>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info mb-0 mt-3" style="font-size: 0.85rem;">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>Admin:</strong> Login dengan akun admin yang sudah terdaftar.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
