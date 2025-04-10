<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require_once 'dbh.inc.php';
require_once 'TacFunctions.inc.php';
require_once 'db_functions.inc.php';

$userArray = GetAllById($db, $_SESSION['UserId']);
$now = new DateTime();

if (isset($userArray['GeneratedTIme'])) {
    $generatedTime = DateTime::createFromFormat("Y-m-d H:i:s", $userArray['GeneratedTime']);
    $difference = $generatedTime->diff($now);
}

// Check if the last code generated is about to expire



$key = $_SESSION['Answer'];

$string = GenerateRandomString();

$authenticationCode = VigenereEncrypt($string, $key);

$generatedTime = $now->format('Y-m-d H:i:s');

// stores the generated code and the time it was generated in the database

StoreCode($db, $userArray['UserId'], $string, $key, $generatedTime);

if (isset($_POST['Choice']) && $_POST['Choice'] == "Email") {
    //Import PHPMailer classes into the global namespace

    require '../vendor/autoload.php';

    //Create a new PHPMailer instance
    $mail = new PHPMailer();

    //Tell PHPMailer to use SMTP
    $mail->isSMTP();

    //Enable SMTP debugging
    //SMTP::DEBUG_OFF = off (for production use)
    //SMTP::DEBUG_CLIENT = client messages
    //SMTP::DEBUG_SERVER = client and server messages
    $mail->SMTPDebug = SMTP::DEBUG_OFF;

    //Set the hostname of the mail server
    $mail->Host = 'smtp.gmail.com';
    //Use `$mail->Host = gethostbyname('smtp.gmail.com');`
    //if your network does not support SMTP over IPv6,
    //though this may cause issues with TLS

    //Set the SMTP port number:
    // - 465 for SMTP with implicit TLS, a.k.a. RFC8314 SMTPS or
    // - 587 for SMTP+STARTTLS
    $mail->Port = 465;

    //Set the encryption mechanism to use:
    // - SMTPS (implicit TLS on port 465) or
    // - STARTTLS (explicit TLS on port 587)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;

    //Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = 'mzmazwanbank@gmail.com';

    //Password to use for SMTP authentication
    $mail->Password = 'vagk jaqz xloy nktq';

    //Set who the message is to be sent from
    //Note that with gmail you can only use your account address (same as `Username`)
    //or predefined aliases that you have configured within your account.
    //Do not use user-submitted addresses in here
    $mail->setFrom('mzmazwanbank@gmail.com', 'MZMazwan');

    //Set who the message is to be sent to
    // This will be taken from the database
    $customerEmail = $userArray['Email'];
    $customerName = $userArray['FirstName'] . " " . $userArray['LastName'];
    $mail->addAddress($customerEmail, $customerName);

    // Subjext of the email
    $mail->Subject = "Authentication Code";

    // Body of the email
    $mail->Body = "Thank you for using MZBank. Here is your authentication code: $authenticationCode";

    //send the message, check for errors
    if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message sent!';
        //Section 2: IMAP
        //Uncomment these to save your message in the 'Sent Mail' folder.
        #if (save_mail($mail)) {
        #    echo "Message saved!";
        #}
    }
    header("Location: ../CodeEntryPage.php");
    exit();
}
