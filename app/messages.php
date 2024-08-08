<?php
session_start();

require_once "./includes/_config.php";
require_once "./includes/_database.php";
require_once './includes/_function.php';
require_once './includes/_message.php';
require_once './includes/_security.php';
require_once "./includes/components/_head.php";
require_once "./includes/components/_footer.php";
require_once './includes/_profilCRUD-functions.php';


checkConnection($_SESSION);

$userDatas = fetchUserDatas($dbCo, $_SESSION);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <? echo fetchHead("Messages Privés | Rolist-Mingle"); ?>
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
                    <li class="nav__itm">
                        <a href="parties.php" class="nav__lnk" aria-label="Parties de Jeu de Rôle">Parties</a>
                        <a href="parties.php"><img src="icones/parties.svg" alt="icone parties dés de JDR"></a>
                    </li>
                    <li class="nav__itm nav__lnk--current">
                        <a href="messages.php" class="nav__lnk" aria-current="page">Messagerie</a>
                        <a href="messages.php"><img src="icones/messages.svg" alt="icone messagerie"></a>
                    </li>
                    <li class="nav__itm">
                        <a href="larp-agenda.php" class="nav__lnk" aria-label="Agenda des Jeux de Rôle Grandeur Nature">Agenda GNs</a>
                        <a href="larp-agenda.php"><img src="icones/agenda.svg" alt="icone agenda"></a>
                    </li>
                    <li class="nav__itm" data-avatar="">
                        <a href="my-profil-CRUD.php" class="nav__lnk js-link-hover">Mon compte</a>
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

    </main>

    <footer class="footer">
        <? echo fetchFooter() ?>
    </footer>

</body>