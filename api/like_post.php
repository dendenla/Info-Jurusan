<?php
header('Content-Type: application/json');
include '../config/database.php';

$id = intval($_POST['id'] ?? 0);

if ($id <= 0) {
    echo json_encode(['success' => false, 'message' => 'ID tidak valid']);
    exit;
}

$sql = "UPDATE posts SET likes = likes + 1 WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    // Get updated likes count
    $result = $conn->query("SELECT likes FROM posts WHERE id = $id");
    $row = $result->fetch_assoc();
    echo json_encode(['success' => true, 'likes' => $row['likes']]);
} else {
    echo json_encode(['success' => false, 'message' => 'Gagal memberikan like']);
}
?>
