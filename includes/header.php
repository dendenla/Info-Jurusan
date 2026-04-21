<?php
// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Include database configuration
require_once dirname(__DIR__) . '/config/database.php';
require_once dirname(__DIR__) . '/config/auth.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' - SMKN 1 Garut' : 'SMKN 1 Garut'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/toast.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container-lg">
            <a class="navbar-brand fw-bold" href="index.php">
                <i class="bi bi-mortarboard"></i> SMKN 1 Garut
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="jurusan.php">Jurusan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="forum.php">Forum</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="lokasi.php">Lokasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kontak.php">Kontak</a>
                    </li>
                    <li class="nav-item dropdown">
                        <?php if (isLoggedIn()): ?>
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i><?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <?php if (isAdmin()): ?>
                                    <li>
                                        <a class="dropdown-item" href="admin.php">
                                            <i class="bi bi-gear me-2"></i>Admin Panel
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                <?php endif; ?>
                                <li>
                                    <a class="dropdown-item" href="login.php?logout=1">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </a>
                                </li>
                            </ul>
                        <?php else: ?>
                            <a class="nav-link dropdown-toggle" href="#" id="loginDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-box-arrow-in-right me-1"></i>Login
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="loginDropdown">
                                <li>
                                    <a class="dropdown-item" href="login.php?type=user">
                                        <i class="bi bi-person me-2"></i>Login User
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="login.php?type=admin">
                                        <i class="bi bi-shield-lock me-2"></i>Login Admin
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="register.php">
                                        <i class="bi bi-person-plus me-2"></i>Daftar Akun Baru
                                    </a>
                                </li>
                            </ul>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
