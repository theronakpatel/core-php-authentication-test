<?php
// Start the session to access user data
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to a logout confirmation page or any other desired location
header("Location: index.php");
exit();
?>
