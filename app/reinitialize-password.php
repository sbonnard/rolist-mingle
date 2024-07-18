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
    <header class="header">
        <div class="container__header">
            <img class="header__img" src="logo/logo-rolist-mingle.svg"
                alt="logo de rolist-mingle représentant un dé 20 de JDR">
            <a href="index.php">
                <h2 class="header__ttl">Rolist-Mingle</h2>
            </a>
            <div class="hamburger">
                <a href="#menu" id="hamburger-menu-icon">
                    <img src="img/hamburger.svg" alt="Menu Hamburger">
                </a>
            </div>
            <nav class="nav hamburger__menu" id="menu" aria-label="Navigation principale du site">
                <ul class="nav__lst" id="nav-list">
                    <li class="nav__itm nav__lnk--current">
                        <a href="flow.php" class="nav__lnk">Accueil <img src="icones/home.svg"
                                alt="icone accueil"></a>
                    </li>
                    <li class="nav__itm">
                        <a href="parties.php" class="nav__lnk" aria-label="Parties de Jeu de Rôle">Parties <img src="icones/parties.svg"
                                alt="icone parties dés de JDR"></a>
                    </li>
                    <li class="nav__itm">
                        <a href="messages.php" class="nav__lnk">Messagerie <img src="icones/messages.svg"
                                alt="icone messagerie"></a>
                    </li>
                    <li class="nav__itm">
                        <a href="larp-agenda.php" class="nav__lnk" aria-label="Agenda des Jeux de Rôle Grandeur Nature">Agenda GNs <img src="icones/agenda.svg"
                                alt="icone agenda"></a>
                    </li>
                    <li class="nav__itm" data-avatar="">
                        <a href="my-account.php" class="nav__lnk js-link-hover">Mon compte
                            <picture>
                                <source class="avatar" srcset="img/avatar-m.webp" media="(min-width: 768px)">
                                <img class="nav__avatar js-avatar-hover" src="img/avatar.webp" alt="icones personnelles">
                            </picture>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

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