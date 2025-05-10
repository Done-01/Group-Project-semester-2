<?php
require_once "../config.php";
require_once "../includes/functions_view.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <?php renderNavbar($pdo, 'transfer'); ?>

    <div class="form-container">
        <div class="header">
            <h2>Transfer</h2>
            <p class="instruction-text">Enter recipents user id and the amount you would like to transfer</p>
        </div>
        <form class="transfer-form" action="../includes/forms/balance_transfer.php" method="post">
            <label>Recipient</label>
            <input type="text" name="recipient" id="recipient" placeholder="User Id">
            <label>Amount</label>
            <input type="text" name="amount" id="amount" placeholder="£">
            <div class="form-submit">
                <button type="submit" class="button">Transfer</button>
            </div>
            <?php displayUserErrors(); ?>
            <?php displaySuccess(); ?>
        </form>
    </div>
</body>

</html>