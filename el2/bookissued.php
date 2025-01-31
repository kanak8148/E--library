<?php
// Check if the form is submitted
$servername = "localhost";
$username = "root"; // change this to your database username
$password = ""; // change this to your database password
$dbname = "elibrery"; // change this to your database name

$conn = new mysqli("localhost","root",  "", "elibrery");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $student_id = isset($_POST['student_id'])? $_POST['student_id']:'';
    $booksRemain = isset($_POST['books_remain']) ? $_POST['books_remain'] : '';
    $maxBooks = isset($_POST['maximum_books']) ? $_POST['maximum_books'] : '';
    $bookID = isset($_POST['book_id']) ? $_POST['book_id'] : '';

    // Validation for required fields
    if (empty($booksRemain) || empty($maxBooks) || empty($bookID)) {
        echo "All fields are required.";
    } else {
        // Further validations if needed (e.g., positive numbers)
        if (!is_numeric($booksRemain) || !is_numeric($maxBooks)) {
            echo "Books remaining and Maximum books must be numeric.";
        } else {
            // Process the data (e.g., database insertion)
            echo "Book issued successfully.<br>";
            echo "Book ID: " . htmlspecialchars($bookID) . "<br>";
            echo "Books remaining: " . htmlspecialchars($booksRemain) . "<br>";
            echo "Maximum books allowed to issue: " . htmlspecialchars($maxBooks) . "<br>";
        }
    }
}
?>
