<?php
// Start the session to access user data
session_start();

// Initialize a response array
$response = array();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Include the database connection file
    require_once("db.php");

    // Retrieve user ID and new password from the form
    $user_id = $_SESSION['user_id'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    try {
        // Validate user input
        if (empty($current_password) || empty($new_password) || empty($confirm_new_password)) {
            throw new Exception("All fields are required.");
        }

        if ($new_password !== $confirm_new_password) {
            throw new Exception("New passwords do not match.");
        }

        // Query the database to retrieve the user's hashed password
        $sql = "SELECT password FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($hashed_password);

        if ($stmt->fetch() && password_verify($current_password, $hashed_password)) {
            $stmt->close();
            // Hash the new password securely
            $hashed_new_password = password_hash($new_password, PASSWORD_BCRYPT);

            // Update the user's password in the database
            $update_sql = "UPDATE users SET password = ? WHERE id = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("si", $hashed_new_password, $user_id);

            if ($update_stmt->execute()) {
                // Password updated successfully
                $response['success'] = true;
                $response['message'] = "Password updated successfully!";
            } else {
                throw new Exception("Error updating password: " . $update_stmt->error);
            }
            $update_stmt->close();
        } else {
            throw new Exception("Current password is incorrect.");
        }
        $conn->close();
    } catch (Exception $e) {
        // An error occurred
        $response['success'] = false;
        $response['message'] = $e->getMessage();
    }
} else {
    // User not logged in
    $response['success'] = false;
    $response['message'] = "User not logged in.";
}

// Send the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
