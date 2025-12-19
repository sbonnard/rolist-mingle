<?php
session_start();

require_once "./includes/_config.php";
require_once "./includes/_database.php";
require_once './includes/_function.php';
require_once './includes/_message.php';
require_once './includes/_security.php';
require_once './includes/_datas.php';
require_once './includes/_profilCRUD-functions.php';
require_once "./includes/components/_head.php";
require_once "./includes/components/_header.php";
require_once "./includes/components/_footer.php";
require_once './includes/components/_dice.php';

generateToken();

if (isset($_SESSION['email'])) {
    $userDatas = fetchUserDatas($dbCo, $_SESSION);
    $profilColour = defineProfilColour($userDatas);
}

// var_dump($_SESSION);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Don't Roll Single</title>
    <link rel="stylesheet" href="scss/style.scss">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"> -->
    <!-- if development -->
    <!-- <script type="module" src="http://localhost:5173/@vite/client"></script>
    <script type="module" src="http://localhost:5173/js/script.js"></script> -->

    <!-- Production -->
    <!-- <link rel="stylesheet" href="assets/assets/script-BzxqH_86.css">
    <script type="module" src="assets/assets/script-CtvaXMUD.js"></script> -->

    <!-- RPG DICES 3D -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r136/three.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cannon-es/0.20.0/cannon-es.min.js"></script>
    <script src="rollingTheDices.js"></script>-->
<?= fetchHead($javascriptLink, $cssLink); ?>
</head>

<body>

    <?= fetchHeader($_SESSION); ?>
    <?= getCustomCursor() ?>

    <main class="container--dice container--dice--grid">
        <?php // if (isset($_SESSION['id_character'])) {
           // echo renderCharacterSelect($charactersDatas, $_SESSION['token']);
       // } ?>
            <!-- Character sheet will be displayed like a burger menu I think -->
           <?= '';//    getCharacterSheet($_SESSION, $charactersDatas, true); // ?>
   
           <section class="dice__section" aria-labelledby="ttlbody">
               <div class="dice__banner" data-banner="body" id="bannerbody">Aïe</div>
               <h2 class="ttl dice__word" id="ttlbody">Dé <span class="number">Ciblage</span></h2>
               <button id="bodyDice">
                   <img class="dice--body" src="img/body.png" alt="Dé corps de JDR">
               </button>
           </section>
   
           <?= getDice(100); ?>
           <?= getDice(20); ?>
           <?= getDice(12); ?>
           <?= getDice(10); ?>
           <?= getDice(8); ?>
           <?= getDice(6); ?>
           <?= getDice(4); ?>

    </main>

    <footer class="footer">
        <p>Pas par là !</p>
        <?=  fetchFooter(); ?>
    </footer>

</body>

<script type="module" src="js/script.js"></script>
<script type="module" src="js/index.js"></script>
<script type="module" src="js/dices.js"></script>
<script type="module" src="js/cursor.js"></script>
<script type="module" src="js/selectCharacter.js"></script>
<!-- <script type="module" src="js/3d.js"></script> -->

</html>