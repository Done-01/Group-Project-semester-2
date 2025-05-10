<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../../config.php';
require_once '../functions_control.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('HTTP/1.1 405 Method Not Allowed');
    header('Location: ../../public/error-page.php');
    exit();
}

if (!isset($_SESSION['userId'])) {
    $_SESSION['userErrors']['notLoggedIn'] = "Please log in to perform transfers";
    header('Location: ../../public/login-form.php');
    exit();
}

$errors = [];

if (!isset($_POST['recipient']) || !isset($_POST['amount'])) {
    $errors['missingFields'] = "Required fields are missing";
    $_SESSION['userErrors'] = $errors;
    header('Location: ../../public/transfer-form.php');
    exit();
}

$userId = $_SESSION['userId'];
$recipientId = filter_var($_POST['recipient'], FILTER_VALIDATE_INT);
$rawAmount = filter_var($_POST['amount'], FILTER_VALIDATE_INT);

$amount = ($rawAmount !== false) ? (int)($rawAmount * 100) : null;

if ($recipientId === false || $recipientId <= 0) {
    $errors['invalidRecipient'] = "Please enter a valid recipient ID";
} elseif (!idExists($pdo, $recipientId)) {
    $errors['invalidRecipient'] = "Recipient account not found";
} elseif ($recipientId == $userId) {
    $errors['invalidRecipient'] = "Cannot transfer to yourself";
}

if ($amount === null || $amount <= 0) {
    $errors['invalidAmount'] = "Please enter a valid positive amount";
}

if (!empty($errors)) {
    $_SESSION['userErrors'] = $errors;
    header('Location: ../../public/transfer-form.php');
    exit();
}

try {
    $maxTransfer = getMaxTransfer($pdo, $userId); 
    $balance = getBalance($pdo, $userId);

    if ($balance < $amount) {
        $errors['insufficientFunds'] = "Insufficient funds for transfer";
  
    }

    // if amount is greater than max transfer limit, redirect to tac process
    if ($amount > $maxTransfer) {
        $_SESSION['transaction'] = [
            'recipient' => $recipientId,
            'amount' => $amount,
        ];
        $_SESSION['tacType'] = 'transfer';
        header('Location: ../../public/image-form.php');
        exit();
    }

    if (!empty($errors)) {
        $_SESSION['userErrors'] = $errors;
        header('Location: ../../public/transfer-form.php');
        exit();
    }

    $transferSuccess = transferBalance($pdo, $userId, $recipientId, $amount);

    if ($transferSuccess) {
        $formattedAmount = number_format($rawAmount, 2);
        $_SESSION['success'] = "Successfully transferred £$formattedAmount to account #$recipientId";
    } else {
        throw new Exception("Transfer failed to complete");
    }

    header('Location: ../../public/transfer-form.php');
    exit();

} catch (PDOException $e) {
    error_log('Database error during transfer: ' . $e->getMessage());
    $_SESSION['userErrors']['database'] = "Transaction processing error";
    header('Location: ../../public/error-page.php?error=database');
    exit();
}