<?php
require_once "../config.php";
require_once "../includes/functions_view.php";
require_once "../includes/functions_control.php";

try {

    $array = getImageArray($pdo, 4);
    $_SESSION['answer'] = $array[0]['imageName'];
    $_SESSION['attempts'] ??= 3;
    $answerPath = $array[0]['imagePath'];
    shuffle($array);

} catch (PDOException $e) {
    error_log('Database error: ' . $e->getMessage());
    header('Location: ../../public/error-page.php?error=database');
    exit();
}

function renderRadial($array)
{
?>
    <form action="../includes/forms/image_match.php" method="post">
        <?php foreach ($array as $option): ?>
            <label>
                <?php echo $option['imageName'] ?>
            </label>
            <input type="radio" name="option" value="<?php echo $option['imageName'] ?>">
        <?php endforeach ?>
        <button type="submit" name="submit">Submit</button>
    </form>
<?php
}
