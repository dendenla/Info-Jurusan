<?php
$page_title = "Forum Diskusi";
include 'includes/header.php';

// Get semua posts
$posts_query = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
?>

    <!-- Page Header -->
    <section class="py-5" style="background: linear-gradient(135deg, #0d6efd 0%, #0055cc 100%); color: white;">
        <div class="container-lg">
            <h1 class="display-4 fw-bold mb-3">Forum Diskusi</h1>
            <p class="lead">Berbagi pertanyaan, diskusi, dan pengalaman dengan sesama siswa</p>
        </div>
    </section>

    <!-- Form Input -->
    <section class="py-5 border-bottom">
        <div class="container-lg">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold mb-4">Tuliskan Pesan Anda</h5>
                    <form id="forumForm">
                        <div class="mb-3">
                            <label for="forumName" class="form-label fw-bold">Nama <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg" id="forumName" name="name" placeholder="Masukkan nama Anda" required>
                            <small class="text-muted">Nama tidak perlu nama asli, bisa nickname</small>
                        </div>
                        <div class="mb-3">
                            <label for="forumMessage" class="form-label fw-bold">Pesan <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="forumMessage" name="message" rows="5" placeholder="Tuliskan pesan Anda... (maksimal 500 karakter)" maxlength="500" required></textarea>
                            <small class="text-muted"><span id="charCount">0</span>/500</small>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg fw-bold">
                            <i class="bi bi-send me-2"></i>Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Posts List -->
    <section class="py-5">
        <div class="container-lg">
            <h5 class="fw-bold mb-4">
                <i class="bi bi-chat-dots me-2"></i>Diskusi Terbaru
            </h5>

            <div id="postsList">
                <?php
                if ($posts_query->num_rows > 0) {
                    while ($post = $posts_query->fetch_assoc()) {
                        $date = new DateTime($post['created_at']);
                        $date->modify('+7 hours'); // Timezone Indonesia
                        $date_str = $date->format('d M Y - H:i');
                        ?>
                        <div class="card border-0 shadow-sm mb-3 post-item" data-id="<?php echo $post['id']; ?>">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div>
                                        <h6 class="card-title fw-bold mb-1">
                                            <i class="bi bi-person-circle me-2"></i><?php echo htmlspecialchars($post['name']); ?>
                                        </h6>
                                        <small class="text-muted"><?php echo $date_str; ?></small>
                                    </div>
                                    <button class="btn btn-sm btn-outline-danger delete-post" data-id="<?php echo $post['id']; ?>" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                                <p class="card-text"><?php echo nl2br(htmlspecialchars($post['message'])); ?></p>
                                <div class="mt-3">
                                    <button class="btn btn-sm btn-outline-primary like-btn" data-id="<?php echo $post['id']; ?>" data-likes="<?php echo $post['likes']; ?>">
                                        <i class="bi bi-hand-thumbs-up me-1"></i><span class="like-count"><?php echo $post['likes']; ?></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo '<div class="alert alert-info text-center"><i class="bi bi-info-circle me-2"></i>Belum ada diskusi. Jadilah yang pertama berkontribusi!</div>';
                }
                ?>
            </div>
        </div>
    </section>

    <script>
        // Character counter
        document.getElementById('forumMessage').addEventListener('input', function() {
            document.getElementById('charCount').textContent = this.value.length;
        });

        // Submit form
        document.getElementById('forumForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const name = document.getElementById('forumName').value;
            const message = document.getElementById('forumMessage').value;
            
            if (!name.trim() || !message.trim()) {
                alert('Nama dan pesan tidak boleh kosong!');
                return;
            }

            fetch('api/add_post.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'name=' + encodeURIComponent(name) + '&message=' + encodeURIComponent(message)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('forumForm').reset();
                    document.getElementById('charCount').textContent = '0';
                    loadPosts();
                    showToast('Pesan berhasil dikirim!', 'success');
                } else {
                    alert('Gagal mengirim pesan');
                }
            })
            .catch(error => console.error('Error:', error));
        });

        // Load posts
        function loadPosts() {
            fetch('api/get_posts.php')
            .then(response => response.json())
            .then(data => {
                const postsList = document.getElementById('postsList');
                if (data.length === 0) {
                    postsList.innerHTML = '<div class="alert alert-info text-center"><i class="bi bi-info-circle me-2"></i>Belum ada diskusi. Jadilah yang pertama berkontribusi!</div>';
                } else {
                    postsList.innerHTML = '';
                    data.forEach(post => {
                        const date = new Date(post.created_at);
                        const dateStr = date.toLocaleDateString('id-ID') + ' - ' + date.toLocaleTimeString('id-ID', {hour: '2-digit', minute:'2-digit'});
                        const postHTML = `
                            <div class="card border-0 shadow-sm mb-3 post-item" data-id="${post.id}">
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div>
                                            <h6 class="card-title fw-bold mb-1">
                                                <i class="bi bi-person-circle me-2"></i>${escapeHtml(post.name)}
                                            </h6>
                                            <small class="text-muted">${dateStr}</small>
                                        </div>
                                        <button class="btn btn-sm btn-outline-danger delete-post" data-id="${post.id}" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                    <p class="card-text">${escapeHtml(post.message).replace(/\n/g, '<br>')}</p>
                                    <div class="mt-3">
                                        <button class="btn btn-sm btn-outline-primary like-btn" data-id="${post.id}">
                                            <i class="bi bi-hand-thumbs-up me-1"></i><span class="like-count">${post.likes}</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        `;
                        postsList.innerHTML += postHTML;
                    });
                    attachEventListeners();
                }
            })
            .catch(error => console.error('Error:', error));
        }

        // Like button
        function attachEventListeners() {
            document.querySelectorAll('.like-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const postId = this.dataset.id;
                    const likeCount = this.querySelector('.like-count');
                    
                    fetch('api/like_post.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: 'id=' + postId
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            likeCount.textContent = data.likes;
                            this.classList.add('active');
                        }
                    })
                    .catch(error => console.error('Error:', error));
                });
            });

            document.querySelectorAll('.delete-post').forEach(btn => {
                btn.addEventListener('click', function() {
                    if (confirm('Apakah Anda yakin ingin menghapus pesan ini?')) {
                        const postId = this.dataset.id;
                        
                        fetch('api/delete_post.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: 'id=' + postId
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                document.querySelector('[data-id="' + postId + '"]').remove();
                                showToast('Pesan berhasil dihapus!', 'success');
                                loadPosts();
                            }
                        })
                        .catch(error => console.error('Error:', error));
                    }
                });
            });
        }

        function escapeHtml(text) {
            const map = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            };
            return text.replace(/[&<>"']/g, m => map[m]);
        }

        function showToast(message, type) {
            const toast = document.createElement('div');
            toast.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
            toast.style.cssText = 'top: 20px; right: 20px; z-index: 9999;';
            toast.innerHTML = `${message}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>`;
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 3000);
        }

        attachEventListeners();
    </script>

<?php
include 'includes/footer.php';
?>
