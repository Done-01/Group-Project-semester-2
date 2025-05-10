<?php
require_once '../includes/page_logic/home_logic.php';
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
    <?php renderNavbar($pdo, 'home'); ?>

    <div class="content-container">
        <h2>Welcome, <?= $fName ?>!</h2>
        <p>We're glad to have you back.</p>
    </div>
</body>
</html>