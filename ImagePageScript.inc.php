<?php
    session_start();
    require_once 'dbh.inc.php';
    require_once 'db_functions.inc.php';

    if (!isset($_SESSION['Attempts'])) {
        $_SESSION['Attempts'] = 0;
    }
    elseif($_SESSION['Attempts'] >= 3) {
        header('Location: includes/LogoutScript.inc.php'); 
        exit(); 
    }

    $images = Get4RandomImages($db);

    $questionImage = $images[0]['ImagePath'];

    $questionSound = $images[0]['SoundPath'];

    $_SESSION["Answer"] = $images[0]['ImageName'];

    $answers = array_column($images,'ImageName');

    shuffle($answers);



    
