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


}




redirectTo('index.php');
