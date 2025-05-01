<?php
require_once '../config.php';
require_once '../includes/functions_control.php';
require_once '../includes/functions_view.php';

if (!isset($_SESSION['userId'])) {
    $_SESSION['userErrors']['notLoggedIn'] = "Please log in to access your account.";
    header('Location: ../../public/login-form.php');
    exit();
}

$userId = $_SESSION['userId'];

try {
    // Fetch user details
    $stmt = $pdo->prepare("SELECT email, balance FROM users WHERE userId = :userId");
    $stmt->execute(['userId' => $userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $email = htmlspecialchars($user['email']);
    $balance = htmlspecialchars($user['balance'] / 100); // Convert pence to pounds
} catch (Exception $e) {
    error_log('Database error: ' . $e->getMessage());
    header('Location: ../../public/error-page.php?error=database');
    exit();
}