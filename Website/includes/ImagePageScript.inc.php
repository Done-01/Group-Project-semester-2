<?php
    session_start();
    require_once 'dbh.inc.php';
    require_once 'db_functions.inc.php';

    $images = Get4RandomImages($db);

    $questionImage = $images[0]['ImagePath'];

    $answers = array_column($images,'ImageName');



    
