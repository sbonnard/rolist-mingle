<?php
session_start();

require_once 'includes/_config.php';
require_once 'includes/_function.php';
require_once 'includes/_database.php';

header('Content-Type: application/json');

$inputData = json_decode(file_get_contents('php://input'), true);

if (!is_array($inputData) || !isset($inputData['action'])) {
    echo json_encode(['success' => false, 'message' => 'No action specified']);
    exit;
}

// -----------------------------
// DELETE EXISTANT
// -----------------------------
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    if ($inputData['action'] === 'delete' && isset($inputData['id']) && is_numeric($inputData['id'])) {

        $deleteFromRPG = $dbCo->prepare("DELETE FROM selected_universe WHERE id_universe = :id_universe AND id_user = 8;");
        if ($deleteFromRPG->execute(['id_universe' => intval($inputData['id'])])) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete']);
        }
        exit;
    }
    echo json_encode(['success' => false, 'message' => 'Invalid DELETE request']);
    exit;
}

// -----------------------------
// GET CHARACTER POUR AJAX
// -----------------------------
if ($inputData['action'] === 'getCharacter') {

    if (!isset($inputData['id_character'])) {
        echo json_encode(['error' => 'ID manquant']);
        exit;
    }

    $id = (int)$inputData['id_character'];

    $stmt = $dbCo->prepare("SELECT * FROM characters WHERE id_character = ?");
    $stmt->execute([$id]);
    $character = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$character) {
        echo json_encode(['error' => 'Personnage introuvable']);
        exit;
    }

    // 🔥 On met à jour la session
    $_SESSION['id_character'] = $id;

    echo json_encode([
        'success' => true,
        'character' => $character
    ]);
    exit;
}

// -----------------------------
// AUTRE ACTION INCONNUE
// -----------------------------
echo json_encode(['success' => false, 'message' => 'Unknown action']);
exit;
