<?php
session_start();

require_once "./includes/_config.php";
require_once "./includes/_database.php";
require_once './includes/_function.php';
require_once './includes/_message.php';
require_once './includes/_security.php';
require_once "./includes/components/_head.php";
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
   <?= fetchHeader($globalURL, $_SESSION); ?>

    <main>
        <div class="page-content content-position">

            <section class="container party__page-content">
                <h1 class="ttl ttl--big">JDR DnD</h1>
                <h2 class="txt--bigger ttl--primary">Donjons & Dragons</h2>
                <p>à Vesoul (70)</p>
                <p>4 joueurs</p>
                <p>Le Maître du Jeu sera @Slike</p>
                <img src="icones/dice100-50x50.svg" alt="Dé 100 'Maître du Jeu'">
                <form action="" method="get" aria-label="Formulaire de contact d'une partie de JDR">
                    <ul class="form__container">
                        <li class="form__itm">
                            <label class="input__label" for="message">Ton message :</label>
                            <textarea class="input" name="message" id="message" cols="30" rows="10" placeholder="Écris ton message ici !"></textarea>
                        </li>
                        <button class="button"><a href="party-contact-2.php">Demander à rejoindre</a></button>
                    </ul>
                </form>
            </section>

        </div>
    </main>

    <footer class="footer">
        <?= fetchFooter($globalURL); ?>
    </footer>

    <script>
        AOS.init();
    </script>
    <script src="js/script.js"></script>
</body>