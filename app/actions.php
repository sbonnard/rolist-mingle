<?php
session_start();

require_once 'includes/_config.php';
require_once 'includes/_function.php';
require_once 'includes/_database.php';
require_once 'includes/_message.php';
require_once 'includes/_security.php';

header('Content-type:application/json');


if (!isset($_POST['action'])) {
    triggerError('no_action');
}

// Check CSRF
preventFromCSRF('create-account.php');


// Create Account action 
if ($_POST['action'] === 'create_account') {
    if (!empty($_POST)) {



        $errors = [];

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

        if ($_POST['password'] !== $_POST['check-password']) {
            $errors[] = "Les mots de passe ne correspondent pas.";
            addError('mdp_no_match');
            redirectTo();
        }


        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            return false;
        }


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
            ];

            $isInsertOk = $mainQuery->execute($bindValuesMain);
            $userId = $dbCo->lastInsertId();
            if ($isInsertOk) {

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
            }
            $dbCo->commit();
        } catch (Exception $error) {
            var_dump('PDO exception: ' . $error->getMessage());
            $_SESSION['errors'] = "create_ko: " . $error->getMessage();
            $dbCo->rollBack();
            return false;
        }
    }
}



redirectTo('index.php');
