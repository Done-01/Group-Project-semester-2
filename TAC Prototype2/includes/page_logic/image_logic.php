<?php
require_once "../config.php";
require_once "../includes/functions_view.php";
require_once "../includes/functions_control.php";

try {
    $array = getImageArray($pdo, 4);
    $_SESSION['answer'] = $array[0]['imageName'];
    $_SESSION['attempts'] ??= 2;
    $answerPath = $array[0]['imagePath'];
    shuffle($array);
} catch (PDOException $e) {
    error_log('Database error: ' . $e->getMessage());
    header('Location: ../../public/error-page.php?error=database');
    exit();
}

// function to render the radio button form for the image array
function renderRadial($array)
{
?>
    <form action="../includes/forms/image_match.php" method="post" class="form-container">
        <h2>Select the Correct Option</h2>

        <?php if (isset($_SESSION['attempts'])): ?>
            <div class="attempts-counter">
                <span class="attempts-number"><?php echo $_SESSION['attempts']; ?></span>
                <span class="attempts-text">attempts remaining</span>
            </div>
        <?php endif; ?>

        <div class="radio-option">
            <?php foreach ($array as $option): ?>
                <div class="radio-group">
                    <label for="<?php echo htmlspecialchars($option['imageName']); ?>">
                        <?php echo htmlspecialchars($option['imageName']); ?>
                    </label>
                    <input type="radio" id="<?php echo htmlspecialchars($option['imageName']); ?>"
                        name="option" value="<?php echo htmlspecialchars($option['imageName']); ?>">
                </div>
            <?php endforeach; ?>
        </div>

        <div class="form-submit">
            <button type="submit" class="button">Submit</button>
        </div>
    </form>
<?php
}
