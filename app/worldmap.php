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

    <?= fetchHeader($globalURL, $_SESSION); ?>

    <main class="container">

        <img class="worldmap" src="img/worldmap.webp" alt="Carte du monde du JDR">

    </main>

    <footer class="footer">
        <p>Pas par là !</p>
        <?= fetchFooter($globalURL); ?>
    </footer>

</body>

<script type="module" src="js/dices.js"></script>
<!-- <script type="module" src="js/3d.js"></script> -->

</html>