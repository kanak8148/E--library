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

// Check for form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Check if email exists in the database
    $stmt = $conn->prepare("SELECT * FROM studentreg WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Generate unique token and expiry date (e.g., 1 hour from now)
        $token = bin2hex(random_bytes(32));
        $expires_at = date('Y-m-d H:i:s', strtotime('+1 hour'));

        // Store the token and expiration in the database
        $stmt = $conn->prepare("INSERT INTO studentreg (email, token, expires_at) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $email, $token, $expires_at);
        $stmt->execute();

        // Send the password reset email
        $resetLink = "https://yourwebsite.com/reset_password.php?token=$token";

        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Gmail SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'vikasgawande666@gmail.com'; // Your email
            $mail->Password = 'sbyk zdjf monj nysg'; // Your email password (or app password)
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 465;

            // Recipients
            $mail->setFrom('your_email@gmail.com', 'Your Website');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Request';
            $mail->Body    = "Click the following link to reset your password: <a href='$resetLink'>$resetLink</a>";

            // Send email
            $mail->send();
            echo 'Password reset link has been sent to your email.';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo 'No account found with that email address.';
    }
}
?>