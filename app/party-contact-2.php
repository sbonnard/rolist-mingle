<?php
require "./includes/_config.php";
require "./includes/_database.php";
include 'includes/_function.php';
require "./includes/components/_head.php";
require "./includes/components/_footer.php";

checkConnection($_SESSION);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
<? echo fetchHead("Parties | Rolist-Mingle");?>
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
        <div class="page-content content-position">

            <section class="container party__page-content">
                <h1 class="ttl ttl--big">JDR DnD</h1>
                <h2 class="txt--bigger ttl--primary">Donjons & Dragons</h2>
                <p>à Vesoul (70)</p>
                <p>4 joueurs</p>
                <p>Le Maître du Jeu sera @Slike</p>
                <img src="icones/dice100-50x50.svg" alt="Dé 100 'Maître du Jeu'">
                <p>Ta demande pour rejoindre la partie a été envoyée à @Slike ! Attend sa validation.</p>

                <button class="button"><a href="flow.php">Retourner à l'accueil</a></button>
            </section>

        </div>
    </main>

    <footer class="footer">
        <? echo fetchFooter() ?>
    </footer>

    <script src="js/script.js"></script>
</body>