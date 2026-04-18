<?php
header('Content-Type: application/json');
include '../config/database.php';

$name = trim($_POST['name'] ?? '');
$message = trim($_POST['message'] ?? '');

// Validasi
if (empty($name) || empty($message)) {
    echo json_encode(['success' => false, 'message' => 'Nama dan pesan tidak boleh kosong']);
    exit;
}

if (strlen($name) > 50) {
    echo json_encode(['success' => false, 'message' => 'Nama terlalu panjang']);
    exit;
}

if (strlen($message) > 500) {
    echo json_encode(['success' => false, 'message' => 'Pesan terlalu panjang']);
    exit;
}

// Insert ke database dengan prepared statement
$sql = "INSERT INTO posts (name, message, likes, created_at) VALUES (?, ?, 0, NOW())";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    echo json_encode(['success' => false, 'message' => 'Gagal mempersiapkan query']);
    exit;
}

$stmt->bind_param("ss", $name, $message);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Pesan berhasil dikirim']);
} else {
    echo json_encode(['success' => false, 'message' => 'Gagal mengirim pesan']);
}

$stmt->close();
?>
