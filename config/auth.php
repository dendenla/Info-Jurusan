<?php
// config/auth.php - Authentication Helper Functions

function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

function verifyPassword($password, $hash) {
    return password_verify($password, $hash);
}

function registerUser($conn, $username, $email, $password) {
    // Validate input
    if (empty($username) || empty($email) || empty($password)) {
        return ['success' => false, 'message' => 'Semua field harus diisi!'];
    }
    
    if (strlen($username) < 3) {
        return ['success' => false, 'message' => 'Username minimal 3 karakter!'];
    }
    
    if (strlen($password) < 6) {
        return ['success' => false, 'message' => 'Password minimal 6 karakter!'];
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return ['success' => false, 'message' => 'Email tidak valid!'];
    }
    
    // Check if username already exists
    $check_stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $check_stmt->bind_param("s", $username);
    $check_stmt->execute();
    $result = $check_stmt->get_result();
    
    if ($result->num_rows > 0) {
        $check_stmt->close();
        return ['success' => false, 'message' => 'Username sudah digunakan!'];
    }
    $check_stmt->close();
    
    // Check if email already exists
    $check_stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $result = $check_stmt->get_result();
    
    if ($result->num_rows > 0) {
        $check_stmt->close();
        return ['success' => false, 'message' => 'Email sudah terdaftar!'];
    }
    $check_stmt->close();
    
    // Hash password
    $hashed_password = hashPassword($password);
    
    // Insert user
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashed_password);
    
    if ($stmt->execute()) {
        $stmt->close();
        return ['success' => true, 'message' => 'Registrasi berhasil! Silakan login.'];
    } else {
        $stmt->close();
        return ['success' => false, 'message' => 'Gagal registrasi. Coba lagi.'];
    }
}

function loginUser($conn, $username, $password) {
    if (empty($username) || empty($password)) {
        return ['success' => false, 'message' => 'Username dan password harus diisi!'];
    }
    
    $stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        $stmt->close();
        return ['success' => false, 'message' => 'Username tidak ditemukan!'];
    }
    
    $user = $result->fetch_assoc();
    $stmt->close();
    
    if (!verifyPassword($password, $user['password'])) {
        return ['success' => false, 'message' => 'Password salah!'];
    }
    
    return [
        'success' => true, 
        'message' => 'Login berhasil!', 
        'user_id' => $user['id'], 
        'username' => $user['username'],
        'role' => $user['role']
    ];
}

function isLoggedIn() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

function isAdmin() {
    return isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true;
}

function getCurrentUser($conn) {
    if (!isLoggedIn()) {
        return null;
    }
    
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT id, username, email FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }
    
    $stmt->close();
    return null;
}

function logout() {
    // Hapus semua session variables
    $_SESSION = array();
    
    // Destroy session cookie
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }
    
    // Destroy session
    session_destroy();
    session_write_close();
}

function setAdminAccess($user_id, $role = 'user') {
    $_SESSION['is_admin'] = ($role === 'admin');
    $_SESSION['user_role'] = $role;
    $_SESSION['admin_user_id'] = $user_id;
}

function getUserRole() {
    return $_SESSION['user_role'] ?? 'user';
}

function checkRole($required_role) {
    $user_role = getUserRole();
    return $user_role === $required_role;
}
?>
