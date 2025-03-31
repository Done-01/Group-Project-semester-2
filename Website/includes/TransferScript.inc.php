<?php
    session_start();

    require_once 'dbh.inc.php';
    require_once 'db_functions.inc.php';
    require_once 'BalanceScript.inc.php';

    // first check that the form was submitted and the userid session variable exists

    if (isset($_POST['submit']) && isset($_SESSION["UserId"])) { 

        $senderId = $_SESSION["UserId"];
        $recipientId = $_POST["RecipientId"];
        $transferAmount = $_POST["TransferAmount"];

        // check that the recipient exists
        if (DoesUserExist($db, $recipientId)) {
            // then check that the user has adequate funds
            if ($balance >= $transferAmount && $transferAmount > 0) {
                
                TransferBalance($db, $senderId, $recipientId, $transferAmount);
                header('Location: ../TransferPage.php');
                exit();
            }
            else {
            // if user doesnt have enough cash or amount entered is negative set error to Insufficient Funds
            $_SESSION['error'] = "Invalid amount";
            header('Location: ../TransferPage.php');
            exit();

            }
        }
        else {
            // if user doesnt exist set error to invalid user 
            $_SESSION['error'] = "Invalid User";
            header('Location: ../TransferPage.php');
            exit();
        }
    }
    else {
        header('Location: ../TransferPage.php');
        exit();
    }

