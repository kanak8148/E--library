<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root"; // change this to your database username
$password = ""; // change this to your database password
$dbname = "elibrary"; // change this to your database name

$conn = new mysqli("localhost","root",  "", "elibrery");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM adminlogin WHERE email = '$email' AND password = '$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['adminlogin'] = $email;
        header("Location: dashboard1.php"); // Redirect to a dashboard page after successful login
    } else {
        echo "Invalid username or password!";
    }
}

$conn->close();
?>
