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
        <h2>Sign up</h2>

        <p>
            Already have an account?
            <a href="login-form.php">Log in</a>
        </p>

        <form method="post" action="../includes/forms/register.php" class="login-form">
        <?php signupInput(); ?>
        <button type="submit" class="login-button">Sign up</button>

        </form>
        <?php displayUserErrors(); ?>
    </div>
</body>

</html>