<?php
require_once "./includes/_config.php";
require_once "./includes/_database.php";
require_once './includes/_function.php';
require_once './includes/_message.php';
require_once './includes/_security.php';
require_once "./includes/components/_head.php";
require_once "./includes/components/_header.php";
require_once "./includes/components/_footer.php";

isLocked();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?= fetchHead($javascriptLink, $cssLink); ?>
</head>

<body>

    <main>
        <a href="index.php" class="hero-banner hero-banner--smaller">
            <img class="hero-banner__img--smaller" src="logo/logo-rolist-mingle.svg" alt="Logo Rolist-Mingle, dé de Jeu de Rôle">
            <h2 class="logo__ttl logo__ttl--smaller">Rolist-Mingle</h1>
        </a>

        <div class="page-content">
            <section class="container" aria-labelledby="mdp">
                <h1 id="mdp" class="ttl ttl--big">Mot de passe<br>oublié</h1>
                <p>Tu as oublié ton mot de passe ?<br>Ce n’est pas grave, on va t’aider à te reconnecter !</p>
                <form action="" method="get" aria-label="Formulaire d'oubli de mot de passe'">
                    <ul class="form__container">
                        <li class="form__itm">
                            <label class="input__label" for="email">Ton email <span class="input__required" aria-hidden="true">*</span></label>
                            <input class="input" type="email" name="email" id="email" placeholder="exemple@email.com" aria-label="Renseigne l'email lié à ton compte" required>
                        </li>
                    </ul>
                    <div class="form__container">
                        <p class="input__required--txt" aria-hidden="true">Les champs marqués d’une <span class="input__required">*</span> sont obligatoires.
                        </p>
                        <input class="button" type="submit" value="Réinitialiser">
                    </div>
                </form>
            </section>
        </div>
    </main>

    <footer class="footer">
        <? echo fetchFooter() ?>
    </footer>
    <script type="module" src="js/script.js"></script>
    <script type="module" src="js/password.js"></script>
    <script type="module" src="js/cursor.js"></script>
</body>