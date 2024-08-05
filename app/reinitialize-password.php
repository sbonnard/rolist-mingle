<?php
require "./includes/_config.php";
require "./includes/_database.php";
include 'includes/_function.php';
require "./includes/components/_head.php";
require "./includes/components/_footer.php";

?>

<!DOCTYPE html>
<html lang="fr">

<head>
<? echo fetchHead("Réinitialisation Mot de Passe | Rolist-Mingle");?>
</head>

<body>

    <main>
        <a href="index.php" class="hero-banner hero-banner--smaller">
            <img class="hero-banner__img--smaller" src="logo/logo-rolist-mingle.svg"
                alt="Logo Rolist-Mingle, dé de Jeu de Rôle">
            <h2 class="logo__ttl logo__ttl--smaller">Rolist-Mingle</h1>
        </a>

        <div class="page-content">
            <section class="container" aria-labelledby="mdp">
                <h1 id="mdp" class="ttl ttl--big">Réinitialiser le<br>Mot de passe</h1>
                <form action="" method="get"
                    aria-label="Formulaire de demande de nouveau mot de passe. Deux champs à remplir.">
                    <ul class="form__container">
                        <li class="form__itm">
                            <label class="input__label" for="password">Nouveau mot de passe <span
                                    class="input__required" aria-hidden="true">*</span></label>
                            <input class="input" type="password" name="password" id="password" placeholder="•••••••••••"
                                required>
                        </li>
                        <li class="form__itm">
                            <label class="input__label" for="password">Confirmer le mot de passe <span
                                    class="input__required" aria-hidden="true">*</span></label>
                            <input class="input" type="password" name="password" id="password" placeholder="•••••••••••"
                                required>
                        </li>
                    </ul>
                    <div class="form__container">
                        <p class="input__required--txt" aria-hidden="true">Les champs marqués d’une <span
                                class="input__required">*</span> sont
                            obligatoires.</p>
                        <input class="button" type="submit" value="Confirmer" aria-label="Confirmer le nouveau mot de passe">
                    </div>
                </form>
            </section>
        </div>
    </main>

    <footer class="footer">
        <? echo fetchFooter() ?>
    </footer>
    
    <script src="js/script.js"></script>
</body>