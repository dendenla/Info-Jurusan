<?php
include 'config/auth.php';

$password = 'admin123';
$hash = hashPassword($password);

echo "Password Hash: " . $hash . "\n";
echo "Verifikasi: " . (password_verify($password, $hash) ? 'OK' : 'GAGAL') . "\n";
?>
