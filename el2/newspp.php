<?php
// index.php

// Fetch today's link from the database
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

// Get the link for today
$sql = "SELECT link FROM newspaper_links WHERE date = '$date'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output the link
    while($row = $result->fetch_assoc()) {
        echo "<h3>Today's Newspaper Link: <a href='" . $row["link"] . "' target='_blank'>" . $row["link"] . "</a></h3>";
    }
} else {
    echo "No newspaper link available for today.";
}

$conn->close();
?>