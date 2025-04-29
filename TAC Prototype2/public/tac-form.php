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
        <h2>
            Please enter the authorisation code
        </h2>
        <form action="../includes/forms/tac_check.php" method="post">
            <input type="text" name="input" id="code">
            <button type="submit" class="login-button">Submit</button>
        </form>
        <?php displayUserErrors()?>
    </div>
</body>

</html>