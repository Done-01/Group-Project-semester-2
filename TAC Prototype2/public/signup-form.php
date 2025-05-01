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
<div class="form-container">
    <h2>Sign up</h2>
    <p>
        Already have an account?
        <a href="login-form.php">Log in</a>
    </p>
    <form method="post" action="../includes/forms/register.php">
        <?php signupInput(); ?>
        <div class="form-submit">
            <button type="submit" class="button">Sign up</button>
        </div>
    </form>
    <?php displayUserErrors(); ?>
</div>
</body>

</html>