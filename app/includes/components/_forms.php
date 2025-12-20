<?php

/**
 * Generates the HTML form section of the page for editing the user's bio.
 *
 * @param array $session - The current user's session data.
 * @param array $userDatas - An array containing user's data, including avatar and other info.
 * @return string - The HTML content of the form section.
 */
function getBioForm(array $session, array $userDatas): string
{
    if (!empty($userDatas) && isset($userDatas[0]['bio']) && isset($session['id_user'])) {
        return '<form id="form-bio" class="container container--profile hidden" action="actions-CRUD.php" method="post" aria-labelledby="my-bio" aria-label="Modifier les informations de mon compte">
                        <h3 id="my-bio" class="ttl--big">Ma bio</h3>
                        <ul class="form__container">
                            <li class="form__itm">
                                <textarea class="input input__text-area" name="bio" id="bio" placeholder="Ma petite vie...">' . $userDatas[0]['bio'] . '</textarea>
                            </li>
                            <input class="button" type="submit" value="Enregistrer">
                            <input type="hidden" name="action" value="modify-bio">
                            <input type="hidden" name="token" value="' . $session['token'] . '">
                        </ul>
                    </form>';
    } else {
        return '';
    }
}


/**
 * Generates the HTML form section of the page for editing the user's password.
 *
 * @param array $session - The current user's session data.
 * @param array $userDatas - An array containing user's data, including avatar and other info.
 * @return string - The HTML content of the form section.
 */
function getPasswordForm(array $session, array $userDatas): string
{
    if (!empty($userDatas) && isset($userDatas[0]['bio']) && isset($session['id_user'])) {
        return '<form id="form-pwd" class="container container--profile hidden" action="actions-CRUD.php" method="post" aria-labelledby="my-bio" aria-label="Modifier les informations de mon compte">
                    <ul class="form__container">
                        <li class="form__itm">
                            <label for="password" class="input__label">Changer le mot de passe</label>
                            <div class="input--password">
                                <input class="input" type="password" name="password" id="password" placeholder="•••••••••••" required aria-label="Merci d\'entrer votre mot de passe">
                                <button type="button" class="button--eye button--eye--inactive" id="eye-button" aria-label="Montrer le mot de passe en clair dans le champs de saisie"></button>
                            </div>
                        </li>
                        <input class="button" type="submit" value="Enregistrer">
                        <input type="hidden" name="action" value="modify-pwd">
                        <input type="hidden" name="token" value="' . $session['token'] . '">

                    </ul>
                </form>';
    } else {
        return '';
    }
}


/**
 * Generates the HTML form section of the page for editing the user's favourite RPGs.
 *
 * @param array $session - The current user's session data.
 * @param array $userDatas - An array containing user's data, including avatar and other info.
 * @param array $favourites - An array containing all favourites RPG's of a given rolist.
 * @return string - The HTML content of the form section.
 */
function getRPGForm(array $session, array $userDatas, array $favourites): string
{
    if (!empty($userDatas) && isset($userDatas[0]['bio']) && isset($session['id_user'])) {
        return '<form id="form-rpg" class="container container--profile" action="actions-CRUD.php" method="post" aria-labelledby="my-bio" aria-label="Modifier les informations de mon compte">
                    <ul class="form__container">
                        <li class="form__itm form__itm--select">
                            <label class="input__label form__question" for="suggestionsField">
                                Quelles sont tes univers de jeu préférés ?
                            </label>
                            <input class="input suggestions__input" type="text" id="suggestionsField" name="suggestionsField" placeholder="Tapez quelque chose..." aria-label="Entre le nom de ton JDR préféré et appuie sur \'entrée\' pour valider ton choix">
                            <div class="suggestions__list">
                                <div class="suggestions" id="suggestions"></div>
                            </div>
                            <ul id="selectedItemsList">'
                    . getFavourites($favourites) .
                    '</ul>
                        </li>
                        <input class="button" type="submit" value="Enregistrer">
                        <input type="hidden" name="action" value="save_universe">
                        <input type="hidden" name="token" value="' . $session['token'] . '">
                        <input type="hidden" name="id_user" value="' . $userDatas[0]['id_user'] . '">
                    </ul>
                </form>';
    } else {
        return '';
    }
}