<?php
// Konfigurasi Database
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "smkn1_garut";

// Membuat koneksi
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Set charset
$conn->set_charset("utf8");
?>
