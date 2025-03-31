<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" type="text/css" href="CSS/stylesheet.css">
</head>

<body>
    <?php
        session_start();
        require_once "includes/ImagePageScript.inc.php";
    ?>
    <div id="test">
        <form>
            <legend>Select the word that matches the image</legend>
            <img src="<?php echo $questionImage?>" width="500" height="500">
            <?php foreach ($answers as $answer): ?>
            <label>
                <input type="radio" name="answer">
                <?php echo $answer?>
            </label>
            <?php endforeach ?>
            <button type="submit" name="submit">Submit</button>
        </form>
    </div>



</body>

</html>