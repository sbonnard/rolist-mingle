<?php


/**
 * Fetch user datas with id_user = 8.
 *
 * @param [type] $dbCo - The connection to database.
 * @return array
 */
function fetchUserDatas(PDO $dbCo, array $session):array
{
    if (!isset($session['email'])) {
        return [];
    }
    
    $query = $dbCo->prepare('
    SELECT id_user, username, email, password, avatar, us.id_role_type AS user_role, ro.id_role_type AS role_id, icon_URL, bio, name_role
    FROM users us
    JOIN role_type ro USING (id_role_type)
    WHERE email = :email;');

    $bindValues = [
        "email" => strip_tags($session['email'])
    ];

    $profil = $query->execute($bindValues);

    $userDatas = $query->fetchAll(PDO::FETCH_ASSOC);

    return $userDatas;
}


/**
 * Defines the colour of border-color around avatars considering the rolist's role type.
 *
 * @param array $userDatas - An array containing user's data.
 * @return string - A string containing a CSS class.
 */
function defineProfilColour(array $userDatas):string {
    if ($userDatas[0]['user_role'] === 1) {
        return 'avatar--dice100';
    }
    if ($userDatas[0]['user_role'] === 2) {
        return 'avatar--dice20';
    }
    if ($userDatas[0]['user_role'] === 3) {
        return 'avatar--dice12';
    }
    if ($userDatas[0]['user_role'] === 4) {
        return 'avatar--dice8';
    }
    if ($userDatas[0]['user_role'] === 5) {
        return 'avatar--dice4';
    }
    return '';
}


/**
 * Fetches user's favourite rpg's universes from database.
 *
 * @param PDO $dbCo - The connection to database.
 * @param integer $idUser - User's ID you want the datas from.
 * @return array - An array containing user's favourite RPGs.
 */
function fetchUserFavourites(PDO $dbCo, array $session):array
{
    $query = $dbCo->prepare('
    SELECT id_user, email, name_universe, su.id_universe
    FROM users us
    JOIN selected_universe su USING (id_user)
    JOIN universe USING (id_universe)
    WHERE email = :email;');

    $bindValues = [
        "email" => strip_tags($session['email'])
    ];


    $datas = $query->execute($bindValues);

    $favourites = $query->fetchAll(PDO::FETCH_ASSOC);

    return $favourites;
}


/**
 * Display already selected favourites RPGs of a rolist.
 *
 * @param array $favourites - An array containing all favourites RPG's of a given rolist.
 * @return string - A string just like the template of suggestions-bar. 
 */
function getFavourites(array $favourites):string
{
    $favouritesHTML = '';
    foreach ($favourites as $favourite) {
        $favouritesHTML .=
            '<li class="favourites">
            <input class="button--minus" type="checkbox" name="universes[]" checked="yes" id="" data-favourite-minus="" data-delete-rpg-id="' . $favourite['id_universe'] . '" value="' . $favourite['id_universe'] . '">
            <label class="txt--bigger suggestions__txt" id="favourite-rpg"> ' . $favourite['name_universe'] . '</label>
        </li>';
    }
    return $favouritesHTML;
}

