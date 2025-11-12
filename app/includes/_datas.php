<?php

require_once "_function.php";
require_once "classes/_character.php";

$RPG = fetchRPG($dbCo);

// Call a function to fetch user datas instead of []
// -------------------------------------------------
$userdatas = [];

// Define color by fetching it from database later
// -----------------------------------------------
$profilColor = '';

// Define character datas
// ----------------------
if (isset($_SESSION['id_user'])) {
    $charactersDatas = getCharacterDatas($dbCo, $_SESSION['id_user']);
}

