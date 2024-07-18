<?php

global $dbCo;

// $RPG = fetchRPG($dbCo);
// $parties = getPartyDatas($dbCo);
// $partiesDatas = getPartyDatasOnly($dbCo);

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
 * Redirect to the given URL.
 *
 * @param string $url
 * @return void
 */
function redirectTo(string $url): void
{
    // var_dump('REDIRECT ' . $url);
    header('Location: ' . $url);
    exit;
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
    $query = $dbCo->prepare("SELECT name_universe, id_universe FROM universe;");

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
 * @return array
 */
function getPartyDatas(PDO $dbCo): array
{
    $queryParty = $dbCo->query("
    SELECT DISTINCT(id_event) AS event_id, name_event, description_, number_players, id_user_master, id_universe, name_universe, username, id_user,
           u.id_role_type AS user_role, p.id_role_type AS party_type, ru.icon_URL AS user_icon_URL, rp.icon_URL AS party_icon_URL, 
           ru.name_role AS user_alt, rp.name_role AS party_alt, r.id_role_type AS role, image
    FROM event 
    JOIN party p USING (id_event) 
    JOIN universe USING (id_universe) 
    JOIN party_users USING (id_event) 
    JOIN users u USING (id_user) 
    JOIN role_type r ON u.id_role_type = r.id_role_type
    JOIN role_type ru ON u.id_role_type = ru.id_role_type
    JOIN role_type rp ON p.id_role_type = rp.id_role_type
    WHERE game_master = 1;");

    $party = $queryParty->execute();

    $datas = $queryParty->fetchAll(PDO::FETCH_ASSOC);


    return $datas;
}

/**
 * Displays party datas into parties.php.
 *
 * @param array $parties - The array containing every party datas.
 * @return string - HTML template filled with datas.
 */
function displayParties(array $parties): string
{
    $partyContent = "";
    foreach ($parties as $party) {
        $partyContent .=
            '<section class="container container--swiper">
                <div class="user">
                    <picture>
                        <img class="avatar ' . defineRoleTypePlayer($party) . '" src="' . $party['image'] . '" alt="Avatar de ' . $party['username'] . '">
                    </picture>
                    <a class="lnk" href="user-' . $party['id_user'] . '.php">
                        <h3 class="ttl--big">' . $party['username'] . '</h3>
                    </a>
                    <img class="rolist-icon" src="' . $party['user_icon_URL'] . '" alt="' . $party['user_alt'] . '">
                </div>
                <div class="party">
                    <a class="lnk" href="party-' . $party['event_id'] . '.php">
                        <h2 class="ttl--big party__ttl">' . $party['name_event'] . '</h2>
                    </a>
                    <a href="party-' . $party['event_id'] . '.php"><img src="' . $party['party_icon_URL'] . '" alt="' . $party['party_alt'] . '"></a>
                    <div class="party__universe">
                         <h3>' . $party['name_universe'] . '</h3>
            </div>
                    <div class="party__players">
                        <img src="./img/adventurer.svg" alt="Logo aventuriers, nombre de joueurs">
                        <h4>' . $party['number_players'] .
            '</div>
                </div>
                <a href="party-' . $party['event_id'] . '.php"">
                    <img class="party__img" src="img/party1.webp" alt="Image médiévale avec château">
                </a>
            </section>';
    }

    return $partyContent;
}

/**
 * Defines player role and attributes it his/her avatar color.
 *
 * @param array $parties - The array containing every party datas.
 * @return string - A string corresponding to a CSS class.
 */
function defineRoleTypePlayer(array $parties): string
{
    if ($parties['user_role'] === 1) {
        return 'avatar--dice100';
    } else if ($parties['user_role'] === 2) {
        return 'avatar--dice20';
    } else if ($parties['user_role'] === 3) {
        return 'avatar--dice12';
    } else if ($parties['user_role'] === 4) {
        return 'avatar--dice8';
    } else if ($parties['user_role'] === 5) {
        return 'avatar--dice4';
    }
}

function createNewAccount(PDO $dbCo)
{
    global $errors;
    if (!empty($_REQUEST)) {

        $errors = [];

        // Validation des champs et ajout des erreurs éventuelles
        if (!isset($_REQUEST['username']) || empty(trim($_REQUEST['username']))) {
            $errors[] = "Username is required.";
        }
        if (!isset($_REQUEST['email']) || empty(trim($_REQUEST['email']))) {
            $errors[] = "Email is required.";
        }
        if (!isset($_REQUEST['password']) || empty(trim($_REQUEST['password']))) {
            $errors[] = "Password is required.";
        }
        if (!isset($_REQUEST['player-type']) || empty(trim($_REQUEST['player-type']))) {
            $errors[] = "Player type is required.";
        }
        if (!isset($_REQUEST['locality']) || empty(trim($_REQUEST['locality']))) {
            $errors[] = "Locality is required.";
        }
        if (!isset($_REQUEST['universes']) || !is_array($_REQUEST['universes']) || empty($_REQUEST['universes'])) {
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
                'username' => htmlspecialchars($_REQUEST['username']),
                'email' => htmlspecialchars($_REQUEST['email']),
                'password' => password_hash(htmlspecialchars($_REQUEST['password']), PASSWORD_BCRYPT),
                'role' => intval($_REQUEST['player-type']),
                'place' => intval($_REQUEST['locality'])
            ];

            $isInsertOk = $mainQuery->execute($bindValuesMain);

            if ($isInsertOk) {
                $userId = $dbCo->lastInsertId();

                $universeQuery = $dbCo->prepare('
                INSERT INTO selected_universe (id_universe, id_user) 
                VALUES (:universe, :user);');

                foreach ($_REQUEST['universes'] as $universeId) {
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
            return $isInsertOk;
        } catch (Exception $error) {
            $_SESSION['errors'] = "create_ko: " . $error->getMessage();
            $dbCo->rollBack();
            return false;
        }
    }
}

function fetchUniverses($dbCo)
{
    $query = $dbCo->prepare('SELECT id_universe, name_universe FROM universe');
    $query->execute();
    $universes = $query->fetchAll(PDO::FETCH_ASSOC);

    return $universes;
}
