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
    <h2>A verification code has been sent to your email.</h2>
    <form action="includes/LoginCheckScript.inc.php" method="POST">
        <label for="UserId">User Id</label>
        <input type="text" id="UserId" name="UserId" required />
        <label for="Password">Password</label>
        <input type="password" id="Password" name="Password" required />
        <button type="submit" name="submit">Log In</button>
    </form>
</body>

</html>