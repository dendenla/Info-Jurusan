<?php
// Helper Functions
// File ini berisi fungsi-fungsi helper yang sering digunakan

/**
 * Sanitize input string
 */
function sanitize_input($data) {
    global $conn;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/**
 * Format tanggal Indonesia
 */
function format_date_id($date_string) {
    $date = new DateTime($date_string);
    $months = array(
        'January' => 'Januari',
        'February' => 'Februari',
        'March' => 'Maret',
        'April' => 'April',
        'May' => 'Mei',
        'June' => 'Juni',
        'July' => 'Juli',
        'August' => 'Agustus',
        'September' => 'September',
        'October' => 'Oktober',
        'November' => 'November',
        'December' => 'Desember'
    );
    
    $day = $date->format('d');
    $month = $months[$date->format('F')];
    $year = $date->format('Y');
    $time = $date->format('H:i');
    
    return "$day $month $year - $time";
}

/**
 * Get relative time (e.g., "2 jam yang lalu")
 */
function get_relative_time($date_string) {
    $date = new DateTime($date_string);
    $now = new DateTime();
    $diff = $now->diff($date);
    
    if ($diff->d == 0) {
        if ($diff->h == 0) {
            return $diff->i . ' menit yang lalu';
        }
        return $diff->h . ' jam yang lalu';
    } elseif ($diff->d < 7) {
        return $diff->d . ' hari yang lalu';
    } else {
        return $date->format('d M Y');
    }
}

/**
 * Truncate string
 */
function truncate_string($string, $length = 100, $append = "...") {
    if (strlen($string) > $length) {
        return substr($string, 0, $length) . $append;
    }
    return $string;
}

/**
 * Generate slug from string
 */
function generate_slug($string) {
    $string = strtolower(trim($string));
    $string = preg_replace('/[^a-z0-9-]/', '-', $string);
    $string = preg_replace('/-+/', '-', $string);
    return trim($string, '-');
}

/**
 * Check if email is valid
 */
function is_valid_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Check if string contains only letters and spaces
 */
function is_valid_name($name) {
    return preg_match("/^[a-zA-Z\s]+$/", $name);
}

/**
 * Get active page name
 */
function get_current_page() {
    $page = basename($_SERVER['PHP_SELF'], '.php');
    return $page == 'index' ? 'beranda' : $page;
}

/**
 * Redirect to page
 */
function redirect($url) {
    header("Location: $url");
    exit;
}

/**
 * Get total count from table
 */
function get_table_count($table, $conn) {
    $result = $conn->query("SELECT COUNT(*) as total FROM $table");
    $row = $result->fetch_assoc();
    return $row['total'];
}

/**
 * Log activity (optional)
 */
function log_activity($activity, $status = 'success') {
    $file = 'logs/activity.log';
    if (!file_exists('logs')) {
        mkdir('logs', 0755, true);
    }
    
    $log = date('Y-m-d H:i:s') . " | $status | $activity\n";
    file_put_contents($file, $log, FILE_APPEND);
}

/**
 * Generate random string
 */
function generate_random_string($length = 10) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $random = '';
    for ($i = 0; $i < $length; $i++) {
        $random .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $random;
}

/**
 * Get gravatar URL from email
 */
function get_gravatar($email, $size = 32) {
    $email = strtolower(trim($email));
    $hash = md5($email);
    return "https://www.gravatar.com/avatar/$hash?s=$size&d=identicon";
}

?>
