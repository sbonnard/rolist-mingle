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

generateToken();

isLocked();

if (isset($_SESSION['email'])) {
    $userDatas = fetchUserDatas($dbCo, $_SESSION);
    $profilColour = defineProfilColour($userDatas);
}
?>

<!DOCTYPE php>
<php lang="fr">

    <head>
        <?= fetchHead($javascriptLink, $cssLink); ?>
    </head>

    <body>
        <?= fetchHeader($globalURL, $_SESSION); ?>
        <?= getCustomCursor() ?>

        <main>
            <!-- THINK TO REMOVE CONNECTION BAR IF USER IS CONNECTER -->
            <div class="page-content">
                <div class="connection-bar">
                    <p>Connecte-toi !</p>
                    <a href="index.php"><button class="button connection-bar__button">Se connecter</button></a>
                </div>

                <h1 class="ttl ttl--big">Parties disponibles</h1>

                <div class="container">
                    <button class="filter txt--bigger txt--primary">Filtrer par préférences</button>
                </div>

                <div class="container">
                    <button class="button"><a href="create-account.php">Créer une partie</a></button>
                </div>
                <div class="swiper" id="swiper">
                    <?php
                    $parties = getPartyDatas($dbCo);
                    echo displayParties($parties);
                    ?>
                </div>
            </div>
        </main>

        <footer class="footer">
            <?= fetchFooter($globalURL); ?>
        </footer>

        <template>
            <section class="container container--swiper">
                <div class="user">
                    <picture>
                        <source class="avatar" srcset="img/avatar-slike-m.webp" media="(min-width: 768px)">
                        <img class="avatar" src="img/avatar-slike.webp" alt="Avatar de Slike">
                    </picture>
                    <h3 class="ttl--big">Slike</h3>
                    <img class="rolist-icon" src="icones/dice20-50x50.svg" alt="Icône dé 20 'Sérieux'">
                </div>
                <div class="party">
                    <a href="party-1.php">
                        <h2 class="ttl--big">JDR DnD à Vesoul</h2>
                    </a>
                    <a href="party-1.php"><img src="icones/dice20-50x50.svg" alt="Icône dé 20 'Sérieux'"></a>
                </div>
                <a href="party-1.php"><img class="party__img" src="img/party1.webp" alt="Image médiévale avec château"></a>
            </section>
        </template>

        <script>
            AOS.init();
        </script>
        <script type="module" src="js/script.js"></script>
        <script type="module" src="js/cursor.js"></script>
    </body>