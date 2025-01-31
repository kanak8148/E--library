<?php
session_start();

if (!isset($_SESSION['student'])) {
    header("Location: index.html");
    exit;
}

echo("welcome");
echo "<p><a href='index.html'>Logout</a></p>";
?>
