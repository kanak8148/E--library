<?php
// Include the PHPMailer library
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php'; // If using Composer

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();                          // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';            // Specify SMTP server (e.g., Gmail's SMTP server)
    $mail->SMTPAuth = true;                   // Enable SMTP authentication
    $mail->Username = 'vikasgawande666@gmail.com'; // SMTP username (your email)
    $mail->Password = 'sbyk zdjf monj nysg';        // SMTP password (use app password if 2FA is enabled)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
    $mail->Port = 465;                        // TCP port to connect to

    // Recipients
    $mail->setFrom('your_email@gmail.com', 'Your Name'); // Sender's email address and name
    $mail->addAddress('recipient_email@example.com', 'Recipient Name'); // Recipient's email address and name
    // Optional: You can add more recipients with $mail->addAddress()

    // Content
    $mail->isHTML(true);  // Set email format to HTML
    $mail->Subject = 'Test Email via SMTP';
    $mail->Body    = 'This is a <b>test</b> email sent via SMTP in PHP using PHPMailer!';
    $mail->AltBody = 'This is a test email sent via SMTP in PHP using PHPMailer, without HTML support.';

    // Send the email
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>