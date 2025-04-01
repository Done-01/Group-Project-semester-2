<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>captcha</title>
    <link rel="stylesheet" type="text/css" href="CSS/stylesheet.css">
</head>

<body>
    <?php
        session_start();
        require_once "includes/ImagePageScript.inc.php";
    ?>
    <div id="test">




        <form action="includes/ImageCheckScript.inc.php" method="post">

        <form action="includes/ImageCheckScript.inc.php" method="post">

        <form action="includes/ImageCheckScript.inc.php" method="post">

            <legend>Select the word that matches the image</legend>
            <img src="<?php echo $questionImage?>" width="500" height="500">
            <div id="RadioButtons2x2">
            <?php foreach ($answers as $answer): ?>
            <label>
                <input type="radio" name="answer" value="<?php echo $answer?>">
                <?php echo $answer?>
            </label>
            <?php endforeach ?>
            </div>
            <button type="submit" name="submit">Submit</button>
        </form>
        <?php echo 3-$_SESSION['Attempts']?>
    </div>
</body>
</html>