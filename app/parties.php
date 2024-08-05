<?php
session_start();

require_once "./includes/_config.php";
require_once "./includes/_database.php";
require_once './includes/_function.php';
require_once './includes/_message.php';
require_once './includes/_security.php';
require_once "./includes/components/_head.php";
require_once "./includes/components/_footer.php";

generateToken();

?>

<!DOCTYPE php>
<php lang="fr">

    <head>
        <? echo fetchHead("Parties | Rolist-Mingle"); ?>
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
                        <a href="flow.php" class="nav__lnk">Accueil</a>
                        <a href="flow.php"><img src="icones/home.svg" alt="icone accueil"></a>
                    </li>
                    <li class="nav__itm nav__lnk--current">
                        <a href="parties.php" class="nav__lnk" aria-label="Parties de Jeu de Rôle" aria-current="page">Parties</a>
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
                    <li class="nav__itm" data-avatar="">
                        <a href="my-account.php" class="nav__lnk js-link-hover">Mon compte</a>
                        <a href="my-account.php">
                            <picture>
                                <source class="avatar" srcset="img/avatar-m.webp" media="(min-width: 768px)">
                                <img class="nav__avatar js-avatar-hover" src="img/avatar.webp" alt="icones personnelles">
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
            <!-- THINK TO REMOVE CONNECTION BAR IF USER IS CONNECTER -->
            <div class="page-content">
                <div class="connection-bar">
                    <p>Connecte-toi !</p>
                    <a href="index.php"><button class="button connection-bar__button">Se connecter</button></a>
                </div>

                <h1 class="ttl ttl--big">Parties disponibles</h1>

                <div class="container">
                    <button class="filter txt--bigger txt--primary">Filtrer par préférences</button>
                </div>

                <div class="container">
                    <button class="button"><a href="create-account.php">Créer une partie</a></button>
                </div>
                <div class="swiper" id="swiper">
                    <?php
                    $parties = getPartyDatas($dbCo);
                    echo displayParties($parties);
                    ?>
                </div>
            </div>
        </main>

        <footer class="footer">
            <? echo fetchFooter() ?>
        </footer>

        <template>
            <section class="container container--swiper">
                <div class="user">
                    <picture>
                        <source class="avatar" srcset="img/avatar-slike-m.webp" media="(min-width: 768px)">
                        <img class="avatar" src="img/avatar-slike.webp" alt="Avatar de Slike">
                    </picture>
                    <h3 class="ttl--big">Slike</h3>
                    <img class="rolist-icon" src="icones/dice20-50x50.svg" alt="Icône dé 20 'Sérieux'">
                </div>
                <div class="party">
                    <a href="party-1.php">
                        <h2 class="ttl--big">JDR DnD à Vesoul</h2>
                    </a>
                    <a href="party-1.php"><img src="icones/dice20-50x50.svg" alt="Icône dé 20 'Sérieux'"></a>
                </div>
                <a href="party-1.php"><img class="party__img" src="img/party1.webp" alt="Image médiévale avec château"></a>
            </section>
        </template>

        <script type="module" src="js/script.js"></script>
    </body>