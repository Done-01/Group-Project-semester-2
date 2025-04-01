<?php
    session_start();
    require_once 'TacFunctions.inc.php';

    $key = $_SESSION['Answer'];

    $string = GenerateRandomString();

    $encriptedString = VigenereEncrypt($string,$key);


    $decryptedString = VigenereDecrypt($encriptedString,$key);

    





    



