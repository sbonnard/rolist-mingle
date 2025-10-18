<?php

/**
 * Generates the HTML header section of the page.
 *
 * @param array $session - The current user's session data.
 * @param array $userDatas - (Optional) The user's profile data, including avatar and other info.
 * @param string $profilColour - (Optional) A CSS class for the user's avatar border color.
 * @return string - The HTML content of the header.
 */
function fetchHeader(array $session, array $userDatas = [], string $profilColour = ''): string
{
    $header = '<header class="header bg-blur">

        <a href="index.php">
            <h1 class="ttl ttl--main">Don\'t Roll Single</h1>
        </a>
        <div class="hamburger">
            <a href="#menu" id="hamburger-menu-icon">
                <img src="img/hamburger.svg" alt="Menu Hamburger">
            </a>
        </div>
        <nav class="nav hamburger__menu" id="menu" aria-label="Navigation principale du site">
            <ul class="nav" id="nav-list">
            <li class="nav__itm nav__lnk--current">
                <a href="index.php"><img src="icones/home.svg" alt="icone accueil"></a>
                <a href="index.php" class="nav__lnk" aria-current="page">Accueil</a>
            </li>
             <li class="nav__itm nav__lnk--current">
                <a href="index.php"><img src="icones/home.svg" alt="icone accueil"></a>
                <a href="diceroller.php" class="nav__lnk" aria-current="page">Dés</a>
            </li>
            <li class="nav__itm">
                    <a href="parties.php"><img src="icones/parties.svg" alt="icone parties dés de JDR"></a>
                    <a href="parties.php" class="nav__lnk" aria-label="Parties de Jeu de Rôle">Parties</a>
                </li>';

    if (isset($session['email'])) {

        $header .= '<li class="nav__itm">
                            <a href="messages.php"><img src="icones/messages.svg" alt="icone messagerie"></a>
                            <a href="messages.php" class="nav__lnk">Messagerie</a>
                        </li>';
    }


    $header .= '<li class="nav__itm">
                    <a href="larp-agenda.php"><img src="icones/agenda.svg" alt="icone agenda"></a>
                    <a href="larp-agenda.php" class="nav__lnk" aria-label="Agenda des Jeux de Rôle Grandeur Nature">Agenda GNs</a>
                </li>';


    // if (isset($session['email'])) {
    //     $header += '<li class="nav__itm" data-avatar="">
    //                         <a href="my-profil-CRUD.php">
    //                             <picture>
    //                                 <source class="avatar" srcset="' . $userDatas[0]['avatar'] . '" media="(min-width: 768px)">
    //                                 <img class="nav__avatar js-avatar-hover  ' . $profilColour . '" src="' . $userDatas[0]['avatar'] . '" alt="icones personnelles">
    //                             </picture>
    //                         </a>
    //                         <a href="my-profil-CRUD.php" class="nav__lnk js-link-hover">Mon compte</a>
    //                     </li>
    //                     <li class="nav__itm">
    //                         <img src="icones/logout.svg" alt="icône déconnexion">
    //                         <a class="nav__lnk" href="logout.php">Déconnexion</a>
    //                     </li>';
    // }

    $header .= '</ul>
        </nav>
    </header>';

    return $header;
}
