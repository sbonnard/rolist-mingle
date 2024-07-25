<?php
session_start();

require_once 'includes/_config.php';
require_once 'includes/_function.php';
require_once 'includes/_database.php';
require_once 'includes/_message.php';
require_once 'includes/_security.php';
require_once './includes/_profilCRUD-functions.php';


header('Content-type:application/json');

$inputData = json_decode(file_get_contents('php://input'), true);

if (!isset($inputData['action'])) {
    triggerError('no_action');
    echo json_encode(['success' => false, 'message' => 'No action specified']);
    exit;
}

// preventFromCSRFAPI($inputData);

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $inputData = json_decode(file_get_contents('php://input'), true);

    if (isset($inputData['action']) && $inputData['action'] === 'delete' && isset($inputData['id']) && is_numeric($inputData['id'])) {
        $deleteFromRPG = $dbCo->prepare("DELETE FROM selected_universe WHERE id_universe = :id_universe AND id_user = 8;");
        
        $bindValues = [
            'id_universe' => intval($inputData['id'])
        ];

        if ($deleteFromRPG->execute($bindValues)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete favourite']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request parameters']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
