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

// Escape input
$name = mysqli_real_escape_string($conn, $name);
$message = mysqli_real_escape_string($conn, $message);

// Insert ke database
$sql = "INSERT INTO posts (name, message, likes, created_at) VALUES ('$name', '$message', 0, NOW())";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true, 'message' => 'Pesan berhasil dikirim']);
} else {
    echo json_encode(['success' => false, 'message' => 'Gagal mengirim pesan']);
}
?>
