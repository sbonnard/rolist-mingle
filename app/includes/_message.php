<?php

$messages = [
    'insert_ok' => 'JDR ajoutée.',
    'create_ok' => 'Réussite critique lors de la création de compte !',
    'update_ok_bio' => 'Réussite critique lors de la mise à jour de la bio !',
    'update_ok_pwd' => 'Réussite critique lors de la mise à jour du mot de passe !',
    'update_ok_favourites' => 'Réussite critique lors de la modification d\'univers favoris !',
    'delete_ok' => 'L\'univers a été supprimé.'
];

$errors = [
    'csrf' => 'Votre session est invalide.',
    'referer' => 'D\'où venez vous ?',
    'no_action' => 'Aucune action détectée.',
    'no_search' => 'La recherche n\'a rien donné.',
    'create_ko' => 'Échec critique lors de la création de compte !',
    'update_ko_bio' => 'Échec critique lors de la mise à jour de la bio !',
    'update_ko_pwd' => 'Échec critique lors de la mise à jour du mot de passe !',
    'update_ko_favourites' => 'Échec critique lors de la modification d\'univers favoris !',
    'email_ko' => 'Merci d\'entrer votre mot de passe',
    'password_ko' => 'Merci de saisir votre mot de passe',
    'login_ko' => 'Échec critique lors de la saisie du mot de passe ou de l\'email !'
];


/**
 * Triggers if an error occurs and exits script.
 *
 * @param string $error The name of the error from errors array.
 * @return void
 */
function triggerError(string $error): void
{
    global $errors;
    $response = [
        'isOk' => false,
        'errorMessage' => $errors[$error]
    ];
    echo json_encode($response);
    exit;
}

/**
 * Add a new error message to display on next page. 
 *
 * @param string $errorMsg - Error message to display
 * @return void
 */
function addError(string $errorMsg): void
{
    if (!isset($_SESSION['errorsList'])) {
        $_SESSION['errorsList'] = [];
    }
    $_SESSION['errorsList'][] = $errorMsg;
}


/**
 * Add a new message to display on next page. 
 *
 * @param string $message - Message to display
 * @return void
 */
function addMessage(string $message): void
{
    $_SESSION['msg'] = $message;
}

/**
 * Get error messages if the user fails to add a task.
 *
 * @return string The error message.
 */
function getErrorMessage(array $errors) :string
{
    if (isset($_SESSION['error'])) {
        $e = ($_SESSION['error']);
        unset($_SESSION['error']);
        return '<p class="notif notif--error">' . $errors[$e] . '</p>';
    }
    return '';
}

/**
 * Get success messages if the user succeeds to add a task.
 *
 * @return string The success message.
 */
function getSuccessMessage(array $messages) :string
{
    if (isset($_SESSION['msg'])) {
        $m = ($_SESSION['msg']);
        unset($_SESSION['msg']);
        return '<p class="notif notif--success">' . $messages[$m] . '</p>';
    }
    return '';
}