<?php
header('Content-Type: application/json');


require_once './includes/_database.php';
require_once './includes/_function.php';

try {
    $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

    if (!empty($searchTerm)) {

        $results = getResearcFromServer($dbCo, $searchTerm);

        if ($results !== false) {
            echo json_encode($results);
        } else {
            echo json_encode(['error' => 'Erreur lors de la récupération des données']);
        }
    } else {
        $allRPG = fetchRPG($dbCo);
        echo json_encode($allRPG);
    }
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
