<?php
// 404 Error Page
header("HTTP/1.0 404 Not Found");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #0d6efd 0%, #0055cc 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }
        .error-container {
            text-align: center;
        }
        .error-code {
            font-size: 8rem;
            font-weight: 900;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        .error-message {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }
        .btn-custom {
            background-color: white;
            color: #0d6efd;
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        .btn-custom:hover {
            background-color: #f8f9fa;
            transform: translateY(-3px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            color: #0d6efd;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-code">404</div>
        <h1 class="error-message">Halaman Tidak Ditemukan</h1>
        <p class="mb-4">Maaf, halaman yang Anda cari tidak ada atau telah dipindahkan.</p>
        <a href="index.php" class="btn-custom me-2">
            <i class="bi bi-house me-2"></i>Kembali ke Beranda
        </a>
        <a href="jurusan.php" class="btn-custom">
            <i class="bi bi-book me-2"></i>Lihat Jurusan
        </a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
