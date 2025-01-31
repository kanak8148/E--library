<?php
// update_link.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newspaper_link = $_POST['newspaper_link'];

    // You can choose to store the link in a database or a text file.

    // Option 1: Store in a database (using MySQL)
    $servername = "localhost";  // Database server
    $username = "root";         // Your DB username
    $password = "";             // Your DB password
    $dbname = "elibrery";  // Your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $date = date("Y-m-d");  // Get today's date

    // Update the link for the current date
    $stmt = $conn->prepare("INSERT INTO newspaper_links (link, date) VALUES (?, ?) ON DUPLICATE KEY UPDATE link=?");
    $stmt->bind_param("sss", $newspaper_link, $date, $newspaper_link);
    $stmt->execute();

    // Close connection
    $stmt->close();
    $conn->close();

    echo "Newspaper link updated successfully!";
}
?>

