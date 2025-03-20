<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
$db = new SQLite3('MZBankDatabase.db');
//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

// Execute the queries for email and name
$addressResult = $db->query('SELECT Email FROM Users WHERE UserId="user001"');
$forenameResult = $db->query('SELECT FirstName FROM Users WHERE UserId="user001"');
$lastnameResult = $db->query('SELECT LastName FROM Users WHERE UserId="user001"');

// Fetch the results as associative arrays
$addressRow = $addressResult->fetchArray(SQLITE3_ASSOC);
$forenameRow = $forenameResult->fetchArray(SQLITE3_ASSOC);
$lastnameRow = $lastnameResult->fetchArray(SQLITE3_ASSOC);

// Extract the values from the arrays
$stringAddress = $addressRow['Email'];
$stringForename = $forenameRow['FirstName'];
$stringLastname = $lastnameRow['LastName'];

// Concatenate the forename and lastname
$fullname = $stringForename . ' ' . $stringLastname;

try {
    //Server settings
    //  $mail->SMTPDebug = SMTP::DEBUG_SERVER;      
    //Enable verbose debug output
    $server_email = 'mzmazwanbank@gmail.com';
    $server_email_pwd = 'vagk jaqz xloy nktq';

    // $server_email = 'mazwanjilani@gmail.com';
    // $server_email_pwd = 'wifrmolspljcfqdu';
    
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = $server_email;                     //SMTP username
    $mail->Password   = $server_email_pwd;                               //SMTP password
    //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->SMTPSecure =  'ssl';//'tls'; //'ssl';           //Enable implicit TLS encryption
    $mail->Port       = 465; //465; //587;                                 //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom($server_email, 'MZMazwan');
    $mail->addAddress($stringAddress,$fullname);     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo($server_email, 'MZMazwan');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Mzm Bank TAC';
    $mail->Body    = 'This is your TAC number from MZMBank <b>Software Projects Jan 2024</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}



// Reference: https://github.com/PHPMailer/PHPMailer
// If you use gmail for the server email, ensure app. password has been set. SMTPGMAIL, get the 16 code for the password for this app.

// for yahoo: https://mailmeteor.com/smtp/yahoo-smtp-settings 