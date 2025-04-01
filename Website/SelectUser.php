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
        // Check if any error messages have been set as session variables to be displayed
        if (isset($_SESSION['error'])) {
            $error = $_SESSION['error'];
            unset($_SESSION['error']);  
        } else {
            $error = '';  
        }
    ?>

    <div id="test">
        
        <h2>Select User to make changes to</h2>

        <form action="includes/SelectUser.inc.php" method="POST"> 
        <label for="SelectedId">Select Id</label>
        <input type="text" id="SelectedId" name="SelectedId" required />
        <button type="submit" name="submit">Select User</button>
            
        <?php if ($error): ?>
        <div id="error"> 
        <p><?php echo $error?></p>
        </div>
        <?php endif; ?>
            
        </form>
    </div>
</body>
</html>