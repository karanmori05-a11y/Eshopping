<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";   // XAMPP default
$username   = "root";        // XAMPP default user
$password   = "";            // usually empty in XAMPP
$database   = "sai";         // your database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Uncomment this line for testing only (remove in production)
//echo "Connected successfully";
?>
