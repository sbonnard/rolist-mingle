<?php
session_start();

require_once 'includes/_config.php';
require_once 'includes/_function.php';
require_once 'includes/_database.php';
require_once 'includes/_message.php';
require_once 'includes/_security.php';

// header('Content-type:application/json');

var_dump('1');

if (!isset($_POST['action'])) {
    triggerError('no_action');
}

// Check CSRF
preventFromCSRF('my-profil-CRUD');

var_dump('2');
if (!empty($_POST)) {
    if ($_POST['action'] === 'modify-bio') {

    }
}

redirectTo('my-profil-CRUD.php');