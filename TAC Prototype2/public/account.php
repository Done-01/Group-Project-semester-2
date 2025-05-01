<?php
require_once '../includes/page_logic/account_logic.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Page</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <?php renderNavbar($pdo, 'account'); ?>
    <div class="content-container">
        <h2>Account Details</h2>
        <p><strong>User ID:</strong> <?= htmlspecialchars($userId) ?></p>
        <p><strong>Email:</strong> <?= $email ?></p>
        <p><strong>Balance:</strong> £<?= number_format($balance, 2) ?></p>
    </div>
</body>
</html>