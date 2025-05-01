<?php
require_once '../config.php';
require_once '../includes/functions_control.php';
require_once '../includes/functions_view.php';

if (!isset($_SESSION['userId'])) {
    $_SESSION['userErrors']['notLoggedIn'] = "Please log in to access the home page.";
    header('Location: ../../public/login-form.php');
    exit();
}

$userId = $_SESSION['userId'];

try {
    // Fetch user's first name
    $stmt = $pdo->prepare("SELECT fName FROM users WHERE userId = :userId");
    $stmt->execute(['userId' => $userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        throw new Exception("User not found.");
    }

    $fName = htmlspecialchars($user['fName']);
} catch (Exception $e) {
    error_log('Database error: ' . $e->getMessage());
    header('Location: ../../public/error-page.php?error=database');
    exit();
}