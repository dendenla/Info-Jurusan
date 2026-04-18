<?php
header('Content-Type: application/json');
include '../config/database.php';

$id = intval($_POST['id'] ?? 0);

if ($id <= 0) {
    echo json_encode(['success' => false, 'message' => 'ID tidak valid']);
    exit;
}

$sql = "UPDATE posts SET likes = likes + 1 WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    echo json_encode(['success' => false, 'message' => 'Gagal mempersiapkan query']);
    exit;
}

$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    // Get updated likes count
    $result_sql = "SELECT likes FROM posts WHERE id = ?";
    $result_stmt = $conn->prepare($result_sql);
    $result_stmt->bind_param("i", $id);
    $result_stmt->execute();
    $result = $result_stmt->get_result();
    $row = $result->fetch_assoc();
    $result_stmt->close();
    echo json_encode(['success' => true, 'likes' => $row['likes']]);
} else {
    echo json_encode(['success' => false, 'message' => 'Gagal memberikan like']);
}

$stmt->close();
?>
