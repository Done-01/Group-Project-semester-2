<?php
require_once "../config.php";
require_once "../includes/functions_view.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <title>Login Page</title>
</head>

<body>
    <div class="form-container">
        <form action="../includes/forms/tac_send.php" method="post">
            <label>Email</label>
            <input type="radio" name="choice" value="email">
            <label>Whatsapp</label>
            <input type="radio" name="choice" value="whatsapp">
            <button type="submit">Send Code</button>
        </form>
        <?php displayUserErrors()?>
    </div>

</body>

</html>