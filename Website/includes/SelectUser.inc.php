<?php
    session_start();  

    if (isset($_POST['submit'])) {  

        $selectedId = $_POST['SelectedId'];

        require_once 'dbh.inc.php';
        require_once 'db_functions.inc.php';

        // Check if the entered user id is in the database
        if (DoesUserExist($db, $selectedId)) {

            $_SESSION['SelectedId'] = $selectedId;

            header('Location: ../AdminSettings.php');  
            exit();  
        }

        else {
            // User doesn't exist in the database
            $_SESSION['error'] = "Invalid UserId";  

            header('Location: ../SelectUser.php');  
            exit();  
        }
    }
?>
