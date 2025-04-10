<?php
session_start();

if (!isset($_POST['answer']) || !isset($_SESSION['Answer'])) {
    unset($_SESSION['Answer']);
    header('Location: includes/LogoutScript.inc.php');
    exit();
}

$correctAnswer = $_SESSION['Answer'];
$submittedAnswer = $_POST['answer'];

if ($submittedAnswer != $correctAnswer) {
    $_SESSION['Attempts']++;
    unset($_SESSION['Answer']);
    header('Location: ../ImageEntryPage.php');
    exit();
}

header('Location: ../TACChoice.php');
exit();