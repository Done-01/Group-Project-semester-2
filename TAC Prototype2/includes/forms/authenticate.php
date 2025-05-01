<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    header('Location: ../../public/error-page.php');
    exit();
}

// Sanitize inputs
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

try {
    // Require files with proper error handling
    require_once '../../config.php';
    require_once '../functions_control.php';

    $errors = [];

    // Validate inputs
    if (empty($username) || empty($password)) {
        $errors['emptyInput'] = 'Please enter both username and password';
    }

    if (empty($errors)) {
        // Authenticate user
        if (!authenticateUser($pdo, $username, $password)) {
            $errors['invalidCredentials'] = 'Invalid username or password';
        } else {
            // Get user ID
            $userId = getUserId($pdo, $username);

            // Check if the user is blocked
            $isBlocked = isUserBlocked($pdo, $userId);
            if ($isBlocked) {
                $errors['blockedUser'] = 'Your account has been blocked. Please contact support.';
            }
        }
    }

    // Handle errors
    if (!empty($errors)) {
        $_SESSION['userErrors'] = $errors;
        header('Location: ../../public/login-form.php');
        exit();
    }

    // Check login interval
    $loginLimit = getLoginIntervalLimit($pdo, $userId);
    $lastLogin = getLastLoginTime($pdo, $userId);

    // Calculate time differences
    $currentTime = new DateTime();
    $lastLoginTime = new DateTime($lastLogin);
    $interval = $lastLoginTime->diff($currentTime);

    $dayDifference = $interval->days;
    $minDifference = ($interval->days * 24 * 60) + ($interval->h * 60) + $interval->i;

    // Check if TAC is needed
    if ($dayDifference > $loginLimit || $minDifference < 5) {
        // Redirect to start TAC process
        $_SESSION['tacType'] = "login";
        $_SESSION['userId'] = $userId;
        header('Location: ../../public/image-form.php');
        exit();
    } else {
        // Successful login
        updateLoginTime($pdo, $userId);
        $_SESSION['loggedIn'] = true;
        $_SESSION['userId'] = $userId;

        session_regenerate_id(true);

        // Redirect to homepage
        header('Location: ../../public/home.php');
        exit();
    }
} catch (PDOException $e) {
    error_log('Database error during login: ' . $e->getMessage());
    header('Location: ../../public/error-page.php?error=database');
    exit();
}