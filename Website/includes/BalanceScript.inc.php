<?php

require_once 'dbh.inc.php';
require_once 'db_functions.inc.php';

if (isset($_SESSION['UserId'])) {

    $userId = $_SESSION['UserId'];

    $balance = GetBalance($db, $userId);

}
else {
    
    //Destroy session and route back to login / home page

}





