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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'log-in') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = $dbCo->prepare('SELECT * FROM users WHERE email = :email');
    $query->execute(['email' => $email]);
    $user = $query->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['password'] = $user['password'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['id_user'] = $userDatas[0]['id_user'];
        redirectTo('my-profil-CRUD.php');
        exit();
    } else {
        echo "Identifiants incorrects. Veuillez réessayer.";
    }
}

redirectTo('my-profil-CRUD.php');
