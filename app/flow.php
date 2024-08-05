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
    <? echo fetchHead("Flux | Rolist-Mingle"); ?>
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
                        <a href="flow.php" class="nav__lnk" aria-current="page">Accueil</a>
                        <a href="flow.php"><img src="icones/home.svg" alt="icone accueil"></a>
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
        <aside class="container friend-suggestion">
            <h3 class="ttl--small">Les Rôlistes les plus chauds de<br> ta région !</h2>
                <div class="friend-suggestion__users">
                    <div class="friend-suggestion__rolist">
                        <img class="avatar" src="img/avatar-bergueau.webp" alt="avatar de Bergueau">
                        <h4 class="txt--small">Bergueau</h4>
                        <img class="rolist-icon" src="icones/dé20.webp" alt="Icône dé 20 'Sérieux'">
                    </div>
                    <div class="friend-suggestion__rolist">
                        <img class="avatar" src="img/avatar-canas.webp" alt="avatar de Canas">
                        <h4 class="txt--small">Canas</h4>
                        <img class="rolist-icon" src="icones/dé12.webp" alt="Icône dé 20 'Sérieux'">
                    </div>
                </div>
        </aside>
        
    </main>
    
            <footer class="footer">
                <? echo fetchFooter() ?>
            </footer>
</body>