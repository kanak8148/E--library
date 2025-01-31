<?php
// Database connection
$servername = "localhost";
$username = "root"; // change this to your database username
$password = ""; // change this to your database password
$dbname = "elibrery"; // change this to your database name

$conn = new mysqli("localhost","root",  "", "elibrery");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $sid = $_POST['student_id'];
    $pass = $_POST['password'];
    $confirm_pass = $_POST['confirm_password'];

    if ($pass === $confirm_pass) {
        $sql = "INSERT INTO studentreg (email, student_id , password ) VALUES ('$email', '$sid' , '$pass' )";
        $sql = "INSERT INTO issued_books(student_id) VALUES ('$sid')";
        if ($conn->query($sql) === TRUE) {
            echo "Registration successful! <a href='index.html'>Login here</a>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Passwords do not match!";
    }
}

$conn->close();
?>
