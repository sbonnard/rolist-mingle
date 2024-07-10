<?php

$messages = [
    'insert_ok' => 'JDR ajoutée.'
];

$errors = [
    'csrf' => 'Votre session est invalide.',
    'referer' => 'D\'où venez vous ?'
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
    // var_dump($error);
    $response = [
        'isOk' => false,
        'errorMessage' => $errors[$error]
    ];
    echo json_encode($response);
    exit;
}