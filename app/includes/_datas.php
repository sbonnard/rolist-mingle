<?php

require_once "_function.php";
require_once "classes/_character.php";
require_once "_profilCRUD-functions.php";

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
}

