<?php
require_once "../config.php";
require_once "../includes/functions_view.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/main.css">
    <title>Verification Code | Your Bank</title>
</head>

<body>
    
    <div class="form-container">
        <div class="verification-header">
            <h2>Enter Verification Code</h2>
            <p class="instruction-text">Please enter your 5-character code (letters and numbers)</p>
        </div>
        <?php if (isset($_SESSION['attempts'])): ?>
            <div class="attempts-counter">
                <span class="attempts-number"><?php echo $_SESSION['attempts']; ?></span>
                <span class="attempts-text">attempts remaining</span>
            </div>
        <?php endif; ?>
        
        <form action="../includes/forms/tac_check.php" method="post" class="verification-form">
            <div class="input-group">
                <label for="code" class="input-label">Verification Code</label>
                <input type="text" 
                       name="input" 
                       id="code"
                       class="code-input" 
                       placeholder="Enter code" 
                       maxlength="5"
                       pattern="[A-Za-z0-9]{5}"
                       title="Please enter exactly 5 alphanumeric characters"
                       required
                       autocomplete="one-time-code">
            </div>
            
            <div class="form-submit">
                <button type="submit" class="button">Verify Code</button>
            </div>
            <a href="../includes/tac_send.php" class="resend-link">Resend Code</a>
        </form>
        <?php displayUserErrors(); ?>
    </div>
</body>

</html>