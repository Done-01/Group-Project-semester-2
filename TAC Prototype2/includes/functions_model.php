<?php
require_once "dbh.php";

/*******************************
 * USER DATA FUNCTIONS
 *******************************/

/**
 * Get user ID by username
 * @return int|false User ID or false if not found
 */
function stmt_getUserId(PDO $pdo, string $username) {
    $stmt = $pdo->prepare("SELECT userId FROM users WHERE username = ?");
    $stmt->execute([$username]);
    return $stmt->fetchColumn();
}

/**
 * Get username by user ID
 * @return string|false Username or false if not found
 */
function stmt_getUsernameByUserId(PDO $pdo, string $userId) {
    $stmt = $pdo->prepare("SELECT username FROM users WHERE userId = ?");
    $stmt->execute([$userId]);
    return $stmt->fetchColumn();
}

/**
 * Check if user ID exists
 * @return bool True if user exists
 */
function stmt_idExists(PDO $pdo, int $userId) {
    $stmt = $pdo->prepare("SELECT 1 FROM users WHERE userId = ? LIMIT 1");
    $stmt->execute([$userId]);
    return (bool)$stmt->fetchColumn();
}

/**
 * Check if username exists
 * @return bool True if username exists
 */
function stmt_usernameExists(PDO $pdo, string $username) {
    $stmt = $pdo->prepare("SELECT 1 FROM users WHERE username = ? LIMIT 1");
    $stmt->execute([$username]);
    return (bool)$stmt->fetchColumn();
}

/**
 * Get user's email by ID
 * @return string|false Email or false if not found
 */
function stmt_getEmail(PDO $pdo, int $userId) {
    $stmt = $pdo->prepare("SELECT email FROM users WHERE userId = ?");
    $stmt->execute([$userId]);
    return $stmt->fetchColumn();
}

/**
 * Check if email exists
 * @return bool True if email exists
 */
function stmt_emailExists(PDO $pdo, string $email) {
    $stmt = $pdo->prepare("SELECT 1 FROM users WHERE email = ? LIMIT 1");
    $stmt->execute([$email]);
    return (bool)$stmt->fetchColumn();
}

/**
 * Check if user is admin
 * @return bool True if user is admin
 */
function stmt_getAdminByUserId(PDO $pdo, int $userId) {
    $stmt = $pdo->prepare("SELECT isAdmin FROM users WHERE userId = ?");
    $stmt->execute([$userId]);
    return (bool)$stmt->fetchColumn();
}

/**
 * Get user's hashed password for authentication
 * @return string|false Hashed password or false if not found
 */
function stmt_getAuthCredentials(PDO $pdo, string $username) {
    $stmt = $pdo->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->execute([$username]);
    return $stmt->fetchColumn();
}

/*******************************
 * USER ACTIVITY FUNCTIONS
 *******************************/

/**
 * Get user's last login time
 * @return string|false Timestamp or false if not found
 */
function stmt_getLastLogin(PDO $pdo, string $userId) {
    $stmt = $pdo->prepare("SELECT lastLogin FROM users WHERE userId = ?");
    $stmt->execute([$userId]);
    return $stmt->fetchColumn();
}

/**
 * Get user's login interval limit
 * @return int|false Interval in days or false if not found
 */
function stmt_getLoginInterval(PDO $pdo, string $userId) {
    $stmt = $pdo->prepare("SELECT loginInterval FROM users WHERE userId = ?");
    $stmt->execute([$userId]);
    return $stmt->fetchColumn();
}

/**
 * Update user's last login time
 * @return bool True on success
 */
function stmt_updateLoginTime(PDO $pdo, string $userId, string $lastLogin) {
    $stmt = $pdo->prepare("UPDATE users SET lastLogin = ? WHERE userId = ?");
    return $stmt->execute([$lastLogin, $userId]);
}

/*******************************
 * ACCOUNT MANAGEMENT FUNCTIONS
 *******************************/

/**
 * Create new user account
 * @return bool True on success
 */
function stmt_createUser(
    PDO $pdo,
    string $username,
    string $email,
    string $fName,
    string $lName,
    string $password
): bool {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users 
                          (username, email, fName, lName, password) 
                          VALUES (?, ?, ?, ?, ?)");
    return $stmt->execute([$username, $email, $fName, $lName, $hashedPassword]);
}

/**
 * Get user's account balance
 * @return int|false Balance or false if not found
 */
function stmt_getBalance(PDO $pdo, int $userId) {
    $stmt = $pdo->prepare("SELECT balance FROM users WHERE userId = ?");
    $stmt->execute([$userId]);
    return $stmt->fetchColumn();
}

/**
 * Get user's max transfer
 * @return int|false Balance or false if not found
 */
function stmt_getMaxTransfer(PDO $pdo, int $userId) {
    $stmt = $pdo->prepare("SELECT maxTransfer FROM users WHERE userId = ?");
    $stmt->execute([$userId]);
    return $stmt->fetchColumn();
}


/**
 * Transfer balance between accounts
 * @return bool True on success
 */
function stmt_transferBalance(PDO $pdo, int $senderId, int $recipientId, int $amount): bool {
    try {
        $pdo->beginTransaction();

        // Deduct from sender
        $stmt = $pdo->prepare("UPDATE users SET balance = balance - ? WHERE userId = ?");
        $stmt->execute([$amount, $senderId]);

        // Add to recipient
        $stmt = $pdo->prepare("UPDATE users SET balance = balance + ? WHERE userId = ?");
        $stmt->execute([$amount, $recipientId]);

        $pdo->commit();
        return true;
    } catch (PDOException $e) {
        $pdo->rollBack();
        return false;
    }
}

/*******************************
 * TAC (TRANSACTION AUTH CODE) FUNCTIONS
 *******************************/

/**
 * Get TAC code for user
 * @return string|false TAC code or false if not found
 */
function stmt_getTAC(PDO $pdo, int $userId) {
    $stmt = $pdo->prepare("SELECT TAC FROM users WHERE userId = ?");
    $stmt->execute([$userId]);
    return $stmt->fetchColumn();
}

/**
 * Get TAC generation time
 * @return string|false Timestamp or false if not found
 */
function stmt_getTimeGenerated(PDO $pdo, int $userId) {
    $stmt = $pdo->prepare("SELECT timeGenerated FROM users WHERE userId = ?");
    $stmt->execute([$userId]);
    return $stmt->fetchColumn();
}

/**
 * Get user's encryption key
 * @return string|false Key or false if not found
 */
function stmt_getKey(PDO $pdo, int $userId) {
    $stmt = $pdo->prepare("SELECT `key` FROM users WHERE userId = ?");
    $stmt->execute([$userId]);
    return $stmt->fetchColumn();
}

/**
 * Update user's encryption key
 * @return bool True on success
 */
function stmt_updateKey(PDO $pdo, string $userId, string $key): bool {
    $stmt = $pdo->prepare("UPDATE users SET `key` = ? WHERE userId = ?");
    return $stmt->execute([$key, $userId]);
}

/**
 * Update user's TAC code
 * @return bool True on success
 */
function stmt_updateTAC(PDO $pdo, string $userId, string $TAC): bool {
    $stmt = $pdo->prepare("UPDATE users SET TAC = ? WHERE userId = ?");
    return $stmt->execute([$TAC, $userId]);
}

/**
 * Update TAC generation time
 * @return bool True on success
 */
function stmt_updateTimeGenerated(PDO $pdo, string $userId, string $timeGenerated): bool {
    $stmt = $pdo->prepare("UPDATE users SET timeGenerated = ? WHERE userId = ?");
    return $stmt->execute([$timeGenerated, $userId]);
}

/*******************************
 * IMAGE FUNCTIONS
 *******************************/

/**
 * Get random images
 * @return array Array of image data
 */
function stmt_getImageArray(PDO $pdo, int $limit): array {
    $stmt = $pdo->prepare("SELECT * FROM images ORDER BY random() LIMIT ?");
    $stmt->bindValue(1, $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}