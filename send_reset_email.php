<?php
// Database connection
$host = 'localhost';
$db   = 'your_database';
$user = 'your_username';
$pass = 'your_password';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $options);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Check if email exists in the database
    $stmt = $pdo->prepare('SELECT id FROM users1 WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        // Generate a unique token
        $token = bin2hex(random_bytes(50));
        
        // Store the token in the database
        $stmt = $pdo->prepare('INSERT INTO password_resets (user_id, token, created_at) VALUES (?, ?, NOW())');
        $stmt->execute([$user['id'], $token]);

        // Send email with reset link
        $resetLink = "http://yourwebsite.com/reset_password.php?token=$token";
        $subject = "Password Reset Request";
        $message = "Hi, click the following link to reset your password: $resetLink";
        $headers = "From: no-reply@yourwebsite.com";

        if (mail($email, $subject, $message, $headers)) {
            echo "Password reset link has been sent to your email.";
        } else {
            echo "Failed to send email. Please try again.";
        }
    } else {
        echo "Email address not found.";
    }
}
?>
