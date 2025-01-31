<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer
require 'vendor/autoload.php';

// Database connection (replace with your own database details)
$host = 'localhost';
$db = 'elibrery';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

// Check if token is provided
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Get the token details from the database
    $stmt = $conn->prepare("SELECT * FROM studentreg WHERE token = ?");
    $stmt->bind_param('s', $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Token found, now check if it has expired
        $reset = $result->fetch_assoc();
        $expires_at = $reset['expires_at'];

        if (strtotime($expires_at) > time()) {
            // Token is valid, show password reset form
            echo '<form action="update_password.php" method="POST">
                    <input type="hidden" name="token" value="' . $token . '">
                    <label for="password">New Password:</label>
                    <input type="password" name="password" required>
                    <button type="submit">Reset Password</button>
                  </form>';
        } else {
            echo 'The password reset link has expired.';
        }
    } else {
        echo 'Invalid token.';
    }
}
?>