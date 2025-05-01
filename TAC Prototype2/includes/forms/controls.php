<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "../../config.php";
require_once "../functions_control.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('HTTP/1.1 405 Method Not Allowed');
    header('Location: ../../public/error-page.php');
    exit();
}

if (!isset($_SESSION['userId']) || !isAdmin($pdo, $_SESSION['userId'])) {
    $_SESSION['adminErrors']['accessDenied'] = "Admin access required";
    header('Location: ../../public/login-form.php');
    exit();
}

$errors = [];

if (
    !isset($_POST['recipient']) || !isset($_POST['loginInterval']) ||
    !isset($_POST['maxTransfer']) || !isset($_POST['block_account'])
) {
    $errors['missingFields'] = "All fields are required";
    $_SESSION['adminErrors'] = $errors;
    header('Location: ../../public/user-select-form.php');
    exit();
}

$userId = filter_var($_POST['recipient'], FILTER_VALIDATE_INT);
$loginInterval = filter_var($_POST['loginInterval'], FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1, 'max_range' => 365]
]);
$maxTransfer = filter_var($_POST['maxTransfer'], FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1]
]);
$isBlocked = filter_var($_POST['block_account'], FILTER_VALIDATE_INT);

if (!$userId || !idExists($pdo, $userId)) {
    $errors['invalidUser'] = "Invalid user ID";
}

if (!$loginInterval) {
    $errors['invalidLoginInterval'] = "Login interval must be between 1-365 days";
}

if (!$maxTransfer) {
    $errors['invalidTransferLimit'] = "Transfer limit must be a positive number";
}

if ($isBlocked === false) {
    $errors['invalidBlockStatus'] = "Invalid block status selection";
}

if (!empty($errors)) {
    $_SESSION['adminErrors'] = $errors;
    header('Location: ../../public/user-select-form.php');
    exit();
}

try {
    $stmt = $pdo->prepare("UPDATE users SET 
                          loginInterval = :loginInterval,
                          maxTransfer = :maxTransfer,
                          isBlocked = :isBlocked
                          WHERE userId = :userId");

    $success = $stmt->execute([
        ':loginInterval' => $loginInterval,
        ':maxTransfer' => $maxTransfer*100, // Store in cents
        ':isBlocked' => $isBlocked,
        ':userId' => $userId
    ]);

    if ($success) {
        $_SESSION['adminSuccess'] = "User parameters updated successfully";
    } else {
        throw new Exception("Failed to update user parameters");
    }

if ($isBlocked == 1) { 
    // Send email to user
    require_once '../../vendor/autoload.php';
    $email = getEmail($pdo, $userId);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Invalid email address');
    }

    $mail = new PHPMailer\PHPMailer\PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
        $mail->SMTPAuth = true;
        $mail->Username = 'mzmazwanbank@gmail.com';
        $mail->Password = 'vagk jaqz xloy nktq';

        // Recipients
        $mail->setFrom('mzmazwanbank@gmail.com', 'MZBank');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(false);
        $mail->Subject = 'Your Account Has Been Blocked';
        $mail->Body = "An admin has blocked your account. Please contact MZBank support to unblock it.\n\n";
        
        // Actually send the email
        $mail->send();
        
    } catch (Exception $e) {
        error_log('Email sending failed: ' . $e->getMessage());
    }
}

header('Location: ../../public/user-select-form.php');
exit();

} catch (PDOException $e) {
    error_log('Database error during admin update: ' . $e->getMessage());
    $_SESSION['adminErrors']['database'] = "Database error occurred";
    header('Location: ../../public/error-page.php?error=database');
    exit();
}
