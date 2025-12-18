<?php
require_once "./includes/_config.php";
require_once "./includes/_database.php";
require_once './includes/_function.php';
require_once './includes/_message.php';
require_once './includes/_security.php';
require_once "./includes/components/_head.php";
require_once "./includes/components/_header.php";
require_once "./includes/components/_footer.php";

isLocked();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?= fetchHead($javascriptLink, $cssLink); ?>    
</head>

<body>

    <header class="header bg-blur">

        <a href="index.php">
            <h1 class="ttl ttl--main">Don't Roll Single</h1>
        </a>
        <div class="hamburger">
            <a href="#menu" id="hamburger-menu-icon">
                <img src="img/hamburger.svg" alt="Menu Hamburger">
            </a>
        </div>
        <nav class="nav hamburger__menu" id="menu" aria-label="Navigation principale du site">
            <ul class="nav" id="nav-list">
                <li class="nav__itm">
                    <a href="index.php" class="nav__lnk">Accueil</a>
                </li>
                <li class="nav__itm">
                    <a href="worldmap.php" class="nav__lnk">Carte du Monde</a>
                </li>
            </ul>
        </nav>
    </header>

    <main class="container">

        <img class="worldmap" src="img/worldmap.webp" alt="Carte du monde du JDR">

    </main>

    <footer class="footer">
        <p>Pas par là !</p>
    </footer>

</body>

<script type="module" src="js/dices.js"></script>
<!-- <script type="module" src="js/3d.js"></script> -->

</html>