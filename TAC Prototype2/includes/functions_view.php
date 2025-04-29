<?php

require_once "functions_control.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

/**
 * Display form input errors to users
 */
function displayUserErrors(): void
{
    if (!empty($_SESSION['userErrors'])) {
        $errors = $_SESSION['userErrors'];
        unset($_SESSION['userErrors']);

        echo '<div class="error-messages">';
        foreach ($errors as $error) {
            echo '<p class="user-errors">'
                . htmlspecialchars($error)
                . '</p>';
        }
        echo '</div>';
    }
}

/**
 * Display a users balance
 */
function displayBalance($pdo,$userId): void
{
    $balance = stmt_getBalance($pdo,$userId);
    echo $balance;
}

/**
 * Output signup form inputs with preserved values
 * @param array $excludeErrors Error types that should clear specific fields
 */
function signupInput(): void
{
    $data = $_SESSION['signupData'] ?? [];
    $errors = $_SESSION['userErrors'] ?? [];

    $validData = array_diff_key($data, $errors);

    // Helper function to output attributes
    function getAttribute(array $data, string $field): string
    {
        return isset($data[$field]) ? ' value="' . htmlspecialchars($data[$field]) . '"' : '';
    }

    echo '<input type="text" name="username" id="username" placeholder="Username"'
        . getAttribute($validData, 'username') . '>';

    echo '<input type="email" name="email" id="email" placeholder="Email"'
        . getAttribute($validData, 'email') . '>';

    echo '<input type="text" name="fName" id="fName" placeholder="First name"'
        . getAttribute($validData, 'fName') . '>';

    echo '<input type="text" name="lName" id="lName" placeholder="Last name"'
        . getAttribute($validData, 'lName') . '>';


    echo '<input type="password" name="password" id="password" placeholder="Password" value="">';
    echo '<input type="password" name="rePassword" id="rePassword" placeholder="Re-type password" value="">';

    unset($_SESSION['signupData']);
}

/**
 * Render navigation bar
 * @param string $currentPage Current page identifier
 */
function renderNavbar(PDO $pdo, string $currentPage): void
{
    $isLoggedIn = !empty($_SESSION['loggedIn']);

    $isAdmin = !empty($_SESSION['userId']) ? isAdmin($pdo, $_SESSION['userId']) : false;

    $navItems = [
        'home' => ['title' => "Home", 'url' => '../public/home.php'],
        'about' => ['title' => "About", 'url' => '../public/about.php'],
    ];

    if ($isLoggedIn && $isAdmin) {
        $navItems += [
            'adminControls' => ['title' => "Admin Controls", 'url' => '../public/controls.php'],
        ];
    } elseif ($isLoggedIn) {
        $navItems += [
            'account' => ['title' => "Accounts", 'url' => '../public/account.php'],
            'balance' => ['title' => "Balance", 'url' => '../public/balance.php'],
            'transfer' => ['title' => "Transfer", 'url' => '../public/transfer.php'],
            'transactions' => ['title' => "Transactions", 'url' => '../public/transactions.php'],
        ];
    }
?>
    <nav class="navbar-container">
        <a href="../public/home.php" class="navbar-logo">Task Manager</a>

        <ul class="navbar-items">
            <?php foreach ($navItems as $itemKey => $item): ?>
                <li class="navbar-item<?= $itemKey === $currentPage ? ' active' : '' ?>">
                    <a href="<?= htmlspecialchars($item['url']) ?>" class="navbar-link">
                        <?= htmlspecialchars($item['title']) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>

        <?php if ($isLoggedIn): ?>
            <a href="../includes/logout.php" class="navbar-logout">Log out</a>
        <?php else: ?>
            <a href="../public/login-form.php" class="navbar-login">Log in</a>
        <?php endif; ?>
    </nav>
<?php
}

