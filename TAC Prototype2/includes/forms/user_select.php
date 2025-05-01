<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "../../config.php";
require_once "../functions_control.php";


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('HTTP/1.1 405 Method Not Allowed');
    $_SESSION['adminErrors']['method'] = "Invalid request method";
    header('Location: ../../public/error-page.php');
    exit();
}


if (!isset($_SESSION['userId'])) {
    $_SESSION['adminErrors']['session'] = "Please log in to access admin controls";
    header('Location: ../../public/login-form.php');
    exit();
}

if (!isAdmin($pdo, $_SESSION['userId'])) {
    $_SESSION['adminErrors']['privilege'] = "Admin privileges required";
    header('Location: ../../public/dashboard.php');
    exit();
}


if (!isset($_POST['recipient']) || empty(trim($_POST['recipient']))) {
    $_SESSION['adminErrors']['input'] = "Please enter a valid user ID";
    header('Location: ../../public/user-select-form.php');
    exit();
}


try {
    $userId = filter_var($_POST['recipient'], FILTER_VALIDATE_INT);
    
    if (!$userId || $userId <= 0) {
        $_SESSION['adminErrors']['invalidId'] = "User ID must be a positive number";
        header('Location: ../../public/user-select-form.php');
        exit();
    }

    if (!idExists($pdo, $userId)) {
        $_SESSION['adminErrors']['notFound'] = "User not found in system";
        header('Location: ../../public/user-select-form.php');
        exit();
    }


    $_SESSION['adminEditUserId'] = $userId;
    $_SESSION['adminEditLoginInterval'] = getLoginIntervalLimit($pdo, $userId); 
    $_SESSION['adminEditTransferLimit'] = getMaxTransfer($pdo, $userId); 
    $_SESSION['adminEditBlockStatus'] = 0; 
    header('Location: ../../public/parameter-form.php');
    exit();

} catch (PDOException $e) {
    error_log('Database error: ' . $e->getMessage());
    header('Location: ../../public/error-page.php?error=database');
    exit();
}