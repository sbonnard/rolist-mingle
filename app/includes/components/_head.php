<?php

// require_once "../_headDatas.php";

// include_once 'includes/_functions.php';



/**
 * Get HTML head content.
 *
 * @param string $headTitle - The title in the head element.
 * @return string - A string of HTML elements.
 */
function fetchHead(string $javascriptLink, string $cssLink, string $headTitle = "Don't Roll Single"):string
{
    return 
        '<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Trouvez votre prochain groupe de Jeu de Rôle (JDR) : joueurs, compagnons, lancers de dés et gestion de personnages en ligne.">
        
        <!-- External shares -->
        <meta property="og:title" content="Trouvez votre groupe de Jeu de Rôle (JDR)">
        <meta property="og:description" content="Rejoignez ou créez un groupe JDR avec des outils en ligne : dés, personnages et compagnons.">
        <meta property="og:image" content="https://dontrollsingle.fr/assets/preview-jdr.webp">
        <meta property="og:url" content="https://dontrollsingle.fr">
        <meta property="og:type" content="website">

        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="Trouvez votre groupe de Jeu de Rôle (JDR)">
        <meta name="twitter:description" content="Plateforme JDR : groupes, joueurs, dés et personnages en ligne.">
        <meta name="twitter:image" content="https://dontrollsingle.fr/assets/preview-jdr.webp">
        
        <!-- Title -->
        <title>' . $headTitle . '</title>
        <link rel="shortcut icon" href="icones/favicon.ico" type="image/x-icon">
        
        <!-- if development -->
        <script type="module" src="http://localhost:5173/@vite/client"></script>
        <script type="module" src="http://localhost:5173/js/script.js"></script>
        
         <!-- Production -->
        <!-- <link rel="stylesheet" href="assets/assets/' . $cssLink . '.css">
        <script type="module" src="assets/assets/' . $javascriptLink . ' .js"></script>
        <script type="module" src="https://dontrollsingle.fr/js/script.js"></script> -->
        
        <!-- AOS -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>'
        ;
}
