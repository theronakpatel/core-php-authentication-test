<?php
// Include the database connection file
require_once("db.php");

// Retrieve user input from the registration form
$username = $_POST['username'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$email = $_POST['email'];

// Validate user input
if ($password !== $confirm_password) {
    die("Error: Passwords do not match.");
}

// Hash the password securely
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Prepare and execute a SQL INSERT statement
$sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $username, $hashed_password, $email);

if ($stmt->execute()) {
    // Registration successful, set the user's session
    session_start();
    $_SESSION['user_id'] = $stmt->insert_id; // Store the newly created user's ID in the session
    $_SESSION['username'] = $username;

    // Redirect to the user's profile page
    header("Location: profile.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$stmt->close();
$conn->close();
?>
