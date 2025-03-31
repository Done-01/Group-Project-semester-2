<?php

// Placed at the start of most pages.

// Set the session timeout duration (in seconds)
$timeout_duration = 300; // 300 seconds = 5 minutes

// Check if the session 'lastAction' timestamp exists
if (isset($_SESSION['lastAction'])) {
    $inactive_duration = time() - $_SESSION['lastAction'];
    
    // If the session has been inactive for more than the timeout duration, destroy the session
    if ($inactive_duration > $timeout_duration) {
        // Destroy the session and log the user out
        session_unset();
        session_destroy();
        header("Location: LoginPage.php"); // Redirect to login page (or any other page)
        exit();
    }
}

// Update the last activity timestamp
$_SESSION['lastAction'] = time();
?>