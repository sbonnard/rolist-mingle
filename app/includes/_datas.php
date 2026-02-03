<?php

require_once "_function.php";
require_once "classes/_character.php";
require_once "_profilCRUD-functions.php";

$isLocked = true;

// Links for head
$javascriptLink = 'script-BEwUcXip';
$cssLink = 'script-BIH6tRty';

$RPG = fetchRPG($dbCo);

// Call a function to fetch user datas instead of []
// -------------------------------------------------
$userdatas = fetchUserDatas($dbCo, $_SESSION, $_GET);

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