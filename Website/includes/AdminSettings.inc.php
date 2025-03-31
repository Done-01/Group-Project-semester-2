<?php
    session_start();

    if (isset($_POST["submit"])) {

        require_once 'dbh.inc.php';
        require_once 'db_functions.inc.php';

        $transactionLimit = $_POST["TransactionLimit"];  
        $loginLimit = $_POST["LoginLimit"];
        $selectedId = $_SESSION['SelectedId'];


        UpdateUserSettings($db, $selectedId, $loginLimit, $transactionLimit);

        header('Location: ../AdminSettings.php'); 
        exit();  
    }
    else {
        // Code destroy session and route to login page
    }

