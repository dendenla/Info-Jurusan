<?php
// config/email.php - Email Configuration & Helper Functions

// Email configuration
define('EMAIL_FROM', 'noreply@smkn1garut.local');
define('EMAIL_FROM_NAME', 'SMKN 1 Garut');
define('ADMIN_EMAIL', 'admin@smkn1garut.local'); // Ganti dengan email admin sebenarnya

// Untuk production, ganti dengan SMTP configuration
// define('MAIL_HOST', 'smtp.gmail.com');
// define('MAIL_PORT', 587);
// define('MAIL_USERNAME', 'your-email@gmail.com');
// define('MAIL_PASSWORD', 'your-app-password');

/**
 * Send email notification
 * 
 * @param string $to Recipient email
 * @param string $subject Email subject
 * @param string $body Email body (HTML)
 * @param string $from_name Optional: Sender name
 * @return bool Success or failure
 */
function sendEmail($to, $subject, $body, $from_name = null) {
    if (!filter_var($to, FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    
    $from_name = $from_name ?? EMAIL_FROM_NAME;
    
    // Email headers
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From: {$from_name} <" . EMAIL_FROM . ">\r\n";
    $headers .= "Reply-To: " . EMAIL_FROM . "\r\n";
    
    // Use PHP mail() - for production, implement SMTP or use PHPMailer
    // Suppress error if mail server not available
    if (@mail($to, $subject, $body, $headers)) {
        return true;
    }
    
    // Log failed email attempts
    error_log("Failed to send email to: $to");
    return false;
}

/**
 * Send contact form notification to admin
 */
function sendContactNotificationToAdmin($name, $email, $message) {
    $subject = "Pesan Baru dari Kontak - SMKN 1 Garut";
    
    $body = <<<HTML
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; background: #f9f9f9; border-radius: 10px; }
            .header { background: linear-gradient(135deg, #0d6efd 0%, #0055cc 100%); color: white; padding: 20px; border-radius: 5px; }
            .content { background: white; padding: 20px; margin-top: 20px; border-radius: 5px; }
            .footer { text-align: center; font-size: 12px; color: #666; margin-top: 20px; padding-top: 20px; border-top: 1px solid #ddd; }
            strong { color: #0d6efd; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h2>Pesan Baru Masuk</h2>
            </div>
            <div class="content">
                <p><strong>Nama Pengirim:</strong> {$name}</p>
                <p><strong>Email Pengirim:</strong> <a href="mailto:{$email}">{$email}</a></p>
                <hr>
                <p><strong>Pesan:</strong></p>
                <p>{$message}</p>
            </div>
            <div class="footer">
                <p>Email ini dikirim otomatis dari sistem SMKN 1 Garut. Jangan balas email ini, silakan reply langsung ke {$email}</p>
            </div>
        </div>
    </body>
    </html>
    HTML;
    
    return sendEmail(ADMIN_EMAIL, $subject, $body);
}

/**
 * Send confirmation email to user
 */
function sendContactConfirmationToUser($name, $email) {
    $subject = "Kami Terima Pesan Anda - SMKN 1 Garut";
    
    $body = <<<HTML
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; background: #f9f9f9; border-radius: 10px; }
            .header { background: linear-gradient(135deg, #0d6efd 0%, #0055cc 100%); color: white; padding: 20px; border-radius: 5px; }
            .content { background: white; padding: 20px; margin-top: 20px; border-radius: 5px; }
            .footer { text-align: center; font-size: 12px; color: #666; margin-top: 20px; padding-top: 20px; border-top: 1px solid #ddd; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h2>Terima Kasih atas Pesan Anda</h2>
            </div>
            <div class="content">
                <p>Halo <strong>{$name}</strong>,</p>
                <p>Kami telah menerima pesan Anda dengan baik. Terima kasih telah menghubungi SMKN 1 Garut.</p>
                <p>Tim kami akan segera meninjau dan membalas pesan Anda dalam waktu 1-2 hari kerja.</p>
                <hr>
                <p><strong>Informasi Kontak Kami:</strong></p>
                <ul>
                    <li>Telepon: (0274) XXX-XXXX</li>
                    <li>Email: info@smkn1garut.sch.id</li>
                    <li>Lokasi: Garut, Jawa Barat</li>
                </ul>
            </div>
            <div class="footer">
                <p>&copy; 2024 SMKN 1 Garut. Semua hak dilindungi.</p>
            </div>
        </div>
    </body>
    </html>
    HTML;
    
    return sendEmail($email, $subject, $body, $name);
}

/**
 * Send account registration confirmation
 */
function sendRegistrationConfirmation($username, $email) {
    $subject = "Akun Berhasil Dibuat - SMKN 1 Garut";
    
    $login_url = 'http://' . $_SERVER['HTTP_HOST'] . '/Info-Jurusan/login.php';
    
    $body = <<<HTML
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; background: #f9f9f9; border-radius: 10px; }
            .header { background: linear-gradient(135deg, #0d6efd 0%, #0055cc 100%); color: white; padding: 20px; border-radius: 5px; }
            .content { background: white; padding: 20px; margin-top: 20px; border-radius: 5px; }
            .button { display: inline-block; background: #0d6efd; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; margin: 20px 0; }
            .footer { text-align: center; font-size: 12px; color: #666; margin-top: 20px; padding-top: 20px; border-top: 1px solid #ddd; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h2>Selamat Datang!</h2>
            </div>
            <div class="content">
                <p>Halo <strong>{$username}</strong>,</p>
                <p>Akun Anda telah berhasil dibuat. Anda sekarang dapat login ke admin panel.</p>
                <p><strong>Username:</strong> {$username}</p>
                <p><strong>Email:</strong> {$email}</p>
                <p style="text-align: center;">
                    <a href="{$login_url}" class="button">Login Sekarang</a>
                </p>
                <hr>
                <p><strong>Tips Keamanan:</strong></p>
                <ul>
                    <li>Jangan pernah bagikan password Anda kepada siapa pun</li>
                    <li>Gunakan password yang kuat</li>
                    <li>Selalu logout setelah menggunakan admin panel</li>
                </ul>
            </div>
            <div class="footer">
                <p>&copy; 2024 SMKN 1 Garut. Semua hak dilindungi.</p>
            </div>
        </div>
    </body>
    </html>
    HTML;
    
    return sendEmail($email, $subject, $body);
}
?>
