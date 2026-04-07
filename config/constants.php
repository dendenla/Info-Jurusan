<?php
// config/constants.php
// File untuk menyimpan constanta aplikasi

// Identitas Sekolah
define('SCHOOL_NAME', 'SMKN 1 Garut');
define('SCHOOL_ADDRESS', 'Jln. Jendral Sudirman No.123, Garut 44128');
define('SCHOOL_PHONE', '(0262) 1234567');
define('SCHOOL_EMAIL', 'info@smkn1garut.sch.id');
define('SCHOOL_WEBSITE', 'https://smkn1garut.sch.id');

// Website Settings
define('SITE_URL', 'http://localhost/Info%20jurusan/');
define('SITE_NAME', 'SMKN 1 Garut - Website Resmi');
define('SITE_DESCRIPTION', 'Website resmi SMKN 1 Garut - Sekolah Menengah Kejuruan terbaik di Garut');

// Pagination
define('ITEMS_PER_PAGE', 9);

// Forum Settings
define('MAX_POST_LENGTH', 500);
define('MAX_NAME_LENGTH', 50);

// DB Query Limits
define('MAJOR_PREVIEW_LIMIT', 6);
define('POSTS_DISPLAY_LIMIT', 10);

// File Upload
define('MAX_UPLOAD_SIZE', 5242880); // 5MB
define('ALLOWED_EXTENSIONS', array('jpg', 'jpeg', 'png', 'gif'));
define('UPLOAD_DIR', 'assets/images/');

// Time Zone
define('TIMEZONE', 'Asia/Jakarta');
date_default_timezone_set(TIMEZONE);

// Security
define('PASSWORD_HASH_ALGO', 'bcrypt');

// API Settings
define('API_RESPONSE_FORMAT', 'json');

// Error Handling
define('SHOW_ERRORS', true); // Set to false in production
define('ERROR_LOG_FILE', 'logs/error.log');

// Session timeout (in minutes)
define('SESSION_TIMEOUT', 30);
