<?php
session_start();

require_once 'dbh.inc.php';
require_once 'db_functions.inc.php';

$userId = $_POST["UserId"];  
$password = $_POST["Password"];

if (!isset($_POST['UserId']) || !isset($_POST['Password'])) {
    // Redirect to login page
    header('Location: ../LoginPage.php');
    exit();
}

$userId = trim($_POST["UserId"]);
$password = trim($_POST["Password"]);

$userInfo = GetAllById($db, $userId);

if (!$userInfo) {
    // Redirect to login page with error
    $_SESSION['error'] = "Invalid User Id";
    header('Location: ../LoginPage.php');
    exit();
}

if ($password !== $userInfo['Password']) {
    // Redirect to login page with error
    $_SESSION['error'] = "Invalid Password";
    header('Location: ../LoginPage.php');
    exit();
}

// Create a new DateTime object for the current login time
$newLoginTime = new DateTime();
$newLoginTimeString = $newLoginTime->format('Y-m-d H:i:s');

// Get last login time from the database
$oldLoginTimeString = $userInfo['LastLogin'];
$oldLoginTime = DateTime::createFromFormat('Y-m-d H:i:s', $oldLoginTimeString);

// Calculate time difference since last login
$difference = $oldLoginTime->diff($newLoginTime);

if ($difference->days > $userInfo['LoginLimit']) {
    $_SESSION['UserId'] = $userInfo['UserId'];
    header('Location: ../ImageEntryPage.php');
    exit();
}

session_regenerate_id(true);

// Set session variables
$_SESSION['UserId'] = $userInfo['UserId'];
$_SESSION['AdminStatus'] = $userInfo['AdminStatus'];
$_SESSION['LoggedIn'] = 1;

// Update database with new login time
UpdateLastLogin($db, $_SESSION['UserId'], $newLoginTimeString);

// Redirect to the welcome page
header('Location: ../WelcomePage.php');
exit();
?>
