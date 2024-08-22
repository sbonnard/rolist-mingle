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

if (isset($_SESSION['email'])) {
    $userDatas = fetchUserDatas($dbCo, $_SESSION);
    $profilColour = defineProfilColour($userDatas);
}
?>

<!DOCTYPE html>
<html lang="fr">

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
                        <a href="index.php"><img src="icones/home.svg" alt="icone accueil"></a>
                        <a href="index.php" class="nav__lnk">Accueil</a>
                    </li>
                    <li class="nav__itm nav__lnk--current">
                        <a href="parties.php"><img src="icones/parties.svg" alt="icone parties dés de JDR"></a>
                        <a href="parties.php" class="nav__lnk" aria-label="Parties de Jeu de Rôle" aria-current="page">Parties</a>
                    </li>
                    <?php if (isset($_SESSION['email'])) {
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
                    <?php if (isset($_SESSION['email'])) {
                        echo '<li class="nav__itm" data-avatar="">
                            <a href="my-profil-CRUD.php">
                                <picture>
                                    <source class="avatar" srcset="' . $userDatas[0]['avatar'] . '" media="(min-width: 768px)">
                                    <img class="nav__avatar js-avatar-hover  '. $profilColour .'" src="' . $userDatas[0]['avatar'] . '" alt="icones personnelles">
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
        <div class="page-content content-position">

            <section class="container party__page-content">
                <h1 class="ttl ttl--big">JDR DnD</h1>
                <h2 class="txt--bigger ttl--primary">Donjons & Dragons</h2>
                <p>à Vesoul (70)</p>
                <p>4 joueurs</p>
                <p>Le Maître du Jeu sera @Slike</p>
                <img src="icones/dice100-50x50.svg" alt="Dé 100 'Maître du Jeu'">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus dignissim tortor risus, at suscipit
                    nulla suscipit vulputate. Phasellus at felis pharetra, dapibus nisi id, imperdiet nulla. Proin
                    viverra
                    nisl vel finibus rhoncus. Mauris quis lacus sit amet magna cursus sollicitudin non a erat. Proin
                    sodales
                    elit risus, a vehicula urna elementum in. Maecenas imperdiet, nulla at blandit luctus, ex ex aliquet
                    ante, aliquet mollis quam odio non odio. Integer ex erat, posuere ac purus vitae, elementum iaculis
                    ipsum.</p>

                <button class="button"><a href="party-contact.php">Demander à rejoindre</a></button>
            </section>

        </div>
    </main>

    <footer class="footer">
        <? echo fetchFooter() ?>
    </footer>

    <script src="js/script.js"></script>
</body>