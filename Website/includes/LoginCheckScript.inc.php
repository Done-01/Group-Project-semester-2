<?php
    session_start();

    if (isset($_POST["submit"])) {

        require_once 'dbh.inc.php';
        require_once 'db_functions.inc.php';

        $userId = $_POST["UserId"];  
        $password = $_POST["Password"];

        $userArray = GetAllById($db, $userId);

        if ($userArray) {

            if ($password === $userArray['Password']) {

                session_regenerate_id(true);
            
                // Set session variables

                $_SESSION['UserId'] = $userArray['UserId'];
                $_SESSION['FirstName'] = $userArray['FirstName'];
                $_SESSION['AdminStatus'] = $userArray['AdminStatus'];

                // Get Login time and set it as a session variable

                $loginTime = date('Y-m-d H:i:s');

                $_SESSION['LoginTime'] = $loginTime;

                // Update database with Login time by calling the function

                UpdateLastLogin($db, $_SESSION['UserId'], $loginTime);

                // Redirect to the welcome page
                header('Location: ../WelcomePage.php');
                exit();

            } else {

                // Invalid password
                $_SESSION['error'] = "Invalid Password";
                header('Location: ../LoginPage.php');
                exit();

            }

        } else {

            // User not found
            $_SESSION['error'] = "Invalid User Id";
            header('Location: ../LoginPage.php');
            exit();

        }

    }


