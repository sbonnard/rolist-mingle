<?php
require "./includes/_config.php";
require "./includes/_database.php";
require "./includes/components/_head.php";
require "./includes/components/_footer.php";

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