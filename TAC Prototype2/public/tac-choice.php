<?php
require_once "../config.php";
require_once "../includes/functions_view.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/main.css">
    <title>Login Page</title>
</head>

<body>
    <div class="form-container">
        <h2>Select Verification Method</h2>
        <form action="../includes/forms/tac_send.php" method="post">
            <div class="radio-group horizontal">
                <label for="emailChoice">Email</label>
                <input type="radio" id="emailChoice" name="choice" value="email">
                <label for="whatsappChoice">WhatsApp</label>
                <input type="radio" id="whatsappChoice" name="choice" value="whatsapp">
            </div>

            <div class="form-submit">
                <button type="submit" class="button">Generate Verification Code</button>
            </div>
        </form>
        <?php displayUserErrors() ?>
    </div>
</body>

</html>