<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "easter.gg";

// Create connection
$conn = new mysqli('localhost','root','','easter.gg');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>