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
    $token = $_POST['token'];
    $newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Verify the token and get user ID
    $stmt = $pdo->prepare('SELECT user_id FROM password_resets WHERE token = ?');
    $stmt->execute([$token]);
    $resetRequest = $stmt->fetch();

    if ($resetRequest) {
        // Update the password in the users table
        $stmt = $pdo->prepare('UPDATE users1 SET password = ? WHERE id = ?');
        $stmt->execute([$newPassword, $resetRequest['user_id']]);

        // Delete the token after successful password reset
        $stmt = $pdo->prepare('DELETE FROM password_resets WHERE token = ?');
        $stmt->execute([$token]);

        echo "Your password has been successfully reset.";
    } else {
        echo "Invalid token.";
    }
}
?>
