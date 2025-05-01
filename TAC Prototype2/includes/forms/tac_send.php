<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../../vendor/autoload.php';
require_once '../../config.php';
require_once '../functions_control.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('HTTP/1.1 405 Method Not Allowed');
    header('Location: ../../public/error-page.php');
    exit();
}


$errors = [];

if (!isset($_SESSION['userId'])) {
    $_SESSION['userErrors']['notLoggedIn'] = "Please log-in";
    header('Location: ../../public/login-form.php');
    exit();
}

$userId = $_SESSION['userId'];
unset($_SESSION['userId']);

if (empty($_POST['choice'])) {
    $errors['noSelection'] = "Please make a selection before submitting";
}

if (!empty($errors)) {
    $_SESSION['userErrors'] = $errors;
    header('Location: ../../public/tac-choice.php');
    exit();
}

try {
    
    $tac = getTAC($pdo, $userId);
    $key = getKey($pdo, $userId);
    $encryptedTAC = encryptTAC($tac, $key);
    $email = getEmail($pdo, $userId);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Invalid email address');
    }

    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    
    // Server settings (HARDCODED - REMOVE IN PRODUCTION)
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';                  // SMTP server
    $mail->Port = 465;                               // SMTP port
    $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
    $mail->SMTPAuth = true;
    $mail->Username = 'mzmazwanbank@gmail.com';        // SMTP username
    $mail->Password = 'vagk jaqz xloy nktq';           // SMTP password (use app password for Gmail)

    // Recipients (HARDCODED - REMOVE IN PRODUCTION)
    $mail->setFrom('mzmazwanbank@gmail.com', 'MZBank');  // From address
    $mail->addAddress($email);                         // To address

    // Content
    if ($_SESSION['tacType'] == "transfer") {
        $transactionDetails = $_SESSION['transaction'];
        $amount = $transactionDetails['amount'];
        $recipientId = $transactionDetails['recipient'];
        $amount = number_format($amount / 100, 2, '.', '');
        $mail->Subject = 'MZBank Transfer Authentication Code';
        $mail->Body = "You are attempting to transfer £$amount to user ID $recipientId. Here is your authentication code: $encryptedTAC";
    } else {
        $mail->Subject = 'MZBank Authentication Code';
        $mail->Body = "Thank you for using MZBank. Here is your authentication code: $encryptedTAC";
    }

    if (!$mail->send()) {
        throw new Exception('Mail send failed');
    }

    $_SESSION['userId'] = $userId;

    header("Location: ../../public/tac-form.php");
    exit();

} catch (Exception $e) {
    error_log('Database error: ' . $e->getMessage());
    header('Location: ../../public/error-page.php?error=database');
    exit();
}