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

<body class="login-page">
    <div class="form-container">
        <h2>Log In</h2>

        <p>
            Don't have an account?
            <a href="signup-form.php">Register here</a>
        </p>

        <form method="post" action="../includes/forms/authenticate.php" class="login-form">


            <input type="text" name="username" id="username" placeholder="Username">

            <input type="password" name="password" id="password" placeholder="Password">

            <button type="submit" class="login-button">Log In</button>

        </form>
        <?php displayUserErrors(); ?>
    </div>
</body>

</html>