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

$errors = [];
$_SESSION['attempts'] ??= 3;

if ($_SESSION['attempts'] <= 1) {
    unset($_SESSION['attempts']);
    header('Location: ../logout.php');
    exit();
}

if (isInputEmpty($_POST['input'])) {
    $errors['noSelection'] = "Please fill field before submitting";
} else {
    $input =  $_POST['input'];
    $tac = getTAC($pdo, $_SESSION['userId']);
    $key = getKey($pdo, $_SESSION['userId']);

    $decryptedInput = decryptTAC($input, $key);

    if ($decryptedInput !== $tac) {
        $errors['tacMismatch'] = "Incorrect code entered";
    }
}

if (!empty($errors)) {
    $_SESSION['attempts']--;
    $_SESSION['userErrors'] = $errors;
    header('Location: ../../public/tac-form.php');
    exit();
}

// Tac successfully completed at this point. set neccecary variables and redirect back to appropriate page.

//Login tac
if ($_SESSION['tacType'] == "login") {
    // Successful login
    updateLoginTime($pdo, $userId);
    $_SESSION['loggedIn'] = true;
    $_SESSION['userId'] = $userId;

    session_regenerate_id(true);

    // Redirect to secure area
    header('Location: ../../public/home.php');
    exit();
}
//Transaction tac
