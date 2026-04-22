<?php
/**
 * Script untuk Update Tabel Users
 * Menambahkan kolom 'role' yang hilang
 * Jalankan script ini sekali untuk memperbaiki struktur tabel
 */

require_once 'config/database.php';

echo "<h2>Update Database Users Table</h2>";

try {
    // Check if role column exists
    $result = $conn->query("SHOW COLUMNS FROM users LIKE 'role'");
    
    if ($result && $result->num_rows === 0) {
        // Role column doesn't exist, add it
        $sql = "ALTER TABLE users ADD COLUMN role VARCHAR(20) DEFAULT 'user' AFTER email";
        
        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success'>";
            echo "<h4>✓ Kolom 'role' berhasil ditambahkan!</h4>";
            echo "<p>Tabel users telah diperbarui dengan kolom role (default: 'user')</p>";
            echo "</div>";
        } else {
            echo "<div class='alert alert-danger'>";
            echo "<h4>Error:</h4>";
            echo $conn->error;
            echo "</div>";
        }
    } else {
        echo "<div class='alert alert-info'>";
        echo "<h4>Info:</h4>";
        echo "<p>Kolom 'role' sudah ada di tabel users</p>";
        echo "</div>";
    }
    
    // Check if email is UNIQUE
    $result = $conn->query("SHOW INDEX FROM users WHERE Column_name='email' AND Non_unique=0");
    
    if (!$result || $result->num_rows === 0) {
        // Email is not unique, make it unique
        $sql = "ALTER TABLE users ADD UNIQUE INDEX unique_email (email)";
        
        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success'>";
            echo "<h4>✓ Email constraint berhasil ditambahkan!</h4>";
            echo "<p>Email sekarang harus unik di tabel users</p>";
            echo "</div>";
        }
    }
    
} catch (Exception $e) {
    echo "<div class='alert alert-danger'>";
    echo "<h4>Error: " . $e->getMessage() . "</h4>";
    echo "</div>";
}

$conn->close();
?>
