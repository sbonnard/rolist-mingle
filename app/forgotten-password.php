<?php
require "./includes/_config.php";
require "./includes/_database.php";
require "./includes/components/_head.php";
require "./includes/components/_footer.php";

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <? echo fetchHead("Mot de passe oublié | Rolist-Mingle"); ?>
</head>

<body>
    <header class="header">
        <div class="container__header">
            <img class="header__img" src="logo/logo-rolist-mingle.svg" alt="logo de rolist-mingle représentant un dé 20 de JDR">
            <a href="reinitialize-password.php">
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
                        <a href="flow.php" class="nav__lnk">Accueil <img src="icones/home.svg" alt="icone accueil"></a>
                    </li>
                    <li class="nav__itm">
                        <a href="parties.php" class="nav__lnk" aria-label="Parties de Jeu de Rôle">Parties <img src="icones/parties.svg" alt="icone parties dés de JDR"></a>
                    </li>
                    <li class="nav__itm">
                        <a href="messages.php" class="nav__lnk">Messagerie <img src="icones/messages.svg" alt="icone messagerie"></a>
                    </li>
                    <li class="nav__itm">
                        <a href="larp-agenda.php" class="nav__lnk" aria-label="Agenda des Jeux de Rôle Grandeur Nature">Agenda GNs <img src="icones/agenda.svg" alt="icone agenda"></a>
                    </li>
                    <li class="nav__itm">
                        <a href="my-account.php" class="nav__lnk">Mon compte
                            <picture>
                                <source class="avatar" srcset="img/avatar-m.webp" media="(min-width: 768px)">
                                <img class="nav__avatar" src="img/avatar.webp" alt="icones personnelles">
                            </picture>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

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
    <script src="js/script.js"></script>
</body>