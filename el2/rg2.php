<?php
// Database connection
$servername = "localhost";
$username = "root"; // change this to your database username
$password = ""; // change this to your database password
$dbname = "elibrary"; // change this to your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user input to prevent SQL injection
    $email = $conn->real_escape_string($_POST['email']);
    $sid = $conn->real_escape_string($_POST['student_id']);
    $pass = $_POST['password'];
    $confirm_pass = $_POST['confirm_password'];

    // Check if passwords match
    if ($pass === $confirm_pass) {
        // Hash the password before storing it
        $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

        // Use prepared statements to avoid SQL injection
        $stmt = $conn->prepare("INSERT INTO student (email, student_id, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $email, $sid, $hashed_pass);

        if ($stmt->execute()) {
            echo "Registration successful! <a href='index.html'>Login here</a>";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Passwords do not match!";
    }
}

$conn->close();
?>
