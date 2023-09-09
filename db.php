<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

$servername = "localhost"; // Replace with your MySQL server name
$username = "ronak"; // Replace with your MySQL username
$password = "password"; // Replace with your MySQL password
$dbname = "user_db"; // Replace with your MySQL database name

// Create a connection
try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        throw new Exception("Database connection failed: " . $conn->connect_error);
    }
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}

?>
