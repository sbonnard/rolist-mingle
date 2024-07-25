<?php
session_start();

require_once 'includes/_config.php';
require_once 'includes/_function.php';
require_once 'includes/_database.php';
require_once 'includes/_message.php';
require_once 'includes/_security.php';

// header('Content-type:application/json');


if (!isset($_POST['action'])) {
    triggerError('no_action');
}

// Check CSRF
preventFromCSRF('index.php');

if ($_POST['action'] === 'log-in') {
    if (empty($_REQUEST['email'])) {
        addError('email_ko');
    }

    if (empty($_REQUEST['password'])) {
        addError('email_ko');
    }

    $queryLogIn = $dbCo->prepare('
    SELECT * 
    FROM users 
    WHERE email = :email AND password = :password');

    $bindValues = [
        'email' => filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL),
        'password' => htmlspecialchars($_REQUEST['password'])
    ];

    $isLogInOk = $queryLogIn->execute($bindValues);

    if (!$isLogInOk) {
        addError('login_ko');
    }
}

redirectTo('my-account.php');
