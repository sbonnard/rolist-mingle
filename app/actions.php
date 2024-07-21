<?php
session_start();

require_once 'includes/_config.php';
require_once 'includes/_function.php';
require_once 'includes/_database.php';
require_once 'includes/_message.php';
require_once 'includes/_security.php';

// header('Content-type:application/json');

var_dump('1');

if (!isset($_POST['action'])) {
    triggerError('no_action');
}

// Check CSRF
preventFromCSRF('create-account.php');

var_dump('2');

// Create Account action 
if ($_POST['action'] === 'create_account') {
    if (!empty($_POST)) {


var_dump('POST n est pas vide');

        $errors = [];

        // Validation des champs et ajout des erreurs éventuelles
        if (!isset($_POST['username']) || empty(trim($_POST['username']))) {
            $errors[] = "Username is required.";
        }
        if (!isset($_POST['email']) || empty(trim($_POST['email']))) {
            $errors[] = "Email is required.";
        }
        if (!isset($_POST['password']) || empty(trim($_POST['password']))) {
            $errors[] = "Password is required.";
        }
        if (!isset($_POST['player-type']) || empty(trim($_POST['player-type']))) {
            $errors[] = "Player type is required.";
        }
        // if (!isset($_POST['locality']) || empty(trim($_POST['locality']))) {
        //     $errors[] = "Locality is required.";
        // }
        // if (!isset($_POST['universes']) || !is_array($_POST['universes']) || empty($_POST['universes'])) {
        //     $errors[] = "At least one universe must be selected.";
        // }

        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            return false;
        }

var_dump('aucune erreur');

        
        try {
            $dbCo->beginTransaction();
            
            $mainQuery = $dbCo->prepare('
            INSERT INTO users (username, email, password, id_role_type)
            VALUES (:username, :email, :password, :role);');
            
            $bindValuesMain = [
                'username' => htmlspecialchars($_POST['username']),
                'email' => strip_tags($_POST['email']),
                'password' => password_hash(htmlspecialchars($_POST['password']), PASSWORD_BCRYPT),
                'role' => intval($_POST['player-type'])
                // 'place' => intval($_POST['locality'])
            ];

            var_dump($bindValuesMain); // Débogage

            
            $isInsertOk = $mainQuery->execute($bindValuesMain);
            var_dump('no error for first query');
            $userId = $dbCo->lastInsertId();
            var_dump($userId);
            if ($isInsertOk) {

                $universeQuery = $dbCo->prepare('
                INSERT INTO selected_universe (id_universe, id_user) 
                VALUES (:universe, :user);');

                foreach ($_POST['universes'] as $universeId) {
                    $bindValuesUniverse = [
                        'universe' => intval($universeId),
                        'user' => intval($userId)
                    ];

            var_dump($bindValuesUniverse); // Débogage

                    $universeQuery->execute($bindValuesUniverse);
                }

                addMessage('create_ok');
                
            }
            $dbCo->commit();
        }
            
         catch (Exception $error) {
            var_dump('Raté');
            $_SESSION['errors'] = "create_ko: " . $error->getMessage();
            $dbCo->rollBack();
            return false;
        }
    }
}   
    // if (!createNewAccount($dbCo)) triggerError('create_ko');
    
    // echo json_encode([
        //     'isOk' => $isInserteOk && $isQuery2Ok,
        // ]);

    redirectTo('index.php');
    
    
    