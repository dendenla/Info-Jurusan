<?php
// stats.php - Dashboard statistik (optional, untuk admin view)
// Fitur ini dapat dikembangkan menjadi admin panel lengkap

include 'config/database.php';

// Get statistics
$total_majors = $conn->query("SELECT COUNT(*) as total FROM majors")->fetch_assoc()['total'];
$total_posts = $conn->query("SELECT COUNT(*) as total FROM posts")->fetch_assoc()['total'];
$total_messages = $conn->query("SELECT COUNT(*) as total FROM messages")->fetch_assoc()['total'];
$total_likes = $conn->query("SELECT SUM(likes) as total FROM posts")->fetch_assoc()['total'] ?? 0;

// Recent posts
$recent_posts = $conn->query("SELECT * FROM posts ORDER BY created_at DESC LIMIT 5");

// Recent messages
$recent_messages = $conn->query("SELECT * FROM messages ORDER BY created_at DESC LIMIT 5");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistik - SMKN 1 Garut</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
        <div class="container-lg">
            <a class="navbar-brand fw-bold text-primary" href="index.php">
                <i class="bi bi-building me-2"></i>SMKN 1 Garut
            </a>
            <a href="index.php" class="btn btn-primary">← Kembali</a>
        </div>
    </nav>

    <div class="container-lg py-5">
        <h1 class="mb-4">📊 Statistik Website</h1>

        <!-- Statistics Cards -->
        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted small mb-2">Total Jurusan</p>
                                <h3 class="fw-bold text-primary"><?php echo $total_majors; ?></h3>
                            </div>
                            <i class="bi bi-bookmark-fill text-primary" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted small mb-2">Total Post Forum</p>
                                <h3 class="fw-bold text-success"><?php echo $total_posts; ?></h3>
                            </div>
                            <i class="bi bi-chat-dots-fill text-success" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted small mb-2">Total Pesan Kontak</p>
                                <h3 class="fw-bold text-warning"><?php echo $total_messages; ?></h3>
                            </div>
                            <i class="bi bi-envelope-fill text-warning" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted small mb-2">Total Like Forum</p>
                                <h3 class="fw-bold text-danger"><?php echo $total_likes; ?></h3>
                            </div>
                            <i class="bi bi-hand-thumbs-up-fill text-danger" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Recent Posts -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-light border-0">
                        <h5 class="mb-0 fw-bold">
                            <i class="bi bi-chat-dots me-2"></i>Post Forum Terbaru
                        </h5>
                    </div>
                    <div class="card-body">
                        <?php
                        if ($recent_posts->num_rows > 0) {
                            while ($post = $recent_posts->fetch_assoc()) {
                                $date = new DateTime($post['created_at']);
                                $date->modify('+7 hours');
                                ?>
                                <div class="mb-3 pb-3 border-bottom">
                                    <div class="d-flex justify-content-between">
                                        <strong><?php echo htmlspecialchars($post['name']); ?></strong>
                                        <small class="text-muted"><?php echo $date->format('d/m H:i'); ?></small>
                                    </div>
                                    <p class="mb-2 text-muted small"><?php echo substr(htmlspecialchars($post['message']), 0, 60) . '...'; ?></p>
                                    <div>
                                        <span class="badge bg-info"><?php echo $post['likes']; ?> Like</span>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            echo '<p class="text-muted">Belum ada post</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>

            <!-- Recent Messages -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-light border-0">
                        <h5 class="mb-0 fw-bold">
                            <i class="bi bi-envelope me-2"></i>Pesan Kontak Terbaru
                        </h5>
                    </div>
                    <div class="card-body">
                        <?php
                        if ($recent_messages->num_rows > 0) {
                            while ($message = $recent_messages->fetch_assoc()) {
                                $date = new DateTime($message['created_at']);
                                $date->modify('+7 hours');
                                ?>
                                <div class="mb-3 pb-3 border-bottom">
                                    <div class="d-flex justify-content-between">
                                        <strong><?php echo htmlspecialchars($message['name']); ?></strong>
                                        <small class="text-muted"><?php echo $date->format('d/m H:i'); ?></small>
                                    </div>
                                    <p class="mb-2 text-muted small"><?php echo htmlspecialchars($message['email']); ?></p>
                                    <p class="mb-0 small"><?php echo substr(htmlspecialchars($message['message']), 0, 60) . '...'; ?></p>
                                </div>
                                <?php
                            }
                        } else {
                            echo '<p class="text-muted">Belum ada pesan</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container-lg text-center">
            <p class="mb-0 text-muted">&copy; 2024 SMKN 1 Garut. Statistics Dashboard.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
