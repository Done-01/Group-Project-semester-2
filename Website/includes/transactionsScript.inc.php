<?php
require_once 'dbh.inc.php';
require_once 'db_functions.inc.php';

if (!isset($_SESSION["UserId"])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION["UserId"];

$incomingTransactions = IncomingTable($db, $userId);
$outgoingTransactions = OutgoingTable($db, $userId);
