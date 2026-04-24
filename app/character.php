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
require_once "./includes/classes/_character.php";

generateToken();

if (isset($_SESSION['email'])) {
    $userDatas = fetchUserDatas($dbCo, $_SESSION);
    $profilColour = defineProfilColour($userDatas);
} else {
    redirectTo('index.php');
}
// var_dump($charactersList);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?= fetchHead($javascriptLink, $cssLink); ?>
</head>

<body>
    <?= fetchHeader($globalURL, $_SESSION); ?>
    <?= getCustomCursor() ?>

    <main id="higher-main">
        <?php
        echo getSuccessMessage($messages);
        echo getErrorMessage($errors);
        ?>
        <div class="page-content" id="content">
            <a href="character-form.php" class="button__lnk button__lnk--shivering">Nouveau personnage</a>

            <?= getCharactersSheetsList($charactersDatas) ?>
        </div>

    </main>
    <footer class="footer">
        <?= fetchFooter($globalURL); ?>
    </footer>

    <div class="drawer-overlay" id="drawer-overlay">
        <div class="drawer" id="drawer">
            <div class="drawer-handle"></div>
            <p class="drawer-title" id="drawer-title">Modifier</p>
            <div id="drawer-fields"></div>
            <div class="drawer-actions">
                <button class="btn-cancel" id="drawer-cancel">Annuler</button>
                <button class="btn-confirm" id="drawer-confirm">Valider</button>
            </div>
        </div>
    </div>

    <script>
        AOS.init();
    </script>
    <script type="module" src="js/script.js"></script>
    <script type="module" src="js/index.js"></script>
    <!-- <script type="module" src="js/password.js"></script> -->
    <!-- <script type="module" src="js/cursor.js"></script> -->
    <script type="module" src="js/character.js"></script>
</body>

</html>