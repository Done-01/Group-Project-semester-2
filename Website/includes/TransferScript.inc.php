<?php
session_start();

require_once 'dbh.inc.php';
require_once 'db_functions.inc.php';
require_once 'BalanceScript.inc.php';

$userInfo = GetAllById($db, $_SESSION['UserId']);

// check if form wasn't submitted or user isn't logged in
if (!isset($_POST['submit']) || !isset($_SESSION["UserId"])) {
    header('Location: ../TransferPage.php');
    exit();
}

// check if a TAC has been completed

if (!isset($_SESSION['AuthenticationStatus'])) {
    $_SESSION['AuthenticationStatus'] = 0;
}

$senderId = $_SESSION["UserId"];
$recipientId = $_POST["RecipientId"];
$transferAmount = $_POST["TransferAmount"];

// Check if recipient doesn't exist
if (!DoesUserExist($db, $recipientId)) {
    $_SESSION['error'] = "Invalid User";
    header('Location: ../TransferPage.php');
    exit();
}

// Check for invalid amount (negative or insufficient funds)
if ($balance < $transferAmount || $transferAmount <= 0) {
    $_SESSION['error'] = "Invalid amount";
    header('Location: ../TransferPage.php');
    exit();
}

// Check amount isnt over the users limit
if ($transferAmount > $userInfo['TransactionLimit'] && $_SESSION['AuthenticationStatus'] == 0) {
    $_SESSION['TAC'] = "Transfer";
    $_SESSION['TransactionDetails'] = [$senderId, $recipientId, $transferAmount];
    header('Location: ../ImageEntryPage.php');
    exit();
}

// If all checks passed, perform the transfer
TransferBalance($db, $senderId, $recipientId, $transferAmount);
header('Location: ../TransferPage.php');
exit();
?>