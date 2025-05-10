<?php
require_once "../includes/page_logic/image_logic.php";
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
    <div class="form-container">
        <div class="image-container">
            <img src="<?php echo $answerPath ?>">
        </div>
        <?php
        renderRadial($array);
        displayUserErrors();
        ?>
    </div>
</body>

</html>