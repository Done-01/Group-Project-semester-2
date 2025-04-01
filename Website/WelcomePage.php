<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WelcomePage</title>
    <link rel="stylesheet" type="text/css" href="CSS/stylesheet.css">
</head>

<body>
    <?php
        session_start();
        include 'NavigationBar.inc.php';
        require_once 'includes/InactivityScript.inc.php';
    ?>
    <div id="test">
        <h2>Welcome Page</h2>
        <h2> <?php echo $_SESSION['FirstName'] . " " . $_SESSION['AdminStatus'] . " " . $_SESSION['UserId'] . " " . $_SESSION['LoginTime']; ?> </h2>
    </div>
</body>
</html>