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
    <?php
    if ($_ENV['ENV_TYPE'] === 'dev') {
        // Developement integration for vite with run dev
        echo fetchHead('Rolist-Mingle');
    } else if ($_ENV['ENV_TYPE'] === 'prod') {
        // Production integration for vite with run build
        echo loadAssets([$file]);
        // Try this way to load assets from manifest.json
        // https://github.com/andrefelipe/vite-php-setup
    }
    ?>
</head>

<body>

    <?= fetchHeader($_SESSION); ?>
    <?= getCustomCursor() ?>

    <main class="container--dice container--dice--grid">

        <section class="character-sheet" id="character-sheet">
            <button class="button--character"><img class="button--character-icon" src="img/character-icon.svg" alt="Icône de personnage"></button>
            <button class="button--dice"><img class="button--dice-icon" src="img/dice-icon.svg" alt="Icône de dés"></button>
            <form class="form" action="actions.php">
                <li class="form__itm form__itm--select">
                    <label class="input__label" for="selectCharacter">Sélectionne un personnage</label>
                    <select class="input__select" name="selectCharacter" id="selectCharacter">
                        <option value="Seon">Seon</option>
                    </select>
                </li>
                <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
                <!-- <button type="submit" class="button bg-blur"></button> -->
            </form>
            <img class="character-sheet__img" src="img/avatar-seon.svg" alt="Fiche de personnage">
            <h2 class="character-sheet__name">Seon</h2>
            <section class="character-sheet__stats">
                <div id="health-bar">
                    <h3>Points de vie</h3>
                    <div class="character-sheet__stats__points">
                        <p class="character-sheet__stats--pv">100</p>
                        <p>/</p>
                        <p>100</p>
                    </div>
                    <!-- <div class="character-sheet__bar character-sheet__health">
                       <p class="character-sheet__number">100</p>
                   </div> -->
                </div>
                <div id="mana-bar">
                    <h3>Points de mana</h3>
                    <div class="character-sheet__stats__points">
                        <p class="character-sheet__stats--mana">100</p>
                        <p>/</p>
                        <p>100</p>
                    </div>
                    <!-- <div class="character-sheet__bar character-sheet__mana">
                       <p class="character-sheet__number">100</p>
                   </div> -->
                </div>
            </section>
            <div class="bg-blur character-sheet__wallet-container">
                <h3 class="ttl ttl--small">Bourse</h3>
                <section class="character-sheet__wallet">
                    <div class="character-sheet__coins">
                        <img class="coin" src="img/gold.png" alt="Icône de pièce d\'or">
                        <p class="character-sheet__coins--amount">' . $character['gold'] . '</p>
                    </div>
                    <div class="character-sheet__coins">
                        <img class="coin" src="img/silver.png" alt="Icône de pièce d\'argent">
                        <p class="character-sheet__coins--amount">' . $character['silver'] . '</p>
                    </div>
                    <div class="character-sheet__coins">
                        <img class="coin" src="img/copper.png" alt="Icône de pièce de cuivre">
                        <p class="character-sheet__coins--amount">' . $character['copper'] . '</p>
                    </div>
                </section>
            </div>
        </section>

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
    </footer>

</body>

<script type="module" src="js/script.js"></script>
<script type="module" src="js/index.js"></script>
<script type="module" src="js/dices.js"></script>
<script type="module" src="js/cursor.js"></script>
<!-- <script type="module" src="js/3d.js"></script> -->

</html>