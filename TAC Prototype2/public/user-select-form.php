<?php
require_once "../config.php";
// Add this line to redirect to the correct admin controls page
require_once "../includes/functions_view.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Controls</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <?php renderNavbar($pdo, 'admin-controls'); ?>

    <div class="form-container">
        <div class="header">
            <h2>Admin Controls</h2>
            <p class="instruction-text">Enter a users id to edit parameters</p>
            
            <?php if (isset($_SESSION['adminSuccess'])): ?>
                <div class="alert success">
                    <?= htmlspecialchars($_SESSION['adminSuccess']); ?>
                    <?php unset($_SESSION['adminSuccess']); ?>
                </div>
            <?php endif; ?>
        </div>
        
        <form action="../includes/forms/user_select.php" method="post">
            <label for="recipient">User ID</label>
            <input type="text" id="recipient" name="recipient" placeholder="User ID" required>           
            <div class="form-submit">
                <button type="submit" class="button">Select</button>
            </div>
            
            <?php if (isset($_SESSION['adminErrors'])): ?>
                <div class="alert error">
                    <?php 
                    foreach ($_SESSION['adminErrors'] as $error) {
                        echo htmlspecialchars($error) . "<br>";
                    }
                    unset($_SESSION['adminErrors']);
                    ?>
                </div>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>