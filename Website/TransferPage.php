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
        // Import script that gets balance as a variable ($balance)
        require_once 'includes/BalanceScript.inc.php';
        // Check if any error messages have been set as session variables to be displayed
        if (isset($_SESSION['error'])) {
            $error = $_SESSION['error'];
            unset($_SESSION['error']);  
        } else {
            $error = '';  
        }
    ?>
    <div id="test">

        <h2>Transfer Page</h2>

        <p><?php echo "Balance: £" . number_format($balance, 2); ?></p>

        <form action="includes/TransferScript.inc.php" method="POST"> 
            <label for="UserId">Recipient Id</label>
            <input type="text" id="RecipientId" name="RecipientId" required />
            <label for="TransferAmount">Transfer Amount</label> 
            <input type="text" id="TransferAmount" name="TransferAmount" required />
            <button type="submit" name="submit">Make Transfer</button>
            
            <?php if ($error): ?>
                <div id="error"> 
                    <p><?php echo $error?></p>
                </div>
            <?php endif; ?>

        </form>
    </div>
</body>
</html>