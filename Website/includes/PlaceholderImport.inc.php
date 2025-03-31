<?php
    session_start();
    require_once 'dbh.inc.php';
    require_once 'db_functions.inc.php';

    $selectedId = $_SESSION['SelectedId'];

    $userInfo = GetAllById($db,$selectedId);

    $transactionLimit = $userInfo['TransactionLimit'];
    $loginLimit = $userInfo['LoginLimit'];

    