<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JDR Fratrie</title>
    <link rel="stylesheet" href="scss/style.scss">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <!-- if development -->
    <!-- <script type="module" src="http://localhost:5173/@vite/client"></script>
    <script type="module" src="http://localhost:5173/js/script.js"></script> -->

    <!-- Production -->
    <link rel="stylesheet" href="assets/assets/script-BW4HPhpW.css">
    <script type="module" src="assets/assets/script-pK4JEM7c.js"></script>

    <!-- RPG DICES 3D -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r136/three.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cannon-es/0.20.0/cannon-es.min.js"></script>
    <script src="rollingTheDices.js"></script>

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