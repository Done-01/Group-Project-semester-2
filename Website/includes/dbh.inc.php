<?php

// Creates a connection to the database. Required before sql is ran

$dbPath = __DIR__ . "/../database/Database.db"; 

$db = new SQLite3($dbPath);

if ($db === false) {
    echo "Failed to open the database: " . $db->lastErrorMsg();
    exit;
} else {
    echo "Database connection successful.";
}




