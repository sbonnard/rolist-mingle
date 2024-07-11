<?php
session_start();

require_once "./includes/_config.php";
require_once "./includes/_database.php";
require_once './includes/_function.php';
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
                        <a href="flow.php" class="nav__lnk" aria-current="page">Accueil <img src="icones/home.svg" alt="icone accueil"></a>
                    </li>
                    <li class="nav__itm">
                        <a href="parties.php" class="nav__lnk" aria-label="Parties de Jeu de Rôle">Parties <img src="icones/parties.svg" alt="icone parties dés de JDR"></a>
                    </li>
                    <li class="nav__itm">
                        <a href="messages.php" class="nav__lnk">Messagerie <img src="icones/messages.svg" alt="icone messagerie"></a>
                    </li>
                    <li class="nav__itm">
                        <a href="larp-agenda.php" class="nav__lnk" aria-label="Agenda des Jeux de Rôle Grandeur Nature">Agenda GNs <img src="icones/agenda.svg" alt="icone agenda"></a>
                    </li>
                    <li class="nav__itm">
                        <a href="my-account.php" class="nav__lnk">Mon compte
                            <picture>
                                <source class="avatar" srcset="img/avatar-m.webp" media="(min-width: 768px)">
                                <img class="nav__avatar" src="img/avatar.webp" alt="icones personnelles">
                            </picture>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main>


        <div class="hero-banner">
            <img class="hero-banner__img" src="logo/logo-rolist-mingle.svg" alt="Logo Rolist-Mingle, dé de Jeu de Rôle">
            <h1 class="logo__ttl">Rolist-Mingle</h1>
            <h2 class="logo__tagline">Don't Roll Single</h2>
            <a href="#content" class="hero-banner__btn">
                <img src="img/angle-down.svg" alt="Bouton vers contenu principal">
            </a>
        </div>

        <div class="page-content" id="content">
            <div class="container--desktop">
                <section class="container grid-counter">
                    <h3 class="ttl ttl--primary">nombre d'inscrits</h3>
                    <p class="users-counter">999999</p>
                    <img class="users-counter__img" src="img/rolist-inn.webp" alt="Personnages d'univers variés buvant un verre dans une taverne médiévale.">

                    <section class="grid-concept" aria-labelledby="concept">
                        <h2 class="ttl ttl--primary">Le concept</h2>
                        <p>Rolist-Mingle a pour vocation d'aider à la rencontre de rôlistes, confirmés ou non. Pour tout
                            ceux qui souhaiteraient jouer plus ou se lancer dans le Jeu de Rôle sur table ou à distance,
                            Rolist-Mingle se veut un lieu d'échanges et de rencontres entre rôlistes avec les mêmes
                            envies. A ton
                            inscription, tu pourras définir ton profil de rôliste symbolisé par différents dés de JDR et
                            retrouver ton ou tes
                            "moitiés" pour jouer plus souvent !</p>
                    </section>
                </section>

                <div class="concept-dice__container grid-dices" aria-label="Présentation des différents profils de rôlistes">
                    <section class="container concept-dice js-concept-dice" data-concept-dice="100" aria-labelledby="dice100" aria-label="Présentation des profils de rôlistes types.">
                        <h4 class="ttl" id="dice100">Dé 100</h4>
                        <img src="icones/dé100.webp" alt="dé 100 de JDR">
                        <p class="concept-dice__txt">Maître du Jeu<br>cherche joueurs</p>
                        <h5 class="ttl concept-dice__sub-ttl">Dominateur</h5>
                    </section>

                    <section class="container concept-dice" data-concept-dice="20" aria-labelledby="dice20" aria-label="Présentation des profils de rôlistes types.">
                        <h4 class="ttl" id="dice20">Dé 20</h4>
                        <img src="icones/dé20.webp" alt="dé 20 de JDR">
                        <p class="concept-dice__txt">Cherche
                            <br>sa moitié
                        </p>
                        <h5 class="ttl concept-dice__sub-ttl">Sérieux</h5>
                    </section>

                    <section class="container concept-dice" data-concept-dice="12" aria-labelledby="dice12" aria-label="Présentation des profils de rôlistes types.">
                        <h4 class="ttl" id="dice12">Dé 12</h4>
                        <img src="icones/dé12.webp" alt="dé 12 de JDR">
                        <p class="concept-dice__txt">Cherche plan
                            <br>JDR régulier
                        </p>
                        <h5 class="ttl concept-dice__sub-ttl">Veut s'amuser</h5>
                    </section>

                    <section class="container concept-dice" data-concept-dice="8" aria-labelledby="dice8" aria-label="Présentation des profils de rôlistes types.">
                        <h4 class="ttl" id="dice8">Dé 8</h4>
                        <img src="icones/dé8.webp" alt="dé 8 de JDR">
                        <p class="concept-dice__txt">Cherche JDR court
                            <br>voire très court</p>
                        <h5 class="ttl concept-dice__sub-ttl">Plus si affinité</h5>
                    </section>

                    <section class="container concept-dice" data-concept-dice="4" aria-labelledby="dice4" aria-label="Présentation des profils de rôlistes types.">
                        <h4 class="ttl" id="dice4">Dé 4</h4>
                        <img src="icones/dé4.webp" alt="dé 4 de JDR">
                        <p class="concept-dice__txt">Juste pour un soir
                            <br>en one-shot
                        </p>
                        <h5 class="ttl concept-dice__sub-ttl">JDR sans lendemain</h5>
                    </section>
                </div>

                <section class="container" aria-labelledby="connexion grid-form">
                    <h2 class="ttl ttl--primary" id="connexion">connexion</h2>
                    <form action="" method="get" aria-label="Formulaire de connexion">
                        <ul class="form__container">
                            <li class="form__itm">
                                <label class="input__label" for="username">Nom d'utilisateur</label>
                                <input class="input" type="text" name="username" id="username" placeholder="Nom d'utilisateur" required aria-label="Entrez votre nom d'utilisateur">
                            </li>
                            <li class="form__itm">
                                <label class="input__label" for="password">Mot de passe</label>
                                <input class="input" type="password" name="password" id="password" placeholder="•••••••••••" required aria-label="Merci d'entrer votre mot de passe">
                            </li>
                        </ul>
                    </form>
                    <div class="form__container">
                        <p class="lnk--underlined"><a href="forgotten-password.php">Mot de passe oublié ?</a></p>
                        <input class="button" type="submit" value="Se connecter">
                        <p>Pas encore de compte ?</p>
                        <div class="button__txt"><a class="button button--empty" href="create-account.php">Créer un compte</a></div>
                    </div>
                </section>
            </div>
        </div>

    </main>
    <footer class="footer">
        <? echo fetchFooter() ?>
    </footer>

    <script type="module" src="js/script.js"></script>
    <script type="module" src="js/index.js"></script>
</body>

</html>