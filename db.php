<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

$servername = "localhost"; // Replace with your MySQL server name
$username = "ronak"; // Replace with your MySQL username
$password = "password"; // Replace with your MySQL password
$dbname = ""; // Replace with your MySQL database name

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>

