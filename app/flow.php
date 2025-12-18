<?php
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

checkConnection($_SESSION);

if (isset($_SESSION['email'])) {
    $userDatas = fetchUserDatas($dbCo, $_SESSION);
    $profilColour = defineProfilColour($userDatas);
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?= fetchHead($javascriptLink, $cssLink); ?>
</head>



<body>
    <?= fetchHeader($_SESSION); ?>
    <?= getCustomCursor() ?>

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
    
    <script type="module" src="js/script.js"></script>
    <script type="module" src="js/index.js"></script>
    <script type="module" src="js/password.js"></script>
    <script type="module" src="js/cursor.js"></script>
</body>