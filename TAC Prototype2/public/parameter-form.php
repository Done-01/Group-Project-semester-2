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
            <p class="instruction-text">Enter user ID and new parameter values</p>

            <form action="../includes/forms/controls.php" method="post">
                <label for="recipient">User ID</label>
                <input type="text"
                    id="recipient"
                    name="recipient"
                    value="<?php echo isset($_SESSION['adminEditUserId']) ? htmlspecialchars($_SESSION['adminEditUserId']) : ''; ?>"

                    readonly> <label for="loginInterval">Login Limit (days)</label>
                <input type="number" id="loginInterval" name="loginInterval" min="1" max="365" value="<?php echo isset($_SESSION['adminEditLoginInterval']) ? htmlspecialchars($_SESSION['adminEditLoginInterval']) : ''; ?>">

                <label for="maxTransfer">Transfer Limit (£)</label>
                <input type="number" id="maxTransfer" name="maxTransfer" min="1" value="<?php echo isset($_SESSION['adminEditTransferLimit']) ? htmlspecialchars($_SESSION['adminEditTransferLimit']/100) : ''; ?>">

                <div class="radio-group">
                    <label>Block Account:</label>
                    <div class="radio-option">
                        <input type="radio" id="block-true" name="block_account" value="1">
                        <label for="block-true">Yes</label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" id="block-false" name="block_account" value="0" checked>
                        <label for="block-false">No</label>
                    </div>
                </div>

                <div class="form-submit">
                    <button type="submit" class="button">Set Parameters</button>
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