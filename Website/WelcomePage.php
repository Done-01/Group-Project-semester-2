<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WelcomePage</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>

<body>
    <?php
        session_start();
        if ($_SESSION['AdminStatus'] == 0) {
        include 'NavigationBar.php';
        }
        else {
            include "NavigationBar2.php";
        }
    ?>
    <div id="test">
    <h1>Welcome Page</h1>
    <h2><?php echo $_SESSION['FirstName'] . " " . $_SESSION['AdminStatus'];?></h2>
    </div>
</body>
</html>