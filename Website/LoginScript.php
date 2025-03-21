<?php
session_start(); // Start the session to handle session variables

// Check if form is submitted
if (isset($_POST["submit"])) {

    $userId = $_POST["UserId"];  // The name attribute matches the form input
    $password = $_POST["Password"];  // Password input field

    // Create a new SQLite3 database connection
    $db = new SQLite3('MZ Bank Database.db');

    // Check if the database opened successfully
    if (!$db) {
        die("Could not open database.");
    }

    // Prepare the SQL query to select the user by UserId
    $stmt = $db->prepare('SELECT * FROM Users WHERE UserId = :UserId');

    // Bind the value of UserId to the query
    $stmt->bindValue(':UserId', $userId, SQLITE3_TEXT);

    // Execute the query
    $result = $stmt->execute();

    // Fetch the user from the result
    $user = $result->fetchArray(SQLITE3_ASSOC);

    // If the user is found, check the password
    if ($user) {
        // Check if the password matches (Assuming plaintext passwords, which is insecure; use password hashing in production)
        if ($password === $user['Password']) {
            // Store user information in session variables
            $_SESSION['UserId'] = $user['UserId'];
            $_SESSION['FirstName'] = $user['FirstName'];
            $_SESSION['AdminStatus'] = $user['AdminStatus'];

            // Redirect to the welcome page
            header('Location: WelcomePage.php');
            exit;  // Important: exit after header to stop further script execution
        } else {
            // Invalid password
            header('Location: LoginPage.php?error=invalid_password');
            exit;
        }
    } else {
        // User not found
        header('Location: LoginPage.php?error=user_not_found');
        exit;
    }
}
?>
