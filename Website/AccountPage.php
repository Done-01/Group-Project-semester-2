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

    // Import Nav Bar
    require_once 'NavigationBar.inc.php';
    // Import script that gets balance as a variable ($balance)
    require_once 'includes/BalanceScript.inc.php';
    // Import inactivity script
    require_once 'includes/InactivityScript.inc.php';
    
    
?>
    <div id="test">
        <h2>Account Page</h2>
        <p>
            Balance: £<?php echo $balance?>
            Add other user info here.
        </p>

    </div>
</body>
</html>