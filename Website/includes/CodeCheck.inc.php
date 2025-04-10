<?php
session_start();

require_once 'dbh.inc.php';
require_once 'TacFunctions.inc.php';
require_once 'db_functions.inc.php';

$userInfo = GetAllById($db, $_SESSION['UserId']);

$key = $userInfo['Key'];
$enteredCode = $_POST['Authentication'];
$requiredCode = $userInfo['Code'];

$decrypted = VigenereDecrypt($enteredCode, $key);

if ($requiredCode == $decrypted && $_SESSION['TAC'] == "Login") {
    session_regenerate_id(true);

    // Set session variables
    $_SESSION['UserId'] = $userInfo['UserId'];
    $_SESSION['AdminStatus'] = $userInfo['AdminStatus'];
    $_SESSION['LoggedIn'] = 1;
    
    // Create a new DateTime object for the current login time
    $newLoginTime = new DateTime();
    $newLoginTimeString = $newLoginTime->format('Y-m-d H:i:s');

    // Update database with new login time
    UpdateLastLogin($db, $_SESSION['UserId'], $newLoginTimeString);

    // Redirect to the welcome page
    header('Location: ../WelcomePage.php');
    exit();
}
elseif ($requiredCode == $decrypted && $_SESSION['TAC'] == "Transfer") {
    $transferArray = $_SESSION['TransactionDetails'];
    TransferBalance($db, $transferArray[0], $transferArray[1], $transferArray[2]);
    header('Location: ../TransferPage.php');
    $_SESSION['error'] = "Transaction Succesfull";
    unset($_SESSION['Attempts2']);
    exit();
}
 else {
    $_SESSION['Attempts2']++;
    $_SESSION['error'] = "Code is invalid";
    header('Location: ../CodeEntryPage.php');
    exit();
}
