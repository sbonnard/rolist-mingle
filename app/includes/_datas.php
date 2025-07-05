<?php

require_once "_function.php";

$RPG = fetchRPG($dbCo);

// Call a function to fetch user datas instead of []
// -------------------------------------------------
$userdatas = [];

// Define color by fetching it from database later
// -----------------------------------------------
$profilColor = '';