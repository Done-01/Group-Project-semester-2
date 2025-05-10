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
    <title>Login Page</title>
</head>
<body>
    <?php renderNavbar($pdo,"home");?>
    <div class="content-container">
        <h2>
            Balance
        </h2>
        <p>
            £<?php displayBalance($pdo, $_SESSION['userId']) ?>
        </p>
    </div>
</body>
</html>