<?php
session_start();

require_once "./includes/_config.php";
require_once "./includes/_database.php";
require_once './includes/_function.php';
require_once './includes/_profilCRUD.php';
require_once './includes/_message.php';
require_once "./includes/components/_head.php";
require_once "./includes/components/_footer.php";

generateToken();
// var_dump(fetchUser8Datas($dbCo));
$userDatas = fetchUser8Datas($dbCo);
$favourites = fetchUser8Favourites($dbCo);
$rpg = fetchRPG($dbCo);
// var_dump($userDatas);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <? echo fetchHead("Mon compte | Rolist-Mingle"); ?>
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
                        <a href="#" class="nav__lnk">Accueil <img src="icones/home.svg" alt="icone accueil"></a>
                    </li>
                    <li class="nav__itm">
                        <a href="#" class="nav__lnk" aria-label="Parties de Jeu de Rôle">Parties <img src="icones/parties.svg" alt="icone parties dés de JDR"></a>
                    </li>
                    <li class="nav__itm">
                        <a href="#" class="nav__lnk">Messagerie <img src="icones/messages.svg" alt="icone messagerie"></a>
                    </li>
                    <li class="nav__itm">
                        <a href="#" class="nav__lnk" aria-label="Agenda des Jeux de Rôle Grandeur Nature">Agenda GNs <img src="icones/agenda.svg" alt="icone agenda"></a>
                    </li>
                    <li class="nav__itm" data-avatar="">
                        <a href="#" class="nav__lnk js-link-hover">Mon compte
                            <picture>
                                <source class="avatar" srcset="img/avatar-m.webp" media="(min-width: 768px)">
                                <img class="nav__avatar js-avatar-hover" src="img/avatar.webp" alt="icones personnelles">
                            </picture>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="page-content">
            <div class="container--desktop container--column">

                <section class="container my-infos" aria-labelledby="my-infos">
                    <h1 id="my-infos" class="ttl ttl--big">Mon Profil</h1>
                    <img class="avatar user__avatar avatar--dice12" src="<?= $userDatas[0]['avatar'] ?>" alt="Mon image de profil">
                    <h2 class="ttl--big user__name"> <?= $userDatas[0]['username'] ?></h2>
                    <!-- <button class="button--pen"></button> -->
                    <p>Email : <?= $userDatas[0]['email'] ?> </p>
                    <img class="user__profil-dice" src="<?= $userDatas[0]['icon_URL'] ?>" alt="Icône rôliste Dé 100 'Dominateur' Maître du Jeu">
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
                    </ul>
                </form>'
                ?>


                <form id="form-pwd" class="container hidden" action="actions-CRUD.php" method="post" aria-labelledby="my-bio" aria-label="Modifier les informations de mon compte">
                    <ul class="form__container">
                        <li class="form__itm">
                            <label for="password" class="input__label">Changer le mot de passe</label>
                            <input type="password" class="input" name="password" placeholder="•••••••••••">
                        </li>
                        <input class="button" type="submit" value="Enregistrer">
                        <input type="hidden" name="action" value="modify-pwd">
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

        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
    </main>

    <footer class="footer">
        <? echo fetchFooter() ?>
    </footer>

    <script type="module" src="js/script.js"></script>
    <script type="module" src="js/suggestion-bar.js"></script>
    <script type="module" src="js/async/CRUD.js"></script>
</body>

</html>