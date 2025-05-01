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
    $_SESSION['userErrors']['notLoggedIn'] = "Please log-in";
    header('Location: ../../public/login-form.php');
    exit();
}

$userId = $_SESSION['userId'];
$_SESSION['attempts'] ??= 2;

if ($_SESSION['attempts'] <= 1) {
    unset($_SESSION['attempts']);
    header('Location: ../logout.php');
    exit();
}

if (isInputEmpty($_POST['input'])) {
    $errors['noSelection'] = "Please fill field before submitting";
}
$input =  $_POST['input'];
$tac = getTAC($pdo, $userId);
$key = getKey($pdo, $userId);
$interval = getTimeElapsed(getTimeGenerated($pdo, $userId));
$decryptedInput = decryptTAC($input, $key);

if ($decryptedInput !== $tac) {
    $errors['tacMismatch'] = "Incorrect code entered";
}

if ($interval > 5) {
    $errors['tacExpired'] = "TAC expired - please request a new one";
}

if (!empty($errors)) {
    $_SESSION['attempts']--;
    $_SESSION['userErrors'] = $errors;
    header('Location: ../../public/tac-form.php');
    exit();
}

// Tac successfully completed at this point. set neccecary variables and redirect back to appropriate page.

//Login tac
if ($_SESSION['tacType'] === "login") {
    unset($_SESSION['tacType']);
    // delete TAC and key from database
    $tac = "";
    $key = "";
    updateKey($pdo, $userId, $key);
    updateTAC($pdo, $userId, $tac);
    // Successful login
    updateLoginTime($pdo, $userId);
    $_SESSION['loggedIn'] = true;
    $_SESSION['userId'] = $userId;

    session_regenerate_id(true);

    // Redirect to secure area
    header('Location: ../../public/home.php');
    exit();
}

// Transaction TAC
else if ($_SESSION['tacType'] === "transfer") {
    unset($_SESSION['tacType']);

    $recipientId = $_SESSION['transaction']['recipient'];
    $amount = $_SESSION['transaction']['amount'];

    transferBalance($pdo, $userId, $recipientId, $amount);
    $_SESSION['success'] = "Transfer processed successfully";

    // Redirect back to transaction page
    header('Location: ../../public/transfer-form.php');
    exit();
}