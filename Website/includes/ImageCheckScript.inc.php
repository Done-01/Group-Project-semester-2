<?php
    session_start();

    if (isset($_POST['answer']) && isset($_SESSION['Answer'])) {

        $correctAnswer = $_SESSION['Answer'];
        $submittedAnswer = $_POST['answer'];

        if ($submittedAnswer == $correctAnswer) {

            header('Location: ../CipherPage.php');
            exit();  
        }
        else {

            $_SESSION['Attempts']++;
            unset($_SESSION['Answer']);
            header('Location: ../ImageEntryPage.php');  
            exit();
        }

    }
    else {
        unset($_SESSION['Answer']);
        // code to destroy session and route to homepage.
    }