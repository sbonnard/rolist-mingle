<?php
session_start();

require_once 'includes/_config.php';
require_once 'includes/_function.php';
require_once 'includes/_database.php';
require_once 'includes/_message.php';
require_once 'includes/_security.php';
require_once './includes/_profilCRUD-functions.php';

header('Content-type:application/json');


if (!isset($_REQUEST['action'])) {
    redirectTo('my-profil-CRUD.php');
}

// Check CSRF
preventFromCSRF();



if (!empty($_POST)) {
    if ($_POST['action'] === 'modify-bio') {
        $queryBio = $dbCo->prepare('UPDATE users SET bio = :bio WHERE id_user = :id_user;');

        $bindValues = [
            'bio' => strip_tags($_POST['bio']),
            'id_user' => intval(8)
        ];

        $isUpdateOk = $queryBio->execute($bindValues);

        if ($isUpdateOk) {
            $_SESSION['msg'] = "update_ok_bio";
        } else {
            $_SESSION['msg'] = "update_ko_bio";
            redirectTo('my-profil-CRUD.php');
        }
    }
    if ($_POST['action'] === 'modify-pwd') {
        $queryPWD = $dbCo->prepare('UPDATE users SET password = :password WHERE id_user = :id_user;');

        $bindValues = [
            'password' => password_hash(strip_tags($_POST['password']), PASSWORD_BCRYPT),
            'id_user' => intval(8)
        ];

        $isUpdateOk = $queryPWD->execute($bindValues);

        if ($isUpdateOk) {
            $_SESSION['msg'] = "update_ok_pwd";
        } else {
            $_SESSION['msg'] = "update_ko_pwd";
        }
    }
    if ($_POST['action'] === 'save_universe') {
        foreach ($_POST['universes'] as $universeId) {
            if ($universeId) {
                $universeId = intval($universeId);
                $userId = intval(8);

                $checkQuery = $dbCo->prepare('
                    SELECT COUNT(*) FROM selected_universe 
                    WHERE id_universe = :universe AND id_user = :user
                ');

                $checkQuery->execute(['universe' => $universeId, 'user' => $userId]);
                $exists = $checkQuery->fetchColumn();

                if ($exists == 0) {
                    $insertQuery = $dbCo->prepare('
                        INSERT INTO selected_universe (id_universe, id_user) 
                        VALUES (:universe, :user)
                    ');

                    $isInsertOk = $insertQuery->execute(['universe' => $universeId, 'user' => $userId]);

                    if ($isInsertOk) {
                        $_SESSION['msg'] = "update_ok_favourites";
                    } else {
                        $_SESSION['msg'] = "update_ko_favourites";
                    }
                }
            }
        }
    }
}

redirectTo();