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
    $response = array('success' => false, 'message' => 'Passwords do not match.');
    echo json_encode($response);
    exit();
}

// Check if username already exists
$query_username = "SELECT username FROM users WHERE username = ?";
$stmt_username = $conn->prepare($query_username);
$stmt_username->bind_param("s", $username);
$stmt_username->execute();
$stmt_username->store_result();

// Check if email already exists
$query_email = "SELECT email FROM users WHERE email = ?";
$stmt_email = $conn->prepare($query_email);
$stmt_email->bind_param("s", $email);
$stmt_email->execute();
$stmt_email->store_result();

if ($stmt_username->num_rows > 0) {
    $response = array('success' => false, 'message' => 'Username already exists.');
    echo json_encode($response);
    exit();
}

if ($stmt_email->num_rows > 0) {
    $response = array('success' => false, 'message' => 'Email already exists.');
    echo json_encode($response);
    exit();
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

    // Prepare success response
    $response = array('success' => true, 'message' => 'Registration successful');
} else {
    // Prepare error response
    $response = array('success' => false, 'message' => 'Error: ' . $sql . '<br>' . $conn->error);
}

// Close the database connections
$stmt->close();
$stmt_username->close();
$stmt_email->close();
$conn->close();

// Send the JSON response
echo json_encode($response);
?>
