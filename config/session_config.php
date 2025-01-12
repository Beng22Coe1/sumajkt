<?php
// Start the session
session_start();

// Set timeout duration in seconds (e.g., 30 minutes = 1800 seconds)
$timeout_duration = 1800; // 30 minutes

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header('Location: /sumajkt/admin/login.php');
    exit();
}

// Check if "last_activity" is set in session
if (isset($_SESSION['last_activity'])) {
    // Calculate the session lifetime
    $elapsed_time = time() - $_SESSION['last_activity'];
    
    // If the session has expired, log out the user
    if ($elapsed_time > $timeout_duration) {
        // Unset all session variables
        session_unset();

        // Destroy the session
        session_destroy();

        // Redirect to the login page
        header('Location: /sumajkt/admin/login.php?session_expired=1');
        exit();
    }
}

// Update the last activity time stamp to the current time
$_SESSION['last_activity'] = time();
?>
