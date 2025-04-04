<?php

// php functions that interact with the database.

// Check that a user id exists

function DoesUserExist($db, $userId) {

    $stmt = $db->prepare("SELECT 1 FROM Users WHERE UserId = :UserId LIMIT 1");
    $stmt->bindValue(':UserId', $userId, SQLITE3_TEXT);
    $result = $stmt->execute();
    
    if ($result->fetchArray(SQLITE3_ASSOC)) {
        return true;  
    } else {
        return false; 
    }
}

// Return all attributes of a User as an associative array

function GetAllById($db, $userId) {
    $stmt = $db->prepare('SELECT * FROM Users WHERE UserId = :UserId');
    $stmt->bindValue(':UserId', $userId, SQLITE3_TEXT);
    $result = $stmt->execute();
    $userArray = $result->fetchArray(SQLITE3_ASSOC);
    return $userArray;
}

// Update last login time 

function UpdateLastLogin($db, $userId, $loginTime) {
    $stmt = $db->prepare("UPDATE Users SET LastLogin = :LastLogin WHERE UserId = :UserId");
    $stmt->bindValue(':LastLogin', $loginTime, SQLITE3_TEXT);
    $stmt->bindValue(':UserId', $userId, SQLITE3_TEXT);
    $result = $stmt->execute();
}

// Get users balance

function GetBalance($db, $userId) {
    $stmt = $db->prepare('SELECT Balance FROM Users WHERE UserId = :id'); 
    $stmt->bindValue(':id', $userId, SQLITE3_TEXT);
    $result = $stmt->execute();
    $row = $result->fetchArray(SQLITE3_ASSOC);
    $balance = $row['Balance'];
    return $balance;
}

// Test transaction function

function TransferBalance($db, $fromUserId, $toUserId, $amount) {
    // Start a transaction 
    $db->exec('BEGIN TRANSACTION');
    
    try {
        // Deduct balance from the sender
        $stmt = $db->prepare("UPDATE Users SET Balance = Balance - :Amount WHERE UserId = :FromUserId AND Balance >= :Amount");
        $stmt->bindValue(':Amount', $amount, SQLITE3_FLOAT);
        $stmt->bindValue(':FromUserId', $fromUserId, SQLITE3_TEXT);
        $stmt->execute();
        
        // Credit balance to the reciever
        $stmt = $db->prepare("UPDATE Users SET Balance = Balance + :Amount WHERE UserId = :ToUserId");
        $stmt->bindValue(':Amount', $amount, SQLITE3_FLOAT);
        $stmt->bindValue(':ToUserId', $toUserId, SQLITE3_TEXT);
        $stmt->execute();
        
        // Commit the transaction
        $db->exec('COMMIT');
    } catch (Exception $e) {
        // Rollback the transaction in case of any error
        $db->exec('ROLLBACK');
    }
}

// user settings update function

function UpdateUserSettings($db, $userId, $loginLimit, $transactionLimit) {
    $stmt = $db->prepare("UPDATE Users SET LoginLimit = :LoginLimit,TransactionLimit = :TransactionLimit WHERE UserId = :UserId");
    $stmt->bindValue(':LoginLimit', $loginLimit, SQLITE3_INTEGER);
    $stmt->bindValue(':TransactionLimit', $transactionLimit, SQLITE3_INTEGER);
    $stmt->bindValue(':UserId', $userId, SQLITE3_TEXT);
    $result = $stmt->execute();
}

// get 4 random entries from the images table

function Get4RandomImages($db) {
    $result = $db->query('SELECT * FROM Images ORDER BY RANDOM() LIMIT 4;');
    $images = [];
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $images[] = $row;
    }
    return $images;
}

// get relevant data for transaction tables

function IncomingTable($db, $userId) {
    $stmt = $db->prepare("SELECT * FROM Transactions WHERE ReceiverID = :userid");
    $stmt->bindValue(':userid', $userId, SQLITE3_TEXT);
    return $stmt->execute();
}

function OutgoingTable($db, $userId) {
    $stmt = $db->prepare("SELECT * FROM Transactions WHERE SenderID = :userid");
    $stmt->bindValue(':userid', $userId, SQLITE3_TEXT);
    return $stmt->execute();
}