<?php
session_start();

require_once '../includes/_database.php';
require_once '../includes/_config.php';
require_once '../includes/_security.php';
require_once '../includes/_function.php';
require_once '../includes/_datas.php';
require_once '../includes/_message.php';
require_once '../includes/components/_head.php';
require_once '../includes/components/_header.php';
require_once '../includes/components/_footer.php';

generateToken();

if (isset($_SESSION['form'])) {
    unset($_SESSION['form']);
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?= fetchHead($javascriptLink, $cssLink); ?>
</head>

<body>

    <?= fetchHeader($globalURL, $_SESSION); ?>
    <?= getCustomCursor() ?>
    <main class="main">
        <div class="container errorPage">
             <h1 class="errorPage__code" id="association-ttl">Erreur 403</h1>
            <p class="errorPage__para">Hey ! Circulez y'a rien à voir !</p>
        </div>
    </main>

    <footer class="footer">
        <?= fetchFooter($globalURL); ?>
    </footer>
</body>

<script>
    AOS.init();
</script>
<script type="module" src="../js/script.js"></script>

</html>