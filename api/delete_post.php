<?php
header('Content-Type: application/json');
include '../config/database.php';

$id = intval($_POST['id'] ?? 0);

if ($id <= 0) {
    echo json_encode(['success' => false, 'message' => 'ID tidak valid']);
    exit;
}

$sql = "DELETE FROM posts WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true, 'message' => 'Pesan berhasil dihapus']);
} else {
    echo json_encode(['success' => false, 'message' => 'Gagal menghapus pesan']);
}
?>
