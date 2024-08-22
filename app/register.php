<?php
session_start();

require_once "./includes/_config.php";
require_once "./includes/_database.php";
require_once './includes/_function.php';
require_once './includes/_message.php';
require_once './includes/_datas.php';
require_once './includes/_security.php';
require_once "./includes/components/_head.php";
require_once "./includes/components/_footer.php";

generateToken();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
    if ($_ENV['ENV_TYPE'] === 'dev') {
        // Developement integration for vite with run dev
        echo fetchHead('Rolist-Mingle');
    } else if ($_ENV['ENV_TYPE'] === 'prod') {
        // Production integration for vite with run build
        echo loadAssets([$file]);
        // Try this way to load assets from manifest.json
        // https://github.com/andrefelipe/vite-php-setup
    }
    ?>
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
                        <li class="nav__itm nav__lnk--current">
                            <a href="index.php"><img src="icones/home.svg" alt="icone accueil"></a>
                            <a href="index.php" class="nav__lnk" aria-current="page">Accueil</a>
                        </li>
                        <li class="nav__itm">
                            <a href="parties.php"><img src="icones/parties.svg" alt="icone parties dés de JDR"></a>
                            <a href="parties.php" class="nav__lnk" aria-label="Parties de Jeu de Rôle">Parties</a>
                        </li>
                        <?php 
                        if(isset($session['email'])) {
                            echo
                       '<li class="nav__itm">
                            <a href="messages.php"><img src="icones/messages.svg" alt="icone messagerie"></a>
                            <a href="messages.php" class="nav__lnk">Messagerie</a>
                        </li>';
                        }
                        ?>
                        <li class="nav__itm">
                            <a href="larp-agenda.php"><img src="icones/agenda.svg" alt="icone agenda"></a>
                            <a href="larp-agenda.php" class="nav__lnk" aria-label="Agenda des Jeux de Rôle Grandeur Nature">Agenda GNs</a>
                        </li>
                        <?php if(isset($session['email'])) {
                            echo '<li class="nav__itm" data-avatar="">
                            <a href="my-profil-CRUD.php">
                                <picture>
                                    <source class="avatar" srcset="' . $userDatas[0]['avatar'] . '" media="(min-width: 768px)">
                                    <img class="nav__avatar js-avatar-hover" src="' . $userDatas[0]['avatar'] . '" alt="icones personnelles">
                                </picture>
                            </a>
                            <a href="my-profil-CRUD.php" class="nav__lnk js-link-hover">Mon compte</a>
                        </li>
                        <li class="nav__itm">
                            <img src="icones/logout.svg" alt="icône déconnexion">
                            <a class="nav__lnk" href="logout.php">Déconnexion</a>
                        </li>';
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </header>

    <main>
        <a href="index.php" class="hero-banner hero-banner--smaller">
            <img class="hero-banner__img--smaller" src="logo/logo-rolist-mingle.svg" alt="Logo Rolist-Mingle, dé de Jeu de Rôle">
            <h2 class="logo__ttl logo__ttl--smaller">Rolist-Mingle</h1>
        </a>

        <div class="page-content">
        <?php
            echo getSuccessMessage($messages);
            echo getErrorMessage($errors);
            ?>
            <section class="container" aria-labelledby="#create-account">
                <h1 id="create-account" class="ttl ttl--big">Créer ton compte</h1>

                <form method="post" action="actions.php" aria-label="Formulaire de création de compte" id="register-form">
                    <ul class="form__container">
                        <li class="form__itm">
                            <label class="input__label" for="username">Nom d'utilisateur <span class="input__required" aria-hidden="true">*</span></label>
                            <input class="input" type="text" name="username" id="username" placeholder="Nom d'utilisateur" autocomplete="username" required>
                        </li>
                        <li class="form__itm">
                            <label class="input__label" for="email">Ton Email <span class="input__required" aria-hidden="true">*</span></label>
                            <input class="input" type="email" name="email" id="email" placeholder="exemple@email.com" aria-label="Renseigne l'email lié à ton compte" autocomplete="email" required>
                        </li>
                        <!-- <li class="form__itm">
                            <label class="input__label" for="locality">Localité</label>
                            <input class="input" type="text" name="locality" id="locality" placeholder="CAEN" autocapitalize="" autocomplete="address-level2">
                        </li> -->
                        <li class="form__itm">
                            <label class="input__label" for="password">Mot de passe <span class="input__required" aria-hidden="true">*</span></label>
                            <div class="input--password">
                                <input class="input" type="password" name="password" id="password" placeholder="•••••••••••" required aria-label="Merci d'entrer votre mot de passe">
                                <button class="button--eye button--eye--inactive" id="eye-button" aria-label="Montrer le mot de passe en clair dans le champs de saisie"></button>
                            </div>
                        </li>
                        <li class="form__itm">
                            <label class="input__label" for="check-password">Entrez de nouveau le mot de passe <span class="input__required" aria-hidden="true">*</span></label>
                            <div class="input--password">
                                <input class="input" type="password" name="check-password" id="check-password" placeholder="•••••••••••" required aria-label="Merci d'entrer votre mot de passe pour vérification.">
                                <button class="button--eye button--eye--inactive" id="eye-button" aria-label="Montrer le mot de passe en clair dans le champs de saisie"></button>
                            </div>
                        </li>
                        <li class="form__question">
                            <p class="form__question" for="ideal">Déterminons ensemble ton profil de rôliste <span class="input__required" aria-hidden="true">*</span> :</p>
                            <p class="form__itm">
                            <div class="form__itm--box">
                                <input class="form__radio" type="radio" id="choice1" name="player-type" value="1">
                                <label for="choice1">Moi, MJ, dominant mes joueurs par ma toute puissance
                                    sadique!</label>
                            </div>
                            <div class="form__itm--box">
                                <input class="form__radio" type="radio" id="choice2" name="player-type" value="2">
                                <label for="choice2">Recherche une relation de jeu durable pour une histoire sans
                                    fin.</label>
                            </div>
                            <div class="form__itm--box">
                                <input class="form__radio" type="radio" id="choice4" name="player-type" value="3">
                                <label for="choice4">Plan jeu régulier, pour s’amuser quelques soirées ensemble.</label>
                            </div>
                            <div class="form__itm--box">
                                <input class="form__radio" type="radio" id="choice5" name="player-type" value="4">
                                <label for="choice5">
                                    Une histoire de JDR courte, deux ou trois soirs, plus si affinité.
                                </label>
                            </div>
                            <div class="form__itm--box">
                                <input class="form__radio" type="radio" id="choice3" name="player-type" value="5">
                                <label for="choice3">
                                    JDR sans lendemain, une partie “quickie”. Je joue le premier soir.
                                </label>
                            </div>
                            </p>
                        </li>

                        <li class="form__itm form__itm--select">
                            <label class="input__label form__question" for="suggestionsField">
                                Quels sont tes univers de jeu préférés ?
                            </label>
                            <input class="input suggestions__input" type="text" id="suggestionsField" name="suggestionsField" placeholder="Tapez quelque chose..." aria-label="Entre le nom de ton JDR préféré et appuie sur 'entrée' pour valider ton choix">
                            <div class="suggestions__list">
                                <div class="suggestions" id="suggestions"></div>
                            </div>
                            <ul id="selectedItemsList"></ul>
                        </li>

                        <p class="input__required--txt" aria-hidden="true">Les champs marqués d’une <span class="input__required">*</span> sont obligatoires.
                        </p>
                        <input class="button" id="create-account-btn" type="submit" value="Créer mon Compte">
                        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                        <input type="hidden" name="action" value="create_account">
                    </ul>

                    <template id="favourite-template">
                        <li class="favourites">
                            <input class="button--minus" type="checkbox" name="universes[]" checked="yes" id="favourite-checkbox" data-favourite-minus="" value="">
                            <label class="txt--bigger suggestions__txt" id="favourite-rpg">Univers</label>
                        </li>
                    </template>

                </form>
            </section>
        </div>

    </main>

    <footer class="footer">
        <?= fetchFooter() ?>
    </footer>
    <script type="module" src="js/script.js"></script>
    <script type="module" src="js/suggestion-bar.js"></script>
    <script type="module" src="js/register.js"></script>
    <script type="module" src="js/password.js"></script>
</body>