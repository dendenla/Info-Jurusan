<?php
// admin.php - Admin Panel Lengkap
session_start();
include 'config/database.php';

$ADMIN_PASSWORD = "admin123"; // ⚠️ GANTI INI DENGAN PASSWORD ANDA

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: admin.php');
    exit;
}

// Handle login
$login_error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
    $input_password = $_POST['password'] ?? '';
    
    if ($input_password === $ADMIN_PASSWORD) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_login_time'] = time();
        $login_error = '';
    } else {
        $login_error = 'Password salah! Silakan coba lagi.';
        $_SESSION['admin_logged_in'] = false;
    }
}

// Check if already logged in
$is_logged_in = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;

// Get page/tab yang aktif
$page = $_GET['page'] ?? 'dashboard';

// Handle delete post
if ($is_logged_in && isset($_GET['delete_post'])) {
    $post_id = intval($_GET['delete_post']);
    $sql = "DELETE FROM posts WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $stmt->close();
    header('Location: admin.php?page=posts&deleted=1');
    exit;
}

// Handle delete major
if ($is_logged_in && isset($_GET['delete_major'])) {
    $major_id = intval($_GET['delete_major']);
    $sql = "DELETE FROM majors WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $major_id);
    $stmt->execute();
    $stmt->close();
    header('Location: admin.php?page=majors&deleted=1');
    exit;
}

// Handle delete message
if ($is_logged_in && isset($_GET['delete_message'])) {
    $msg_id = intval($_GET['delete_message']);
    $sql = "DELETE FROM messages WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $msg_id);
    $stmt->execute();
    $stmt->close();
    header('Location: admin.php?page=messages&deleted=1');
    exit;
}

// Handle add/edit major
$major_form_error = '';
$major_form_success = '';
if ($is_logged_in && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'save_major') {
    $major_id = intval($_POST['major_id'] ?? 0);
    $name = trim($_POST['major_name'] ?? '');
    $description = trim($_POST['major_description'] ?? '');
    $content = trim($_POST['major_content'] ?? '');
    $image = trim($_POST['major_image'] ?? '');
    
    if (empty($name) || empty($description) || empty($content)) {
        $major_form_error = 'Semua field harus diisi!';
    } else {
        if ($major_id > 0) {
            // Update
            $sql = "UPDATE majors SET name = ?, description = ?, content = ?, image = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssi", $name, $description, $content, $image, $major_id);
        } else {
            // Insert
            $sql = "INSERT INTO majors (name, description, content, image) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $name, $description, $content, $image);
        }
        
        if ($stmt->execute()) {
            $major_form_success = $major_id > 0 ? 'Jurusan berhasil diupdate!' : 'Jurusan berhasil ditambahkan!';
            $_POST = array();
        } else {
            $major_form_error = 'Gagal menyimpan jurusan!';
        }
        $stmt->close();
    }
}

// Get edit major data
$edit_major = null;
if ($is_logged_in && isset($_GET['edit_major'])) {
    $major_id = intval($_GET['edit_major']);
    $result = $conn->query("SELECT * FROM majors WHERE id = $major_id");
    if ($result->num_rows > 0) {
        $edit_major = $result->fetch_assoc();
    }
}

// Get statistics
$total_majors = $conn->query("SELECT COUNT(*) as total FROM majors")->fetch_assoc()['total'];
$total_posts = $conn->query("SELECT COUNT(*) as total FROM posts")->fetch_assoc()['total'];
$total_messages = $conn->query("SELECT COUNT(*) as total FROM messages")->fetch_assoc()['total'];
$total_likes = $conn->query("SELECT SUM(likes) as total FROM posts")->fetch_assoc()['total'] ?? 0;

// Get all data
$posts = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
$majors = $conn->query("SELECT * FROM majors ORDER BY created_at DESC");
$messages = $conn->query("SELECT * FROM messages ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - SMKN 1 Garut</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar-admin {
            background: linear-gradient(135deg, #0d6efd 0%, #0055cc 100%) !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .sidebar {
            background: white;
            min-height: 100vh;
            border-right: 1px solid #e9ecef;
            position: sticky;
            top: 0;
        }
        .sidebar .nav-link {
            color: #333 !important;
            border-left: 3px solid transparent;
            margin-bottom: 5px;
            transition: all 0.3s ease;
            font-weight: 500;
            opacity: 1 !important;
            display: flex;
            align-items: center;
        }
        .sidebar .nav-link i {
            color: #666 !important;
            opacity: 1 !important;
        }
        .sidebar .nav-link:hover {
            color: #0d6efd !important;
            background-color: #f0f6ff;
            border-left-color: #0d6efd;
            padding-left: calc(1rem + 3px) !important;
            opacity: 1 !important;
        }
        .sidebar .nav-link:hover i {
            color: #0d6efd !important;
            opacity: 1 !important;
        }
        .sidebar .nav-link.active {
            color: #0d6efd !important;
            background-color: #f0f6ff;
            border-left-color: #0d6efd;
            padding-left: calc(1rem + 3px) !important;
            font-weight: 700;
            opacity: 1 !important;
        }
        .sidebar .nav-link.active i {
            color: #0d6efd !important;
            opacity: 1 !important;
        }
        .content-area {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 30px;
            margin-bottom: 30px;
        }
        .stat-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }
        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
        }
        .table-hover tbody tr:hover {
            background-color: #f8f9ff !important;
        }
        .btn-action {
            padding: 5px 10px;
            font-size: 0.85rem;
        }
        .modal-header {
            background: linear-gradient(135deg, #0d6efd 0%, #0055cc 100%);
            color: white;
        }
        .modal-header .btn-close {
            filter: brightness(0) invert(1);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-admin sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">
                <i class="bi bi-shield-lock me-2"></i>Admin Panel - SMKN 1 Garut
            </a>
            <?php if ($is_logged_in): ?>
                <div class="ms-auto d-flex gap-2 align-items-center">
                    <span class="text-white">
                        <i class="bi bi-person-circle me-2"></i>Admin
                    </span>
                    <a href="?logout=1" class="btn btn-outline-light btn-sm">
                        <i class="bi bi-box-arrow-right me-1"></i>Logout
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </nav>

    <?php if (!$is_logged_in): ?>
        <!-- Login Page -->
        <div class="container py-5">
            <div class="row justify-content-center" style="min-height: 80vh; display: flex; align-items: center;">
                <div class="col-md-4">
                    <div class="card border-0 shadow-lg">
                        <div class="card-body p-5">
                            <h3 class="card-title fw-bold mb-4 text-center">
                                <i class="bi bi-lock-fill text-primary me-2"></i>Admin Login
                            </h3>
                            
                            <?php if ($login_error): ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="bi bi-exclamation-circle me-2"></i><?php echo $login_error; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            <?php endif; ?>

                            <form method="POST">
                                <div class="mb-3">
                                    <label for="password" class="form-label fw-bold">Password Admin</label>
                                    <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Masukkan password" required autofocus>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 fw-bold py-2">
                                    <i class="bi bi-lock-fill me-2"></i>Login
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <!-- Admin Panel -->
        <div class="container-fluid py-4">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-lg-2">
                    <div class="sidebar p-3">
                        <h5 class="fw-bold mb-4 text-dark" style="color: #222 !important;">
                            <i class="bi bi-list" style="color: #0d6efd;"></i> Menu
                        </h5>
                        <nav class="nav flex-column">
                            <a class="nav-link <?php echo $page === 'dashboard' ? 'active' : ''; ?>" href="?page=dashboard">
                                <i class="bi bi-speedometer2 me-2"></i>Dashboard
                            </a>
                            <a class="nav-link <?php echo $page === 'posts' ? 'active' : ''; ?>" href="?page=posts">
                                <i class="bi bi-chat-dots me-2"></i>Kelola Posts (<?php echo $total_posts; ?>)
                            </a>
                            <a class="nav-link <?php echo $page === 'majors' ? 'active' : ''; ?>" href="?page=majors">
                                <i class="bi bi-book me-2"></i>Kelola Jurusan (<?php echo $total_majors; ?>)
                            </a>
                            <a class="nav-link <?php echo $page === 'messages' ? 'active' : ''; ?>" href="?page=messages">
                                <i class="bi bi-envelope me-2"></i>Pesan Kontak (<?php echo $total_messages; ?>)
                            </a>
                        </nav>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="col-lg-10">
                    <!-- Dashboard -->
                    <?php if ($page === 'dashboard'): ?>
                        <div class="content-area">
                            <h2 class="fw-bold mb-4">
                                <i class="bi bi-speedometer2 text-primary me-2"></i>Dashboard
                            </h2>

                            <!-- Statistics Cards -->
                            <div class="row g-4 mb-4">
                                <div class="col-md-6 col-xl-3">
                                    <div class="card stat-card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <p class="text-muted small mb-1">Total Jurusan</p>
                                                    <h3 class="stat-number text-primary"><?php echo $total_majors; ?></h3>
                                                </div>
                                                <i class="bi bi-book-fill text-primary" style="font-size: 2rem;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-3">
                                    <div class="card stat-card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <p class="text-muted small mb-1">Total Post Forum</p>
                                                    <h3 class="stat-number text-success"><?php echo $total_posts; ?></h3>
                                                </div>
                                                <i class="bi bi-chat-dots-fill text-success" style="font-size: 2rem;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-3">
                                    <div class="card stat-card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <p class="text-muted small mb-1">Pesan Kontak</p>
                                                    <h3 class="stat-number text-warning"><?php echo $total_messages; ?></h3>
                                                </div>
                                                <i class="bi bi-envelope-fill text-warning" style="font-size: 2rem;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-3">
                                    <div class="card stat-card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <p class="text-muted small mb-1">Total Like</p>
                                                    <h3 class="stat-number text-danger"><?php echo $total_likes; ?></h3>
                                                </div>
                                                <i class="bi bi-hand-thumbs-up-fill text-danger" style="font-size: 2rem;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Quick Actions -->
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-header bg-light border-0">
                                            <h5 class="mb-0 fw-bold">
                                                <i class="bi bi-chat-dots me-2 text-success"></i>Post Forum Terbaru
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <?php
                                            $recent_posts = $conn->query("SELECT * FROM posts ORDER BY created_at DESC LIMIT 5");
                                            if ($recent_posts->num_rows > 0) {
                                                while ($post = $recent_posts->fetch_assoc()) {
                                                    ?>
                                                    <div class="mb-3 pb-3 border-bottom">
                                                        <strong class="d-block"><?php echo htmlspecialchars($post['name']); ?></strong>
                                                        <small class="text-muted"><?php echo substr(htmlspecialchars($post['message']), 0, 50) . '...'; ?></small>
                                                        <br>
                                                        <small class="badge bg-info"><?php echo $post['likes']; ?> Like</small>
                                                    </div>
                                                    <?php
                                                }
                                            } else {
                                                echo '<p class="text-muted">Tidak ada post</p>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-header bg-light border-0">
                                            <h5 class="mb-0 fw-bold">
                                                <i class="bi bi-envelope me-2 text-warning"></i>Pesan Terbaru
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <?php
                                            $recent_messages = $conn->query("SELECT * FROM messages ORDER BY created_at DESC LIMIT 5");
                                            if ($recent_messages->num_rows > 0) {
                                                while ($msg = $recent_messages->fetch_assoc()) {
                                                    ?>
                                                    <div class="mb-3 pb-3 border-bottom">
                                                        <strong class="d-block"><?php echo htmlspecialchars($msg['name']); ?></strong>
                                                        <small class="text-muted"><?php echo htmlspecialchars($msg['email']); ?></small>
                                                        <br>
                                                        <small><?php echo substr(htmlspecialchars($msg['message']), 0, 50) . '...'; ?></small>
                                                    </div>
                                                    <?php
                                                }
                                            } else {
                                                echo '<p class="text-muted">Tidak ada pesan</p>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Posts Management -->
                    <?php if ($page === 'posts'): ?>
                        <div class="content-area">
                            <h2 class="fw-bold mb-4">
                                <i class="bi bi-chat-dots text-success me-2"></i>Kelola Posts Forum
                            </h2>

                            <?php if (isset($_GET['deleted'])): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="bi bi-check-circle me-2"></i>Post berhasil dihapus!
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            <?php endif; ?>

                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama Penulis</th>
                                            <th>Pesan</th>
                                            <th>Like</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($posts->num_rows > 0) {
                                            while ($post = $posts->fetch_assoc()) {
                                                $date = new DateTime($post['created_at']);
                                                $date->modify('+7 hours');
                                                ?>
                                                <tr>
                                                    <td><span class="badge bg-secondary"><?php echo $post['id']; ?></span></td>
                                                    <td><strong><?php echo htmlspecialchars($post['name']); ?></strong></td>
                                                    <td>
                                                        <small class="text-muted">
                                                            <?php echo substr(htmlspecialchars($post['message']), 0, 60) . '...'; ?>
                                                        </small>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-info"><?php echo $post['likes']; ?></span>
                                                    </td>
                                                    <td><small class="text-muted"><?php echo $date->format('d/m/Y H:i'); ?></small></td>
                                                    <td>
                                                        <a href="?page=posts&delete_post=<?php echo $post['id']; ?>" class="btn btn-danger btn-sm btn-action" onclick="return confirm('Yakin hapus post ini?')">
                                                            <i class="bi bi-trash me-1"></i>Hapus
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="6" class="text-center text-muted py-4">Tidak ada posts</td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Majors Management -->
                    <?php if ($page === 'majors'): ?>
                        <div class="content-area">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h2 class="fw-bold">
                                    <i class="bi bi-book text-primary me-2"></i>Kelola Jurusan
                                </h2>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMajorModal">
                                    <i class="bi bi-plus-circle me-1"></i>Tambah Jurusan
                                </button>
                            </div>

                            <?php if (isset($_GET['deleted'])): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="bi bi-check-circle me-2"></i>Jurusan berhasil dihapus!
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            <?php endif; ?>

                            <?php if ($major_form_success): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="bi bi-check-circle me-2"></i><?php echo $major_form_success; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            <?php endif; ?>

                            <div class="row g-3">
                                <?php
                                if ($majors->num_rows > 0) {
                                    while ($major = $majors->fetch_assoc()) {
                                        ?>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="card border-0 shadow-sm h-100">
                                                <img src="<?php echo htmlspecialchars($major['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($major['name']); ?>" style="height: 200px; object-fit: cover;">
                                                <div class="card-body">
                                                    <h5 class="card-title fw-bold mb-2"><?php echo htmlspecialchars($major['name']); ?></h5>
                                                    <p class="card-text small text-muted"><?php echo substr(htmlspecialchars($major['description']), 0, 80) . '...'; ?></p>
                                                    <div class="d-flex gap-2">
                                                        <a href="?page=majors&edit_major=<?php echo $major['id']; ?>" class="btn btn-warning btn-sm btn-action" data-bs-toggle="modal" data-bs-target="#addMajorModal<?php echo $major['id']; ?>">
                                                            <i class="bi bi-pencil-square me-1"></i>Edit
                                                        </a>
                                                        <a href="?page=majors&delete_major=<?php echo $major['id']; ?>" class="btn btn-danger btn-sm btn-action" onclick="return confirm('Yakin hapus jurusan ini?')">
                                                            <i class="bi bi-trash me-1"></i>Hapus
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Edit Modal for each major -->
                                        <div class="modal fade" id="addMajorModal<?php echo $major['id']; ?>" tabindex="-1">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title fw-bold">Edit Jurusan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <form method="POST">
                                                        <div class="modal-body">
                                                            <input type="hidden" name="action" value="save_major">
                                                            <input type="hidden" name="major_id" value="<?php echo $major['id']; ?>">
                                                            
                                                            <div class="mb-3">
                                                                <label class="form-label fw-bold">Nama Jurusan</label>
                                                                <input type="text" class="form-control" name="major_name" value="<?php echo htmlspecialchars($major['name']); ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label fw-bold">Deskripsi</label>
                                                                <textarea class="form-control" name="major_description" rows="3" required><?php echo htmlspecialchars($major['description']); ?></textarea>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label fw-bold">Konten Lengkap</label>
                                                                <textarea class="form-control" name="major_content" rows="5" required><?php echo htmlspecialchars($major['content']); ?></textarea>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label fw-bold">URL Gambar</label>
                                                                <input type="url" class="form-control" name="major_image" value="<?php echo htmlspecialchars($major['image']); ?>" placeholder="https://...">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary">
                                                                <i class="bi bi-check-circle me-1"></i>Simpan Perubahan
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <div class="col-12">
                                        <p class="text-center text-muted py-5">Tidak ada jurusan</p>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>

                        <!-- Add Major Modal -->
                        <div class="modal fade" id="addMajorModal" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title fw-bold">Tambah Jurusan Baru</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form method="POST">
                                        <div class="modal-body">
                                            <?php if ($major_form_error): ?>
                                                <div class="alert alert-danger">
                                                    <i class="bi bi-exclamation-circle me-2"></i><?php echo $major_form_error; ?>
                                                </div>
                                            <?php endif; ?>

                                            <input type="hidden" name="action" value="save_major">
                                            <input type="hidden" name="major_id" value="0">
                                            
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Nama Jurusan *</label>
                                                <input type="text" class="form-control" name="major_name" required placeholder="Contoh: Rekayasa Perangkat Lunak">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Deskripsi Singkat *</label>
                                                <textarea class="form-control" name="major_description" rows="3" required placeholder="Deskripsi umum tentang jurusan..."></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Konten Lengkap *</label>
                                                <textarea class="form-control" name="major_content" rows="5" required placeholder="Konten detail, kurikulum, prospek kerja..."></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">URL Gambar</label>
                                                <input type="url" class="form-control" name="major_image" placeholder="https://via.placeholder.com/400x300">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="bi bi-plus-circle me-1"></i>Tambah Jurusan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Messages Management -->
                    <?php if ($page === 'messages'): ?>
                        <div class="content-area">
                            <h2 class="fw-bold mb-4">
                                <i class="bi bi-envelope text-warning me-2"></i>Pesan Kontak
                            </h2>

                            <?php if (isset($_GET['deleted'])): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="bi bi-check-circle me-2"></i>Pesan berhasil dihapus!
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            <?php endif; ?>

                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Pesan</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($messages->num_rows > 0) {
                                            while ($msg = $messages->fetch_assoc()) {
                                                $date = new DateTime($msg['created_at']);
                                                $date->modify('+7 hours');
                                                ?>
                                                <tr>
                                                    <td><span class="badge bg-secondary"><?php echo $msg['id']; ?></span></td>
                                                    <td><strong><?php echo htmlspecialchars($msg['name']); ?></strong></td>
                                                    <td><?php echo htmlspecialchars($msg['email']); ?></td>
                                                    <td>
                                                        <small class="text-muted">
                                                            <?php echo substr(htmlspecialchars($msg['message']), 0, 60) . '...'; ?>
                                                        </small>
                                                    </td>
                                                    <td><small class="text-muted"><?php echo $date->format('d/m/Y H:i'); ?></small></td>
                                                    <td>
                                                        <button class="btn btn-info btn-sm btn-action" data-bs-toggle="modal" data-bs-target="#viewMessageModal<?php echo $msg['id']; ?>">
                                                            <i class="bi bi-eye me-1"></i>Lihat
                                                        </button>
                                                        <a href="?page=messages&delete_message=<?php echo $msg['id']; ?>" class="btn btn-danger btn-sm btn-action" onclick="return confirm('Yakin hapus pesan ini?')">
                                                            <i class="bi bi-trash me-1"></i>Hapus
                                                        </a>
                                                    </td>
                                                </tr>

                                                <!-- View Message Modal -->
                                                <div class="modal fade" id="viewMessageModal<?php echo $msg['id']; ?>" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title fw-bold">Pesan dari <?php echo htmlspecialchars($msg['name']); ?></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p><strong>Nama:</strong> <?php echo htmlspecialchars($msg['name']); ?></p>
                                                                <p><strong>Email:</strong> <a href="mailto:<?php echo htmlspecialchars($msg['email']); ?>"><?php echo htmlspecialchars($msg['email']); ?></a></p>
                                                                <hr>
                                                                <p><strong>Pesan:</strong></p>
                                                                <p><?php echo nl2br(htmlspecialchars($msg['message'])); ?></p>
                                                                <small class="text-muted">Dikirim: <?php echo $date->format('d/m/Y H:i'); ?></small>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a href="mailto:<?php echo htmlspecialchars($msg['email']); ?>" class="btn btn-primary">
                                                                    <i class="bi bi-envelope me-1"></i>Balas Email
                                                                </a>
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="6" class="text-center text-muted py-4">Tidak ada pesan</td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-dismiss alerts after 5 seconds
        document.querySelectorAll('.alert').forEach(alert => {
            setTimeout(() => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 5000);
        });
    </script>
</body>
</html>
