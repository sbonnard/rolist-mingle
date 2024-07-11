<?php
header('Content-Type: application/json');

// Inclure les fichiers nécessaires
require_once './includes/_database.php';
require_once './includes/_function.php';

try {
    // Appeler la fonction fetchRPG pour obtenir les données
    $allRPG = fetchRPG($dbCo);

    // Convertir le résultat en JSON et l'afficher
    echo json_encode($allRPG);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}

// var_dump($allRPG);