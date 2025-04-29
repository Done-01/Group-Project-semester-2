<?php
require_once "../includes/page_logic/image.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <title>Login Page</title>
</head>

<body>
    <div class="form-container">
        <div class="image-container">
            <img src="<?php echo $answerPath ?>">
        </div>
        <?php
        renderRadial($array);
        displayUserErrors();
        echo $_SESSION['attempts'];
        ?>
    </div>
</body>

</html>