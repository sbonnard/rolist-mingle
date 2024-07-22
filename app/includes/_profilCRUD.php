<?php

/**
 * Fetch user datas with id_user = 8.
 *
 * @param [type] $dbCo - The connection to database.
 * @return void
 */
function fetchUser8Datas(PDO $dbCo)
{
    $query = $dbCo->query('
    SELECT id_user, username, email, password, avatar, us.id_role_type AS user_role, ro.id_role_type AS role_id, icon_URL, bio
    FROM users us
    JOIN role_type ro USING (id_role_type)
    WHERE id_user = 8;');

    $profil = $query->execute();

    $userDatas = $query->fetchAll(PDO::FETCH_ASSOC);

    return $userDatas;
}

function fetchUser8Favourites(PDO $dbCo)
{
    $query = $dbCo->query('
    SELECT id_user, name_universe, su.id_universe
    FROM users us
    JOIN selected_universe su USING (id_user)
    JOIN universe USING (id_universe)
    WHERE id_user = 8;');

    $datas = $query->execute();

    $favourites = $query->fetchAll(PDO::FETCH_ASSOC);

    return $favourites;
}

function getFavourites(array $favourites)
{
    $favouritesHTML = '';
    foreach ($favourites as $favourite) {
        $favouritesHTML .=
            '<li class="favourites">
            <input class="button--minus" type="checkbox" name="universes[]" checked="yes" id="favourite-checkbox" data-favourite-minus="" data-delete-rpg-id="' . $favourite['id_universe'] . '" value="' . $favourite['id_universe'] . '">
            <label class="txt--bigger suggestions__txt" id="favourite-rpg"> ' . $favourite['name_universe'] . '</label>
        </li>';
    }
    return $favouritesHTML;
}

// function deleteRPG($dbCo) {
//     $deleteFromRPG = $dbCo->prepare("DELETE FROM selected_universe WHERE id_universe = :id_universe AND id_user = 8;");
    
//     $bindValues = [
//         'id_universe' => intval($inputData['id_universe'])
//     ];

//     $deleteFromRPG->execute($bindValues);
// }
