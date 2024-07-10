<?php

/**
 * Generates a random token for forms to prevent from CSRF. It also generate a new token after 15 minutes.
 *
 * @return void
 */
function generateToken()
{
    if (
        !isset($_SESSION['token'])
        || !isset($_SESSION['tokenExpire'])
        || $_SESSION['tokenExpire'] < time()
    ) {
        $_SESSION['token'] = md5(uniqid(mt_rand(), true));
        $_SESSION['tokenExpire'] = time() + 60 * 15;
    }
}

/**
 * Get HTML script to load front-end assets defined in the manifest.json file for entry points given.
 *
 * @param array $entries - A list of JS files to load.
 * @return string
 */
function loadAssets(array $entries): string
{
    if (!file_exists('.vite/manifest.json')) return '';

    $html = '';
    $assets = json_decode(file_get_contents('.vite/manifest.json'), true);

    foreach ($entries as $entry) {
        if (!array_key_exists($entry, $assets)) continue;

        $html .= '<script type="module" src="' . $assets[$entry]['file'] . '"></script>';
        if (isset($assets[$entry]['css']) && is_array($assets[$entry]['css'])) {
            $html .= implode(
                array_map(
                    fn ($file) => '<link rel="stylesheet" href="' . $file . '">',
                    $assets[$entry]['css']
                )
            );
        }
    }

    return $html;
}

/**
 * Checks environment dev or prod.
 *
 * @param string $file - The path to a js file to link in your <head>.
 * @return void
 */
function checkEnvironment(string $file)
{
    if ($_ENV['ENV_TYPE'] === 'dev') {
        // Developement integration for vite with run dev
        echo '<script type="module" src="http://localhost:5173/@vite/client"></script>
        <script type="module" src="http://localhost:5173/js/main.js"></script>';
    } else if ($_ENV['ENV_TYPE'] === 'prod') {
        // Production integration for vite with run build
        echo loadAssets([$file]);
        // Try this way to load assets from manifest.json
        // https://github.com/andrefelipe/vite-php-setup
    }
}


function fetchRPG(PDO $dbCo)
{
    $allRPG = "";
    
    $query = $dbCo->prepare("SELECT name_universe FROM universe;");

    $query->execute();

    $RPG = $query->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($RPG as $rpg) {
    
        if ($RPG) {
            $allRPG .= '<li>' . htmlspecialchars($rpg['name_universe']) . '</li>';
        }
    }
    
    return $allRPG;
}

/**
 * Get RPG array from a query.
 *
 * @param PDO $dbCo - The connection to database.
 * @return void
 */
function getRPGArray (PDO $dbCo) {
    $query = $dbCo->prepare("SELECT name_universe FROM universe;");

    $query->execute();

    $RPG = $query->fetchAll(PDO::FETCH_ASSOC);

    var_dump($RPG);
}