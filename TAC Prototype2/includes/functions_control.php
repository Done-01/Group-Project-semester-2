<?php
require_once "functions_model.php";
require_once "functions_view.php";

/**
 * User Input Validation Functions
 */

/**
 * Check if any of the provided fields are empty
 * @param mixed ...$fields Fields to check
 * @return bool True if any field is empty
 */

function isInputEmpty(...$fields): bool
{
    foreach ($fields as $field) {
        if (empty(trim($field))) {
            return true;
        }
    }
    return false;
}

/**
 * Validate email format
 * @param string $email Email to validate
 * @return bool True if email is valid
 */
function isEmailValid(string $email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Check if two variables match
 * @param mixed $var1 First variable
 * @param mixed $var2 Second variable
 * @return bool True if variables match
 */
function isMatch($var1, $var2): bool
{
    return $var1 === $var2;
}

/**
 * Check if username exists in database
 * @param string $username Username to check
 * @return bool True if username exists
 */
function usernameExists(PDO $pdo, string $username): bool
{
    return stmt_usernameExists($pdo, $username) !== false;
}

/**
 * Check if email exists in database
 * @param string $email Email to check
 * @return bool True if email exists
 */
function emailExists(PDO $pdo, string $email): bool
{
    return stmt_emailExists($pdo, $email) !== false;
}

/**
 * Get email via userId
 */
function getEmail(PDO $pdo, int $userId) 
{
    return stmt_getEmail($pdo,$userId);
}

/**
 * User Management Functions
 */

/**
 * Register a new user
 * @return bool True on success
 */
function registerUser(PDO $pdo, string $username, string $email, string $fName, string $lName, string $password): bool
{
    return stmt_createUser($pdo, $username, $email, $fName, $lName, $password);
}

/**
 * Authenticate a user
 * @param string $username Username
 * @param string $password Password
 * @return bool True if authentication succeeds
 */
function authenticateUser(PDO $pdo, string $username, string $password): bool
{
    $user = stmt_getAuthCredentials($pdo, $username);
    return $user && password_verify($password, $user);
}

/**
 * Get user ID by username
 * @param string $username Username
 * @return int|null User ID or null if not found
 */
function getUserId(PDO $pdo, string $username): int
{
    $user = stmt_getUserId($pdo, $username);
    return $user ?? null;
}

/**
 * Update user's last login time
 * @param string $username Username
 * @return bool True on success
 */
function updateLoginTime(PDO $pdo, string $userId): bool
{
    $timeString = (new DateTime())->format('Y-m-d H:i:s');
    return stmt_updateLoginTime($pdo, $userId, $timeString);
}

/**
 * Check an accounts admin status
 * @param int $userId UserId
 * @return bool
 */
function isAdmin(PDO $pdo, int $userId): bool
{
    return (bool)stmt_getAdminByUserId($pdo, $userId);
}


/**
 * Time Calculation Functions
 */

/**
 * Calculate time elapsed since given time
 * @param string $time Time string in Y-m-d H:i:s format
 * @return DateInterval Time difference
 */
function getTimeElapsed(string $time): DateInterval
{
    $timeObj = DateTime::createFromFormat('Y-m-d H:i:s', $time);
    return $timeObj->diff(new DateTime());
}

/**
 * Get user's last login time
 * @param string $username Username
 * @return string Last login time or default if not found
 */
function getLastLoginTime(PDO $pdo, string $userId): string
{
    $lastLogin = stmt_getLastLogin($pdo, $userId);
    return $lastLogin ?? '2025-01-01 00:00:00';
}

/**
 * Get user's login interval limit
 * @param string $username Username
 * @return int Login interval limit in days (default 30)
 */
function getLoginIntervalLimit(PDO $pdo, string $userId): int
{
    $limit = stmt_getLoginInterval($pdo, $userId);
    return $limit ?? 30;
}

/**
 * Key generation functions
 */

function getImageArray(PDO $pdo, int $amount): array
{
    $images = stmt_getImageArray($pdo, $amount);
    return $images;
}

/**
 * TAC functions
 */


/**
 *  Generate 5 digit TAC first 3 digits are English letters (A-Z) last 2 digits are Numbers (00-99)
 */

function generateTAC(): string
{
    return substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3) .
        str_pad(random_int(0, 99), 2, '0', STR_PAD_LEFT);
}

/**
 * takes a TAC from generateTAC and a key from the image match and encrypts it using the  Vigenère cipher 
 */
function encryptTAC(string $tac, string $key)
{
    $tac = strtoupper($tac);
    $key = strtoupper($key);

    $alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $encryptedTac = "";

    $key = str_pad($key, strlen($tac), $key);

    $tacArray = str_split($tac);
    $keyArray = str_split($key);

    for ($i = 0; $i < strlen($tac); $i++) {
        $alphabetLegnth = strlen($alphabet);

        $tacIndex = strPos($alphabet, $tacArray[$i]);
        $keyIndex = strPos($alphabet, $keyArray[$i]);

        $index = ($tacIndex + $keyIndex) % $alphabetLegnth;

        // string as array syntax
        $encryptedTac .= $alphabet[$index];
    }

    return $encryptedTac;
}

/**
 * takes a TAC from generateTAC and a key from the image match and decrypts it using the  Vigenère cipher 
 */
function decryptTAC(string $tac, string $key)
{
    $tac = strtoupper($tac);
    $key = strtoupper($key);

    $alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $decryptedTac = "";

    $key = str_pad($key, strlen($tac), $key);

    $tacArray = str_split($tac);
    $keyArray = str_split($key);

    for ($i = 0; $i < strlen($tac); $i++) {
        $alphabetLegnth = strlen($alphabet);

        $tacIndex = strPos($alphabet, $tacArray[$i]);
        $keyIndex = strPos($alphabet, $keyArray[$i]);

        $index = ($tacIndex - $keyIndex) % $alphabetLegnth;

        // string as array syntax
        $decryptedTac .= $alphabet[$index];
    }

    return $decryptedTac;
}


/**
 * Functions that provide database connection for TAC functions
 */

 // Update functions
function updateKey(PDO $pdo, int $userId, string $key): bool
{
    return stmt_updateKey($pdo, $userId, $key);
}

function updateTAC(PDO $pdo, string $userId, string $TAC): bool
{
    return stmt_updateTAC($pdo, $userId, $TAC);
}

function updateTimeGenerated(PDO $pdo, string $userId, string $timeGenerated): bool
{
    return stmt_updateTimeGenerated($pdo, $userId, $timeGenerated);
}
// Get functions
function getKey(PDO $pdo, int $userId): string
{
    return stmt_getKey($pdo, $userId);
}

function getTAC(PDO $pdo, string $userId): string
{
    return stmt_getTAC($pdo, $userId);
}

function getTimeGenerated(PDO $pdo, string $userId): string
{
    return stmt_getTimeGenerated($pdo, $userId);
}