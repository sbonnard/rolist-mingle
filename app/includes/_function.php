<?php

global $dbCo;

$RPG = fetchRPG($dbCo);
$parties = getPartyDatas($dbCo);


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

/**
 * Get RPG datas from a query.
 *
 * @param PDO $dbCo - The connection to database.
 * @return void
 */
function fetchRPG(PDO $dbCo)
{
    $query = $dbCo->prepare("SELECT name_universe FROM universe;");

    $query->execute();

    $RPG = $query->fetchAll(PDO::FETCH_ASSOC);

    return $RPG;
}

/**
 * Retrieve universes from server based on RPG data.
 *
 * @param PDO $dbCo - The connection to database.
 * @return array - Array of universes matching RPG data.
 */
function getResearcFromServer(PDO $dbCo, $userSearch)
{
    // Get RPG array thanks to my function.
    $RPG = fetchRPG($dbCo);

    if (is_array($RPG)) {
        $likeConditions = [];
        $bindValues = [];
        foreach ($RPG as $index => $universe) {
            $paramName = 'universe_' . $index;
            $likeConditions[] = "name_universe LIKE :" . $paramName;
            $bindValues[$paramName] = '%' . $userSearch . '%';
        }

        $querySearch = $dbCo->prepare("SELECT name_universe FROM universe WHERE " . implode(" OR ", $likeConditions));

        $querySearch->execute($bindValues);

        $results = $querySearch->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    } else {
        return false;
    }
}

/**
 * Get datas related to parties from database in a form of an array.
 *
 * @param PDO $dbCo - The connection to database.
 * @return void
 */
function getPartyDatas(PDO $dbCo)
{
    $queryParty = $dbCo->query("SELECT DISTINCT(id_event) AS event_id, name_event, description_, number_players, id_user_master, id_universe, name_universe, username, u.id_role_type FROM event JOIN party USING (id_event) JOIN universe USING(id_universe) JOIN party_users USING (id_party) JOIN users u USING (id_user);");

    $party = $queryParty->execute();

    $datas = $queryParty->fetchAll(PDO::FETCH_ASSOC);

    return $datas;
}


function displayParties(array $parties)
{
    $partyContent = "";
    foreach ($parties as $party) {
        $partyContent .=
            '<section class="container container--swiper">
                <div class="user">
                    <picture>
                        <source class="avatar" srcset="img/avatar-slike-m.webp" media="(min-width: 768px)">
                        <img class="avatar" src="img/avatar-slike.webp" alt="Avatar de Slike">
                    </picture>
                    <h3 class="ttl--big">Slike</h3>
                    <img class="rolist-icon" src="icones/dice20-50x50.svg" alt="Icône dé 20 Sérieux">
                </div>
                <div class="party">
                    <a href="party-1.php">
                        <h2 class="ttl--big">' . $party['name_event'] . '</h2>
                    </a>
                    <a href="party-1.php"><img src="icones/dice20-50x50.svg" alt="Icône dé 20 Sérieux"></a>
                    <div class="party__universe">
                         <h3>' . $party['name_universe'] .
                    '</div>
                    <div class="party__players">
                        <img src="./img/adventurer.svg" alt="Logo aventuriers, nombre de joueurs">
                        <h4>' . $party['number_players'] .
                    '</div>
                </div>
                <a href="party-1.php"><img class="party__img" src="img/party1.webp" alt="Image médiévale avec château"></a>
            </section>';
    }

    return $partyContent;
}

function getUserMaster(PDO $dbCo){
    $queryMaster = $dbCo->query("SELECT id_user, username, id_user_master FROM users JOIN party_users USING (id_user) JOIN party USING(id_party) WHERE id_user = id_user_master;");
}

// function defineRoleTypePlayer(array $parties){
//     return 
// }