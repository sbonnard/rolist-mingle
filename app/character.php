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

?>

<!DOCTYPE html>
<html lang="fr">

<head>
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

    <main>
        <?php
        echo getSuccessMessage($messages);
        echo getErrorMessage($errors);
        ?>
        <div class="page-content" id="content">
            <a href="character-form.php" class="button">Nouveau personnage</a>

            <?= getCharactersSheetsList($charactersDatas) ?>
        </div>

    </main>
    <footer class="footer">
        <? echo fetchFooter() ?>
    </footer>

    <script type="module" src="js/script.js"></script>
    <script type="module" src="js/index.js"></script>
    <script type="module" src="js/password.js"></script>
    <script type="module" src="js/cursor.js"></script>
</body>

</html>