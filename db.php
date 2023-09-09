<?php

// Get servername from environment variable or use "localhost" as default
$servername = getenv("MYSQL_SERVERNAME") ?: "localhost";

// Get username from environment variable or use "root" as default
$username = getenv("MYSQL_USERNAME") ?: "root";

// Get password from environment variable or use "Ronak@123" as default
$password = getenv("MYSQL_PASSWORD") ?: "Ronak@123";

// Get dbname from environment variable or use "user_db" as default
$dbname = getenv("MYSQL_DBNAME") ?: "user_db";

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
