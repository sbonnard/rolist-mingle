<?php
session_start();

require_once "./includes/_config.php";
require_once "./includes/_database.php";
require_once './includes/_function.php';
require_once './includes/_message.php';
require_once './includes/_security.php';
require_once "./includes/components/_head.php";
require_once "./includes/components/_header.php";
require_once "./includes/components/_footer.php";
require_once './includes/_profilCRUD-functions.php';

isLocked();

if (isset($_SESSION['email'])) {
    $userDatas = fetchUserDatas($dbCo, $_SESSION);
    $profilColour = defineProfilColour($userDatas);
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <? echo fetchHead($javascriptLink, $cssLink); ?>
</head>

<body>
    <?= fetchHeader($globalURL, $_SESSION); ?>
    <?= getCustomCursor() ?>

    <main>
        <!-- THINK TO REMOVE CONNECTION BAR IF USER IS CONNECTER -->
        <div class="connection-bar">
            <p>Connecte-toi !</p>
            <a href="index.php"><button class="button connection-bar__button">Se connecter</button></a>
        </div>
        <div class="page-content">

            <h1 class="ttl ttl--big">Agenda GN</h1>

            <div class="container">
                <button class="filter txt--bigger txt--primary">Filtrer par préférences</button>
            </div>

            <ul class="larp">
                <?php
                echo getLarpDatasAsHTMLList($dbCo);
                ?>
            </ul>


        </div>
    </main>

    <footer class="footer">
        <?= fetchFooter($globalURL); ?>
    </footer>

    <script>
        AOS.init();
    </script>
    <script type="module" src="js/script.js"></script>
    <script type="module" src="js/index.js"></script>
    <script type="module" src="js/password.js"></script>
    <script type="module" src="js/cursor.js"></script>
</body>