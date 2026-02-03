<?php
session_start();

require_once "./includes/_config.php";
require_once "./includes/_database.php";
require_once './includes/_function.php';
require_once './includes/_profilCRUD-functions.php';
require_once './includes/_message.php';
require_once './includes/_security.php';
require_once './includes/_datas.php';
// require_once "./includes/classes/_user.php";
require_once "./includes/components/_head.php";
require_once "./includes/components/_header.php";
require_once "./includes/components/_footer.php";
require_once "./includes/components/_forms.php";

checkConnection($_SESSION);

// var_dump($_SESSION['email']);

generateToken();

if (isset($_GET['id_user']) && intval($_GET['id_user']) !== $_SESSION['id_user'] && isset($_SESSION['id_user']) && $_SESSION['overlord'] === 1) {
    // Uniquely for overlord but wil be functionning soon
    $userDatas = fetchUserDatas($dbCo, $_SESSION, $_GET);
    $favourites = fetchUserFavourites($dbCo, $_GET);
} else if (!isset($_GET['id_user']) || (isset($_GET['id_user']) && intval($_GET['id_user']) === $_SESSION['id_user']) && $_SESSION['overlord'] === 0) {
    // See your profile
    $userDatas = fetchUserDatas($dbCo, $_SESSION, $_GET);
    $favourites = fetchUserFavourites($dbCo, $_SESSION);
} else if (isset($_GET['id_user']) && intval($_GET['id_user']) !== $_SESSION['id_user']) {
    // See your profile
    $userDatas = fetchUserDatas($dbCo, $_SESSION, $_GET);
    $favourites = fetchUserFavourites($dbCo, $_SESSION);
}
$rpg = fetchRPG($dbCo);
$profilColour = defineProfilColour($userDatas);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?= fetchHead($javascriptLink, $cssLink); ?>
</head>

<body>

    <?= fetchHeader($globalURL, $_SESSION); ?>
    <?= getCustomCursor() ?>

    <main id="higher-main-profile">
        <div class="page-content">
            <div class="container--desktop container--column">

                <section class="user__main-infos">
                    <h1 class="ttl--big user__name" data-aos="fade-down"><?= $userDatas[0]['username'] ?></h1>
                    <img class="avatar user__avatar <?= defineProfilColour($userDatas) ?>" src="<?= $userDatas[0]['avatar'] ?>" alt="Mon image de profil">
                </section>

                <section class="container user__infos" aria-labelledby="my-infos">
                    <div class="user__main-infos">
                        <!-- <button class="button--pen"></button> -->
                        <img class="user__profil-dice" src="<?= $userDatas[0]['icon_URL'] ?>" alt="<?= $userDatas[0]['name_role'] ?>">
                    </div>
                    <div class="user__bio-container">
                        <h3 class="user__bio__ttl">Qui suis-je ?</h3>
                        <p class="user__bio">
                            <?php
                            if ($userDatas[0]['bio'] === NULL) {
                                echo 'Salut ! Je suis ' . $userDatas[0]['username'] . ' !';
                            }

                            echo $userDatas[0]['bio'];
                            ?>
                        </p>
                    </div>
                </section>


                <section class="container user__link-section">
                    <?php
                    echo getSuccessMessage($messages);
                    echo getErrorMessage($errors);
                    ?>
                    <h3 class="ttl ttl--primary ttl--CRUD">Modifier</h3>
                    <div class="container--links">
                        <button class="button--CRUD" id="button-bio">Ma bio</button>
                        <span class="separator--vertical"> | </span>
                        <span class="separator--horizontal">_</span>
                        <button class="button--CRUD" id="button-pwd">Mon Mot de Passe</button>
                        <span class="separator--vertical"> | </span>
                        <span class="separator--horizontal">_</span>
                        <button class="button--CRUD button--CRUD--active" id="button-rpg">Mes Univers Favoris</button>
                    </div>
                </section>

                <?= getBioForm($_SESSION, $userDatas) ?>

                <?= getPasswordForm($_SESSION, $userDatas) ?>

                <?php
                echo
                '<form id="form-rpg" class="container container--profile" action="actions-CRUD.php" method="post" aria-labelledby="my-bio" aria-label="Modifier les informations de mon compte">
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
                        <input type="hidden" name="token" value="' . $_SESSION['token'] . '">
                        <input type="hidden" name="id_user" value="' . $userDatas[0]['id_user'] . '">
                    </ul>
                </form>';

                ?>
                </ul>


                <!-- Template  -->

                <template id="favourite-template">
                    <li class="favourites">
                        <input class="button--minus" type="checkbox" name="universes[]" checked="yes" id="favourite-checkbox" data-favourite-minus="" data-delete-task-id="" value="">
                        <label class="txt--bigger suggestions__txt" id="favourite-rpg">Univers</label>
                    </li>
                </template>

                </form>

            </div>

        </div>

    </main>

    <footer class="footer">
        <?= fetchFooter($globalURL); ?>
    </footer>

    <script>
        AOS.init();
    </script>
    <script type="module" src="js/script.js"></script>
    <script type="module" src="js/suggestion-bar.js"></script>
    <script type="module" src="js/async/CRUD.js"></script>
    <script type="module" src="js/password.js"></script>
    <script type="module" src="js/cursor.js"></script>
</body>

</html>