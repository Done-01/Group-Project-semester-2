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
        // Import inactivity script
        require_once 'includes/InactivityScript.inc.php';
        // Import script that gets the values for ($transactionLimint and $loginLimit) from the database
        require_once 'includes/PlaceholderImport.inc.php';
        // Check if any error messages have been set as session variables to be displayed
        if (isset($_SESSION['error'])) {
            $error = $_SESSION['error'];
            unset($_SESSION['error']);  
        } else {
            $error = '';  
        }
    ?>

    <div id="test">
        <h2>Change users settings</h2>
        <a href="SelectUser.php"> Change selected user <a> 
        <form action="includes/AdminSettings.inc.php" method="POST"> 
            <label for="TransactionLimit">Transaction Limit</label>
            <input type="text" placeholder="<?php echo $transactionLimit?>"  id="TransactionLimit" name="TransactionLimit" required />
            <label for="LoginLimit">Last Login Limit</label>
             <input type="text" placeholder="<?php echo $loginLimit?>" id="LoginLimit" name="LoginLimit" required />
            <button type="submit" name="submit">Confirm Changes</button>
            
            <?php if ($error): ?>
            <div id="error"> 
            <p><?php echo $error?></p>
            </div>
            <?php endif; ?>
            
        </form>
    </div>
</body>
</html>