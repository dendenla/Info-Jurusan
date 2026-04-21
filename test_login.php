<?php
include 'config/database.php';
include 'config/auth.php';

$username = 'admin';
$password = 'admin123';

// Get user dari database
$stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "❌ User tidak ditemukan!";
    exit;
}

$user = $result->fetch_assoc();
$stmt->close();

echo "✅ User ditemukan: " . $user['username'] . "<br>";
echo "Role: " . $user['role'] . "<br>";
echo "Password Hash: " . $user['password'] . "<br><br>";

// Test password verification
$verify = password_verify($password, $user['password']);

echo "Password yang diinput: " . $password . "<br>";
echo "Hasil verifikasi: " . ($verify ? "✅ COCOK" : "❌ TIDAK COCOK") . "<br>";

if ($verify) {
    echo "<br><strong style='color: green;'>✅ Login BERHASIL! Akun admin dapat digunakan.</strong>";
} else {
    echo "<br><strong style='color: red;'>❌ Password salah atau hash tidak valid</strong>";
}
?>
