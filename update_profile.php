<?php
// Start the session to access user data
session_start();

// Initialize a response array
$response = array();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Include the database connection file
    require_once("db.php");

    // Retrieve user ID and new email from the form
    $user_id = $_SESSION['user_id'];
    $new_email = $_POST['new_email'];

    try {
        // Update the user's email in the database
        $update_sql = "UPDATE users SET email = ? WHERE id = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("si", $new_email, $user_id);

        if ($stmt->execute()) {
            // Profile updated successfully
            $response['success'] = true;
            $response['message'] = "Profile updated successfully!";
        } else {
            $response['success'] = false;
            $response['message'] = 'Error updating profile!';
        }

        $stmt->close();
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
