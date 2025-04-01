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
        // Check if any error messages have been set as session variables to be displayed
        if (isset($_SESSION['error'])) {
            $error = $_SESSION['error'];
            unset($_SESSION['error']);  
        } else {
            $error = '';  
        }
    ?>
    <div id="LoginContainer">

        <h1>Email Sender Button</h1>
        
        <form action="includes/TestEmailScript.inc.php" method="POST"> 
            <button type="submit" name="submit">Send Email</button>
        </form> 
            
        <?php if ($error): ?>
                <div id="error"> 
                    <p><?php echo $error?></p>
                </div>
            <?php endif; ?>
    </div>
</body>
</html>
