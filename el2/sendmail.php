<?php
// Database connection (replace with your own database details)
$host = 'localhost';
$db = 'elibrery';
$user = 'root';
$pass = '';

$conn = new mysqli("localhost","root",  "", "elibrery");

// Check if token and new password are provided
if (isset($_POST['token']) && isset($_POST['password'])) {
    $token = $_POST['token'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Get the token details from the database
    $stmt = $conn->prepare("SELECT * FROM studentreg WHERE token = ?");
    $stmt->bind_param('s', $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Token is valid, now reset the password
        $reset = $result->fetch_assoc();
        $email = $reset['email'];

        // Update the password in the users table
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
        $stmt->bind_param('ss', $password, $email);
        $stmt->execute();

        // Optionally, delete the token from password_resets table
        $stmt = $conn->prepare("DELETE FROM password_resets WHERE token = ?");
        $stmt->bind_param('s', $token);
        $stmt->execute();

        echo 'Your password has been successfully reset!';
    } else {
        echo 'Invalid token or expired link.';
    }
}
?>