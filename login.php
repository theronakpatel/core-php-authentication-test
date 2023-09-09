<?php
// Include the database connection file
require_once("db.php");

// Start the session to manage user sessions
session_start();

try {
    // Retrieve user input from the login form
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Validate user input (you may add more validation as needed)
    if (empty($username) || empty($password)) {
        $response = array("success" => false, "message" => "Username and password are required.");
        echo json_encode($response);
        exit();
    }

    // Query the database to retrieve the user's hashed password
    $sql = "SELECT id, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception("Database error: " . $conn->error);
    }
    
    $stmt->bind_param("s", $username);
    if (!$stmt->execute()) {
        throw new Exception("Database error: " . $stmt->error);
    }
    
    $stmt->bind_result($user_id, $hashed_password);
    if ($stmt->fetch() && password_verify($password, $hashed_password)) {
        $stmt->close();
        // Login successful, set the user's session
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;

        // Update the last login date/time
        $last_login = date("Y-m-d H:i:s");
        $update_sql = "UPDATE users SET last_login = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        if (!$update_stmt) {
            throw new Exception("Database error: " . $conn->error);
        }
        
        $update_stmt->bind_param("si", $last_login, $user_id);
        if (!$update_stmt->execute()) {
            throw new Exception("Database error: " . $update_stmt->error);
        }
        
        $update_stmt->close();

        // Login successful response
        $response = array("success" => true, "message" => "Login successful.");
        echo json_encode($response);
    } else {
        $stmt->close();
        // Invalid login attempt
        $response = array("success" => false, "message" => "Invalid login credentials. Please try again.");
        echo json_encode($response);
    }

    // Close the statement and the connection
    
    $conn->close();
} catch (Exception $e) {
    // Handle exceptions, e.g., log the error or display a user-friendly message
    $response = array("success" => false, "message" => "An error occurred: " . $e->getMessage());
    echo json_encode($response);
}
?>
