<?php
session_start();

require_once "./includes/_config.php";
require_once "./includes/_database.php";
require_once './includes/_function.php';
require_once './includes/_profilCRUD-functions.php';
require_once './includes/_message.php';
require_once './includes/_security.php';
require_once "./includes/components/_head.php";
require_once "./includes/components/_footer.php";

checkConnection($_SESSION);

// var_dump($_SESSION['email']);

generateToken();
$userDatas = fetchUserDatas($dbCo, $_SESSION);
$favourites = fetchUserFavourites($dbCo , $_SESSION);
$rpg = fetchRPG($dbCo);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <? echo fetchHead("Compte Rôliste | Rolist-Mingle"); ?>
</head>

<body>
<header class="header">
        <div class="container__header">
            <img class="header__img" src="logo/logo-rolist-mingle.svg" alt="logo de rolist-mingle représentant un dé 20 de JDR">
            <a href="#">
                <h2 class="header__ttl">Rolist-Mingle</h2>
            </a>
            <div class="hamburger">
                <a href="#menu" id="hamburger-menu-icon">
                    <img src="img/hamburger.svg" alt="Menu Hamburger">
                </a>
            </div>
            <nav class="nav hamburger__menu" id="menu" aria-label="Navigation principale du site">
                <ul class="nav__lst" id="nav-list">
                    <li class="nav__itm">
                        <a href="index.php" class="nav__lnk">Accueil</a>
                        <a href="index.php"><img src="icones/home.svg" alt="icone accueil"></a>
                    </li>
                    <li class="nav__itm">
                        <a href="parties.php" class="nav__lnk" aria-label="Parties de Jeu de Rôle">Parties</a>
                        <a href="parties.php"><img src="icones/parties.svg" alt="icone parties dés de JDR"></a>
                    </li>
                    <li class="nav__itm">
                        <a href="messages.php" class="nav__lnk">Messagerie</a>
                        <a href="messages.php"><img src="icones/messages.svg" alt="icone messagerie"></a>
                    </li>
                    <li class="nav__itm">
                        <a href="larp-agenda.php" class="nav__lnk" aria-label="Agenda des Jeux de Rôle Grandeur Nature">Agenda GNs</a>
                        <a href="larp-agenda.php"><img src="icones/agenda.svg" alt="icone agenda"></a>
                    </li>
                    <li class="nav__itm nav__lnk--current" data-avatar="">
                        <a href="my-profil-CRUD.php" class="nav__lnk js-link-hover" aria-current="page">Mon compte</a>
                        <a href="my-profil-CRUD.php">
                            <picture>
                                <source class="avatar" srcset="<?= $userDatas[0]['avatar'] ?>" media="(min-width: 768px)">
                                <img class="nav__avatar js-avatar-hover" src="<?= $userDatas[0]['avatar'] ?>" alt="icones personnelles">
                            </picture>
                        </a>
                    </li>
                    <li class="nav__itm">
                        <a class="nav__lnk" href="logout.php">Déconnexion</a>
                        <img src="icones/logout.svg" alt="icône déconexion">
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="page-content">
            <div class="container--desktop container--column">

                <section class="container user__infos" aria-labelledby="my-infos">
                    <h1 id="my-infos" class="ttl ttl--big">Mon Profil</h1>
                    <img class="avatar user__avatar <?= defineProfilColour($userDatas) ?>" src="<?= $userDatas[0]['avatar'] ?>" alt="Mon image de profil">
                    <h2 class="ttl--big user__name"> <?= $userDatas[0]['username'] ?></h2>
                    <!-- <button class="button--pen"></button> -->
                    <p>Email : <?= $userDatas[0]['email'] ?> </p>
                    <img class="user__profil-dice" src="<?= $userDatas[0]['icon_URL'] ?>" alt="<?= $userDatas[0]['name_role'] ?>">
                    <div class="user__bio-container">
                        <h3 class="ttl ttl--no-padding-top ttl--primary">Bio</h3>
                        <p class="user__bio">
                            <?php
                            if($userDatas[0]['bio'] === NULL) {
                                echo 'Salut ! Je suis ' . $userDatas[0]['username'] . ' !';
                            }

                            echo $userDatas[0]['bio'];
                            ?>
                        </p>
                    </div>
                </section>


                <section class="container">
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

                <?php
                echo
                '<form id="form-bio" class="container hidden" action="actions-CRUD.php" method="post" aria-labelledby="my-bio" aria-label="Modifier les informations de mon compte">
                    <h3 id="my-bio" class="ttl--big">Ma bio</h3>
                    <ul class="form__container">
                        <li class="form__itm">
                            <textarea class="input input__text-area" name="bio" id="bio" placeholder="Ma petite vie...">' . $userDatas[0]['bio'] . '</textarea>
                        </li>
                        <input class="button" type="submit" value="Enregistrer">
                        <input type="hidden" name="action" value="modify-bio">
                        <input type="hidden" name="token" value="' . $_SESSION['token'] . '">
                    </ul>
                </form>'
                ?>


                <form id="form-pwd" class="container hidden" action="actions-CRUD.php" method="post" aria-labelledby="my-bio" aria-label="Modifier les informations de mon compte">
                    <ul class="form__container">
                        <li class="form__itm">
                            <label for="password" class="input__label">Changer le mot de passe</label>
                            <div class="input--password">
                                <input class="input" type="password" name="password" id="password" placeholder="•••••••••••" required aria-label="Merci d'entrer votre mot de passe">
                                <button class="button--eye button--eye--inactive" id="eye-button" aria-label="Montrer le mot de passe en clair dans le champs de saisie"></button>
                            </div>
                        </li>
                        <input class="button" type="submit" value="Enregistrer">
                        <input type="hidden" name="action" value="modify-pwd">
                        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">

                    </ul>
                </form>

                <?php
                echo
                '<form id="form-rpg" class="container" action="actions-CRUD.php" method="post" aria-labelledby="my-bio" aria-label="Modifier les informations de mon compte">
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
        <? echo fetchFooter() ?>
    </footer>

    <script type="module" src="js/script.js"></script>
    <script type="module" src="js/suggestion-bar.js"></script>
    <script type="module" src="js/async/CRUD.js"></script>
    <script type="module" src="js/password.js"></script>
</body>

</html>