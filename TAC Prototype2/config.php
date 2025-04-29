<?php

session_set_cookie_params([
    'lifetime' => 1800,
    'domain' => 'localhost',
    'path' => '/',
    'secure' => 'true',
    'httponly' => true
]);

session_start();

if (!isset($_SESSION['lastRegeneration'])) {

    session_regenerate_id(true);
    $_SESSION['lastRegeneration'] = time();
}
else {

    $interval = 60 * 30;

    if (time() - $_SESSION['lastRegeneration'] >= $interval) {

        session_regenerate_id(true);
        $_SESSION['lastRegeneration'] = time();
    }
}