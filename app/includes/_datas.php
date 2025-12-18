<?php

require_once "_function.php";
require_once "classes/_character.php";
require_once "_profilCRUD-functions.php";

$isLocked = true;

$javascriptLink = '<script src="./js/main.js"></script>';
$cssLink = '<script src="./js/main.js"></script>';

$RPG = fetchRPG($dbCo);

// Call a function to fetch user datas instead of []
// -------------------------------------------------
$userdatas = fetchUserDatas($dbCo, $_SESSION);

// Define color by fetching it from database later
// -----------------------------------------------
$profilColor = '';

// Define character datas
// ----------------------
if (isset($_SESSION['id_user'])) {
    $charactersDatas = getCharacterDatas($dbCo, $_SESSION['id_user']);
    if(empty($charactersDatas)) {
        $_SESSION['characterFound'] = false;
    } else {
        $_SESSION['characterFound'] = true;
    }
} else {
    $charactersDatas = [];
}

if (isset($_SESSION['id_character'])) {
    $selectedCharacterDatas = getSelectedCharacterDatas($dbCo, $_SESSION['id_user'], $_SESSION['id_character']);
} else {
    $selectedCharacterDatas = [];
}