<?php
// Include database connection
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect the form data
    $student_id = $_POST['student_id'];
    $book_id = $_POST['book_id'];
    $issue_date = $_POST['issue_date'];
    $return_date = $_POST['return_date'];

    // Check if the book is available
    $stmt = $conn->prepare("SELECT available_copies FROM book WHERE book_id = :book_id");
    $stmt->bindParam(':book_id', $book_id);
    $stmt->execute();
    
    // Fetch the result
    $book = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if $book is false (no matching book found)
    if ($book === false) {
        echo "Sorry, this book is not available in the library.";
    } else {
        if ($book['available_copies'] > 0) {
            // Insert book issue record
            $stmt = $conn->prepare("INSERT INTO issued_books (student_id, book_id, issue_date, return_date) VALUES (:student_id, :book_id, :issue_date, :return_date)");
            $stmt->bindParam(':student_id', $student_id);
            $stmt->bindParam(':book_id', $book_id);
            $stmt->bindParam(':issue_date', $issue_date);
            $stmt->bindParam(':return_date', $return_date);
            $stmt->execute();

            // Update available copies in the books table
            $stmt = $conn->prepare("UPDATE book SET available_copies = available_copies - 1 WHERE book_id = :book_id");
            $stmt->bindParam(':book_id', $book_id);
            $stmt->execute();

            echo "Book issued successfully!";
        } else {
            echo "Sorry, this book is currently unavailable.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Issue Book</title>
   <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Library Management System</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="book-issue.php">Issue Book</a></li>
                <li><a href="admin.php">Admin Panel</a></li>
            </ul>
        </nav>
    </header>
    
    <div class="container">
        <h2>Issue a Book</h2>
        <form action="book-issue.php" method="POST">
            <label for="student_id">Student ID</label>
            <input type="text" id="student_id" name="student_id" required>

            <label for="book_id">Book ID</label>
            <input type="text" id="book_id" name="book_id" required>

            <label for="issue_date">Issue Date</label>
            <input type="date" id="issue_date" name="issue_date" required>

            <label for="return_date">Return Date</label>
            <input type="date" id="return_date" name="return_date" required>

            <button type="submit">Issue Book</button>
        </form>
    </div>

</body>
</html>
