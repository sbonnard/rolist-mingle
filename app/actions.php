<?php
session_start();

include 'includes/_config.php';
include 'includes/_function.php';
include 'includes/_database.php';
include 'includes/_messages.php';

header('Content-type:application/json');

$inputData = json_decode(file_get_contents('php://input'), true);


if (!isset($inputData['action'])) {
    triggerError('no_action');
}

// Check CSRF
preventFromCSRFAPI($inputData);



if ($_REQUEST['action'] === 'create_account' && isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])) {

    $query = $dbCo->prepare("UPDATE product SET price = price * 1.1 WHERE ref_product = :id;");
    $query = $dbCo->prepare('
    INSERT INTO users (username, email, password, id_role_type, id_place)
    VALUES (:username, :email, :password, :role, :place);');

    $isInsertOk = $query->execute(['id' => intval($_REQUEST['id'])]);

    if ($isInsertOk) {
        addMessage('create_ok');
    } else {
        addError('create_ko');
    }
}




redirectTo('index.php');
