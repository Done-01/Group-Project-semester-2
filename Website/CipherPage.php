<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" type="text/css" href="CSS/stylesheet.css">
</head>
<body>
    <?php
        session_start();
        require_once 'includes/CipherScript.inc.php';
    ?>
    <h2>Cipher Page </h2>
    <p><?php echo $string ?><p>
    <p><?php echo $encriptedString ?><p>
    <p><?php echo $decryptedString ?><p>
</body>
</html>