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

generateToken();

if (isset($_SESSION['email'])) {
    $userDatas = fetchUserDatas($dbCo, $_SESSION);
    $profilColour = defineProfilColour($userDatas);
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
            <h1 class="ttl ttl--big ttl--center">Créer un personnage</h1>
            <form class="form" method="post" action="actions.php" enctype="multipart/form-data">
                <ul class="form__container">
                    <li class="form__itm">
                        <label class="input__label" for="characterName">Nom complet de personnage</label>
                        <input class="input" type="text" name="characterName" id="characterName" placeholder="Sullivan Graham Erelion" required aria-label="Nom du personnage">
                    </li>
                    <li class="form__itm">
                        <label class="input__label" for="characterHP">Nombre de PVs maximal</label>
                        <input class="input" type="text" name="characterHP" id="characterHP" placeholder="100" required aria-label="Nombre maximal de PVs du perosnnage">
                    </li>
                    <li class="form__itm">
                        <label class="input__label" for="characterMana">Nombre de Manas maximal</label>
                        <input class="input" type="text" name="characterMana" id="characterMana" placeholder="100" required aria-label="Nombre maximal de manas du perosnnage">
                    </li>
                    <li class="form__itm">
                        <label class="input__label" for="attachment">Illustration du personnage</label>
                        <input type="file" name="attachment" id="attachment" accept=".png, .jpeg, .jpg, .webp">
                    </li>
                </ul>
                <input class="button" type="submit" value="Créer personnage">
                <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                <input type="hidden" name="action" value="createCharacter">
            </form>
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