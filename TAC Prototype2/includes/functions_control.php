<?php
require_once "functions_model.php";
require_once "functions_view.php";

/*******************************
 * VALIDATION FUNCTIONS
 *******************************/

function isInputEmpty(...$fields): bool {
    foreach ($fields as $field) {
        if (empty(trim($field))) {
            return true;
        }
    }
    return false;
}

function isEmailValid(string $email): bool {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function isMatch($var1, $var2): bool {
    return $var1 === $var2;
}

function usernameExists(PDO $pdo, string $username): bool {
    return stmt_usernameExists($pdo, $username) !== false;
}

function emailExists(PDO $pdo, string $email): bool {
    return stmt_emailExists($pdo, $email) !== false;
}

function idExists(PDO $pdo, int $userId): bool {
    return stmt_idExists($pdo, $userId) !== false;
}

/*******************************
 * USER MANAGEMENT FUNCTIONS
 *******************************/

function registerUser(PDO $pdo, string $username, string $email, string $fName, string $lName, string $password): bool {
    return stmt_createUser($pdo, $username, $email, $fName, $lName, $password);
}

function authenticateUser(PDO $pdo, string $username, string $password): bool {
    $user = stmt_getAuthCredentials($pdo, $username);
    return $user && password_verify($password, $user);
}

function getUserId(PDO $pdo, string $username): ?int {
    return stmt_getUserId($pdo, $username) ?? null;
}

function getEmail(PDO $pdo, int $userId): ?string {
    return stmt_getEmail($pdo, $userId);
}

function updateLoginTime(PDO $pdo, int $userId): bool {
    $timeString = (new DateTime())->format('Y-m-d H:i:s');
    return stmt_updateLoginTime($pdo, $userId, $timeString);
}

function isAdmin(PDO $pdo, int $userId): bool {
    return (bool)stmt_getAdminByUserId($pdo, $userId);
}

function isUserBlocked(PDO $pdo, int $userId): bool {
    $stmt = $pdo->prepare("SELECT isBlocked FROM users WHERE userId = :userId");
    $stmt->execute(['userId' => $userId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['isBlocked'] ?? false;
}

/*******************************
 * TIME-RELATED FUNCTIONS
 *******************************/

function getTimeElapsed(string $time): DateInterval {
    $timeObj = DateTime::createFromFormat('Y-m-d H:i:s', $time);
    return $timeObj->diff(new DateTime());
}

function getLastLoginTime(PDO $pdo, string $userId): string {
    return stmt_getLastLogin($pdo, $userId) ?? '2025-01-01 00:00:00';
}

function getLoginIntervalLimit(PDO $pdo, string $userId): int {
    return stmt_getLoginInterval($pdo, $userId) ?? 30;
}

/*******************************
 * TRANSACTION FUNCTIONS
 *******************************/

function transferBalance(PDO $pdo, int $senderId, int $recipientId, int $amount): bool {
    return stmt_transferBalance($pdo, $senderId, $recipientId, $amount);
}

function getBalance(PDO $pdo, int $userId): int {
    return stmt_getBalance($pdo, $userId);
}

function getMaxTransfer(PDO $pdo, int $userId): int
{
    return stmt_getMaxTransfer($pdo, $userId); // Return in pence as stored in the database
}

/*******************************
 * TAC (TRANSACTION AUTH CODE) FUNCTIONS
 *******************************/

function generateTAC(): string {
    return substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3) .
           str_pad(random_int(0, 99), 2, '0', STR_PAD_LEFT);
}

function encryptTAC(string $tac, string $key): string {
    $tac = strtoupper($tac);
    $key = strtoupper($key);
    $alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $encryptedTac = "";
    $key = str_pad($key, strlen($tac), $key);

    for ($i = 0; $i < strlen($tac); $i++) {
        $tacIndex = strpos($alphabet, $tac[$i]);
        $keyIndex = strpos($alphabet, $key[$i]);
        $index = ($tacIndex + $keyIndex) % strlen($alphabet);
        $encryptedTac .= $alphabet[$index];
    }

    return $encryptedTac;
}

function decryptTAC(string $tac, string $key): string {
    $tac = strtoupper($tac);
    $key = strtoupper($key);
    $alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $decryptedTac = "";
    $key = str_pad($key, strlen($tac), $key);

    for ($i = 0; $i < strlen($tac); $i++) {
        $tacIndex = strpos($alphabet, $tac[$i]);
        $keyIndex = strpos($alphabet, $key[$i]);
        $index = ($tacIndex - $keyIndex) % strlen($alphabet);
        $decryptedTac .= $alphabet[$index];
    }

    return $decryptedTac;
}

/*******************************
 * TAC DATABASE OPERATIONS
 *******************************/

// Update operations
function updateKey(PDO $pdo, int $userId, string $key): bool {
    return stmt_updateKey($pdo, $userId, $key);
}

function updateTAC(PDO $pdo, string $userId, string $TAC): bool {
    return stmt_updateTAC($pdo, $userId, $TAC);
}

function updateTimeGenerated(PDO $pdo, string $userId, string $timeGenerated): bool {
    return stmt_updateTimeGenerated($pdo, $userId, $timeGenerated);
}

// Get operations
function getKey(PDO $pdo, int $userId): string {
    return stmt_getKey($pdo, $userId);
}

function getTAC(PDO $pdo, int $userId): string {
    return stmt_getTAC($pdo, $userId);
}

function getTimeGenerated(PDO $pdo, string $userId): string {
    return stmt_getTimeGenerated($pdo, $userId);
}

/*******************************
 * IMAGE-RELATED FUNCTIONS
 *******************************/

function getImageArray(PDO $pdo, int $amount): array {
    return stmt_getImageArray($pdo, $amount);
}