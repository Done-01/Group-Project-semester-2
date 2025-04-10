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

    // code checks if user has any attempts at entering their code left
    session_start();
    if (!isset($_SESSION['Attempts2'])) {
        $_SESSION['Attempts2'] = 0;
    }
    elseif($_SESSION['Attempts2'] >= 3) {
        header('Location: includes/LogoutScript.inc.php'); 
        exit(); 
    }
    // Check if any error messages have been set as session variables to be displayed
    if (isset($_SESSION['error'])) {
        $error = $_SESSION['error'];
        unset($_SESSION['error']);
    } else {
        $error = '';
    }
    ?>
    <div id="LoginContainer">
        <h1>Please eneter your authentication code</h1>

        <form action="includes/CodeCheck.inc.php" method="POST">
            <input type="text" id="Authentication" name="Authentication" required>
            <button type="submit" name="submit">Submit Code</button>
            <?php echo 3 - $_SESSION['Attempts2']?>
            <?php echo $_SESSION['CODE'];?>
        </form>

        <?php if ($error): ?>
            <div id="error">
                <p><?php echo htmlspecialchars($error) ?></p>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>