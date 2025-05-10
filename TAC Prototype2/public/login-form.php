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
    <h2>Log In</h2>
    <p>
        Don't have an account?
        <a href="signup-form.php">Register here</a>
    </p>
    <form method="post" action="../includes/forms/authenticate.php">
        <input type="text" name="username" id="username" placeholder="Username">
        <input type="password" name="password" id="password" placeholder="Password">
        <div class="form-submit">
            <button type="submit" class="button">Login</button>
        </div>
    </form>
    <?php displayUserErrors(); ?>
</div>
</body>

</html>