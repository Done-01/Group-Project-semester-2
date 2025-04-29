<?php
require_once '../../config.php';
require_once '../functions_control.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('HTTP/1.1 405 Method Not Allowed');
    header('Location: ../../public/error-page.php');
    exit();
}

$errors = [];
$_SESSION['attempts'] ??= 3;


if (!isset($_SESSION['userId'])) {
    $_SESSION['userErrors']['notLoggedIn'] = "Please log-in";
    header('Location: ../../public/login-form.php');
    exit();
}

if ($_SESSION['attempts'] <= 1) {
    unset($_SESSION['attempts']);
    header('Location: ../logout.php');
    exit();
}

if (!isset($_POST['option'])) {
    // no slection error
    $errors['noSelection'] = "Please make a selection before submitting";
} elseif ($_SESSION['answer'] !== $_POST['option']) {
    // wrong selection error
    $errors['incorrectSelection'] = "The word did-not match the image";
}

if (!empty($errors)) {
    $_SESSION['attempts']--;
    $_SESSION['userErrors'] = $errors;
    header('Location: ../../public/image-form.php');
    exit();
}

try {
    $key = $_POST['option'];
    $now = new DateTime();
    $now = $now->format('Y-m-d H:i:s');
    $tac = generateTAC();
    // save the key, tac and time generated to the database.
    updateKey($pdo, $_SESSION['userId'], $key);
    updateTimeGenerated($pdo, $_SESSION['userId'], $now );
    updateTAC($pdo, $_SESSION['userId'],$tac);
    // redirect to the user to select method of recieveing TAC
    header('Location: ../../public/tac-choice.php');
    exit();

} catch (PDOException $e) {
    error_log('Database error: ' . $e->getMessage());
    header('Location: ../../public/error-page.php?error=database');
    exit();
}
