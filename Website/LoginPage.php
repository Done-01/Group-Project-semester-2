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

        <h1>Please Log In</h1>
        
        <form action="includes/LoginCheckScript.inc.php" method="POST"> 
            <label for="UserId">User Id</label>
            <input type="text" id="UserId" autocapitalize="none" name="UserId" required />
            <label for="Password">Password</label> 
            <input type="password" id="Password" name="Password" required />
            <button type="submit" name="submit">Log In</button>
        </form> 
            
        <?php if ($error): ?>
                <div id="error"> 
                    <p><?php echo $error?></p>
                </div>
            <?php endif; ?>
    </div>
</body>
</html>
