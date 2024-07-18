<?php
session_start();

require_once 'includes/_config.php';
require_once 'includes/_function.php';
require_once 'includes/_database.php';
require_once 'includes/_message.php';
require_once 'includes/_security.php';

// header('Content-type:application/json');

// if (!isset($_POST['action'])) {
//     triggerError('no_action');
// }

// Check CSRF
preventFromCSRF('create-account.php');


// Create Account action 
if ($_POST['action'] === 'create_account') {
    if (!empty($_POST)) {

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
        if (!isset($_POST['locality']) || empty(trim($_POST['locality']))) {
            $errors[] = "Locality is required.";
        }
        if (!isset($_POST['universes']) || !is_array($_POST['universes']) || empty($_POST['universes'])) {
            $errors[] = "At least one universe must be selected.";
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            return false;
        }

        try {
            $dbCo->beginTransaction();

            $mainQuery = $dbCo->prepare('
                INSERT INTO users (username, email, password, id_role_type, id_place)
                VALUES (:username, :email, :password, :role, :place);');

            $bindValuesMain = [
                'username' => htmlspecialchars($_POST['username']),
                'email' => htmlspecialchars($_POST['email']),
                'password' => password_hash(htmlspecialchars($_POST['password']), PASSWORD_BCRYPT),
                'role' => intval($_POST['player-type']),
                'place' => intval($_POST['locality'])
            ];

            $isInsertOk = $mainQuery->execute($bindValuesMain);

            if ($isInsertOk) {
                $userId = $dbCo->lastInsertId();

                $universeQuery = $dbCo->prepare('
                INSERT INTO selected_universe (id_universe, id_user) 
                VALUES (:universe, :user);');

                foreach ($_POST['universes'] as $universeId) {
                    $bindValuesUniverse = [
                        'universe' => intval($universeId),
                        'user' => intval($userId)
                    ];
                    $universeQuery->execute($bindValuesUniverse);
                }

                addMessage('create_ok');
            } else {
                addError('create_ko');
            }

            $dbCo->commit();
            
        } catch (Exception $error) {

            var_dump('Raté');
            var_dump($errors);
            $_SESSION['errors'] = "create_ko: " . $error->getMessage();
            $dbCo->rollBack();
            return false;
        }
    }
    
    // if (!createNewAccount($dbCo)) triggerError('create_ko');
    
    // echo json_encode([
        //     'isOk' => $isInserteOk && $isQuery2Ok,
        // ]);
    }
    
    
    
    redirectTo('index.php');