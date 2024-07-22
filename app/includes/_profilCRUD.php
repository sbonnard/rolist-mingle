<?php

/**
 * Fetch user datas with id_user = 8.
 *
 * @param [type] $dbCo - The connection to database.
 * @return void
 */
function fetchUser8Datas($dbCo) {
    $query = $dbCo->query('
    SELECT id_user, username, email, password, avatar, us.id_role_type AS user_role, ro.id_role_type AS role_id, icon_URL
    FROM users us
    JOIN role_type ro USING (id_role_type)
    WHERE id_user = 8;');

    $profil = $query->execute();

    $userDatas = $query->fetchAll(PDO::FETCH_ASSOC);

    return $userDatas;
}