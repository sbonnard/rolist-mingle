<?php

// PREVENT FROM CSRF 

/**
 * Check fo referer
 *
 * @return boolean Is the current referer valid ?
 */
function isRefererOk(): bool
{
    global $globalURL;
    // var_dump($globalURL);
    return isset($_SERVER['HTTP_REFERER'])
        && str_contains($_SERVER['HTTP_REFERER'], $globalURL);
}


/**
 * Check for CSRF token
 *
 * @param array|null $data Input data
 * @return boolean Is there a valid toekn in user session ?
 */
function isTokenOk(?array $data = null): bool
{
    if (!is_array($data)) $data = $_REQUEST;

    return isset($_SESSION['token'])
        && isset($data['token'])
        && $_SESSION['token'] === $data['token'];
}

/**
 * Verify HTTP referer and token. Redirect with error message.
 *
 * @return void
 */
function preventFromCSRF(): void
{
    if (!isRefererOk()) {
        addError('referer');
        exit;
    }

    if (!isTokenOk()) {
        addError('csrf');
        exit;
    }
}

/**
 * Prevents from CSRF by checking HTTP_REFERER in $_SERVER and checks if the random token from generateToken() matches in form.
 *
 * @return void
 */
function preventFromCSRFAPI($inputData): void
{
    global $globalURL;

    if (!isset($_SERVER['HTTP_REFERER']) || !str_contains($_SERVER['HTTP_REFERER'], $globalURL)) {
        triggerError('referer');
    }

    if (!isset($_SESSION['token']) || !isset($inputData['token']) || $_SESSION['token'] !== $inputData['token']) {
        triggerError('csrf');
    }

    if (isset($error)) triggerError($error);
}