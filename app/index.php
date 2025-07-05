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

    <main>


        <div class="hero-banner">
            <?php
            echo getSuccessMessage($messages);
            echo getErrorMessage($errors);
            ?>
            <img class="hero-banner__img" src="logo/logo-rolist-mingle.svg" alt="Logo Rolist-Mingle, dé de Jeu de Rôle">
            <h1 class="logo__ttl">Rolist-Mingle</h1>
            <h2 class="logo__tagline">Don't Roll Single</h2>
            <a href="#content" class="hero-banner__btn">
                <img src="img/angle-down.svg" alt="Bouton vers contenu principal">
            </a>
        </div>

        <div class="page-content" id="content">
            <div class="container--desktop">
                <section class="container grid-counter">
                    <h3 class="ttl ttl--primary">nombre d'inscrits</h3>
                    <p class="users-counter">999999</p>
                    <img class="users-counter__img" src="img/rolist-inn.webp" alt="Personnages d'univers variés buvant un verre dans une taverne médiévale.">

                    <section class="grid-concept" aria-labelledby="concept">
                        <h2 class="ttl ttl--primary">Le concept</h2>
                        <p>Rolist-Mingle a pour vocation d'aider à la rencontre de rôlistes, confirmés ou non. Pour tous
                            ceux qui souhaiteraient jouer plus ou se lancer dans le Jeu de Rôle sur table ou à distance,
                            Rolist-Mingle se veut un lieu d'échanges et de rencontres entre rôlistes avec les mêmes
                            envies. <br>
                            A ton inscription, tu pourras définir ton profil de rôliste symbolisé par différents dés de JDR et
                            retrouver ton ou tes
                            "moitiés" pour jouer plus souvent !</p>
                    </section>
                </section>

                <div class="concept-dice__container grid-dices" aria-label="Présentation des différents profils de rôlistes">
                    <section class="container concept-dice js-concept-dice" data-concept-dice="100" aria-labelledby="dice100" aria-label="Présentation des profils de rôlistes types.">
                        <h4 class="ttl" id="dice100">Dé 100</h4>
                        <img src="icones/dé100.webp" alt="dé 100 de JDR">
                        <p class="concept-dice__txt">Maître du Jeu<br>cherche joueurs</p>
                        <h5 class="ttl concept-dice__sub-ttl">Dominateur</h5>
                    </section>

                    <section class="container concept-dice" data-concept-dice="20" aria-labelledby="dice20" aria-label="Présentation des profils de rôlistes types.">
                        <h4 class="ttl" id="dice20">Dé 20</h4>
                        <img src="icones/dé20.webp" alt="dé 20 de JDR">
                        <p class="concept-dice__txt">Cherche
                            <br>sa moitié
                        </p>
                        <h5 class="ttl concept-dice__sub-ttl">Sérieux</h5>
                    </section>

                    <section class="container concept-dice" data-concept-dice="12" aria-labelledby="dice12" aria-label="Présentation des profils de rôlistes types.">
                        <h4 class="ttl" id="dice12">Dé 12</h4>
                        <img src="icones/dé12.webp" alt="dé 12 de JDR">
                        <p class="concept-dice__txt">Cherche plan
                            <br>JDR régulier
                        </p>
                        <h5 class="ttl concept-dice__sub-ttl">Veut s'amuser</h5>
                    </section>

                    <section class="container concept-dice" data-concept-dice="8" aria-labelledby="dice8" aria-label="Présentation des profils de rôlistes types.">
                        <h4 class="ttl" id="dice8">Dé 8</h4>
                        <img src="icones/dé8.webp" alt="dé 8 de JDR">
                        <p class="concept-dice__txt">Cherche JDR court
                            <br>voire très court
                        </p>
                        <h5 class="ttl concept-dice__sub-ttl">Plus si affinité</h5>
                    </section>

                    <section class="container concept-dice" data-concept-dice="4" aria-labelledby="dice4" aria-label="Présentation des profils de rôlistes types.">
                        <h4 class="ttl" id="dice4">Dé 4</h4>
                        <img src="icones/dé4.webp" alt="dé 4 de JDR">
                        <p class="concept-dice__txt">Juste pour un soir
                            <br>en one-shot
                        </p>
                        <h5 class="ttl concept-dice__sub-ttl">JDR sans lendemain</h5>
                    </section>
                </div>

                <section class="container" aria-labelledby="connexion grid-form">
                    <h2 class="ttl ttl--primary" id="connexion">connexion</h2>
                    <form action="login.php" method="post" aria-label="Formulaire de connexion">
                        <ul class="form__container">
                            <li class="form__itm">
                                <label class="input__label" for="username">email</label>
                                <input class="input" type="text" name="email" id="email" placeholder="rôliste@rolist-mingle.fr" required aria-label="Entrez votre email">
                            </li>
                            <li class="form__itm">
                                <label class="input__label" for="password">Mot de passe</label>
                                <div class="input--password">
                                    <input class="input" type="password" name="password" id="password" placeholder="•••••••••••" required aria-label="Merci d'entrer votre mot de passe">
                                    <button class="button--eye button--eye--inactive" id="eye-button" aria-label="Montrer le mot de passe en clair dans le champs de saisie"></button>
                                </div>
                            </li>
                            <p class="lnk--underlined"><a href="forgotten-password.php">Mot de passe oublié ?</a></p>
                            <input class="button" type="submit" value="Se connecter">
                            <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                            <input type="hidden" name="action" value="log-in">
                        </ul>
                    </form>
                    <div class="form__container">
                        <p>Pas encore de compte ?</p>
                        <div class="button__txt"><a class="button button--empty" href="register.php">Créer un compte</a></div>
                    </div>
                </section>
            </div>
        </div>

    </main>
    <footer class="footer">
        <? echo fetchFooter() ?>
    </footer>

    <script type="module" src="js/script.js"></script>
    <script type="module" src="js/index.js"></script>
    <script type="module" src="js/password.js"></script>
</body>

</html>