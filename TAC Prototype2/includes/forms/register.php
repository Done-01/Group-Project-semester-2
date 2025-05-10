<?php
// Enable error reporting for development
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('HTTP/1.1 405 Method Not Allowed');
    header('Location: ../../public/error-page.php');
    exit();
}

$username = isset($_POST['username']) ? htmlspecialchars(trim($_POST['username'])) : '';
$email = isset($_POST['email']) ? filter_var(trim($_POST['email'])) : '';
$fName = isset($_POST['fName']) ? htmlspecialchars(trim($_POST['fName'])) : '';
$lName = isset($_POST['lName']) ? htmlspecialchars(trim($_POST['lName'])) : '';
$password = $_POST['password'] ?? '';
$rePassword = $_POST['rePassword'] ?? '';

try {
    require_once '../../config.php';
    require_once '../functions_control.php';

    // Initialize error array
    $errors = [];

    // Validate inputs
    if (isInputEmpty($username, $email, $password, $rePassword)) {
        $errors['emptyInput'] = 'Please fill all required fields';
    }

    if (!isEmailValid($email)) {
        $errors['email'] = 'Please enter a valid email address';
    }

    if (!isMatch($password, $rePassword)) {
        $errors['password'] = 'Passwords do not match';
    } elseif (strlen($password) < 8) {
        $errors['password'] = 'Password must be at least 8 characters';
    }

    if (usernameExists($pdo, $username)) {
        $errors['username'] = 'Username already taken';
    }

    if (emailExists($pdo, $email)) {
        $errors['email'] = 'Email already registered';
    }

    // If errors exist, return to form
    if (!empty($errors)) {

        $_SESSION['userErrors'] = $errors;
        $_SESSION['signupData'] = [
            "username" => $username,
            "email" => $email,
            "fName" => $fName,
            "lName" => $lName
        ];

        header('Location: ../../public/signup-form.php');
        exit();
    }

    // Attempt to create new user
    registerUser($pdo, $username, $email, $fName, $lName, $password);

    unset($_SESSION['userErrors']);
    unset($_SESSION['signupData']);

    $_SESSION['userId'] = getUserId($pdo, $username);

    // Regenerate session ID 
    session_regenerate_id(true);
    $_SESSION['success'] = 'Registration successful! You can now log in.';
    // Redirect to login page
    header('Location: ../../public/login-form.php');
    exit();
} catch (PDOException $e) {
    error_log('Database error during signup: ' . $e->getMessage());
    header('Location: ../../public/error-page.php?error=database');
    exit();
}
