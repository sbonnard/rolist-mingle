<?php

// require_once "../_headDatas.php";

// include_once 'includes/_functions.php';



/**
 * Get HTML head content.
 *
 * @param string $headTitle - The title in the head element.
 * @return string - A string of HTML elements.
 */
function fetchHead(string $javascriptLink, string $cssLink, string $headTitle = "Don't Roll Single"): string
{
    return '
        <!-- =============================================
             BASE
        ============================================= -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="robots" content="index, follow">
        <meta name="author" content="Don\'t Roll Single">
        <meta name="keywords" content="JDR en ligne, lancer de dés, jeu de rôle, dés virtuels, gestion personnage, PV mana bourse, compagnon JDR, table virtuelle">
 
        <title>' . $headTitle . '</title>
        <meta name="description" content="Don\'t Roll Single – votre compagnon de JDR en ligne. Lancez vos dés, gérez les PV, mana et bourse de vos personnages, le tout depuis votre navigateur.">
        <link rel="canonical" href="https://dontrollsingle.fr/">
 
        <!-- =============================================
             OPEN GRAPH (Facebook, WhatsApp, LinkedIn…)
        ============================================= -->
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="Don\'t Roll Single">
        <meta property="og:locale" content="fr_FR">
        <meta property="og:url" content="https://dontrollsingle.fr/">
        <meta property="og:title" content="Don\'t Roll Single – Compagnon JDR en ligne">
        <meta property="og:description" content="Lancez vos dés, gérez PV, mana et bourse de vos personnages. Votre table de jeu de rôle virtuelle, toujours avec vous.">
        <meta property="og:image" content="https://dontrollsingle.fr/assets/preview-jdr.webp">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta property="og:image:alt" content="Don\'t Roll Single – interface de jeu de rôle en ligne">
 
        <!-- =============================================
             TWITTER / X
        ============================================= -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="Don\'t Roll Single – Compagnon JDR en ligne">
        <meta name="twitter:description" content="Lancez vos dés, gérez PV, mana et bourse de vos personnages. Votre table de jeu de rôle virtuelle, toujours avec vous.">
        <meta name="twitter:image" content="https://dontrollsingle.fr/assets/preview-jdr.webp">
 
        <!-- =============================================
             DONNÉES STRUCTURÉES JSON-LD
        ============================================= -->
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebApplication",
            "name": "Don\'t Roll Single",
            "url": "https://dontrollsingle.fr",
            "description": "Compagnon de jeu de rôle en ligne : lancer de dés, gestion des PV, mana et bourse de vos personnages.",
            "applicationCategory": "GameApplication",
            "operatingSystem": "All",
            "browserRequirements": "Requires JavaScript",
            "inLanguage": "fr-FR",
            "offers": {
                "@type": "Offer",
                "price": "0",
                "priceCurrency": "EUR"
            }
        }
        </script>
 
        <!-- =============================================
             FAVICON & ICÔNES
        ============================================= -->
        <link rel="shortcut icon" href="icones/favicon.ico" type="image/x-icon">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
 
        <!-- =============================================
             STYLES & SCRIPTS
        ============================================= -->
        <link rel="stylesheet" href="assets/assets/' . $cssLink . '.css">
        <script type="module" src="assets/assets/' . $javascriptLink . '.js"></script>
        <script type="module" src="https://dontrollsingle.fr/js/script.js"></script>
 
        <!-- Développement -->
        <!-- <script type="module" src="http://localhost:5173/@vite/client"></script>
        <script type="module" src="http://localhost:5173/js/script.js"></script> -->
 
        <!-- AOS -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    ';
}

// function fetchHead(string $javascriptLink, string $cssLink, string $headTitle = "Don't Roll Single"):string
// {
//     return 
//         '<meta charset="UTF-8">
//         <meta name="viewport" content="width=device-width, initial-scale=1.0">
//         <meta name="description" content="Trouvez votre prochain groupe de Jeu de Rôle (JDR) : joueurs, compagnons, lancers de dés et gestion de personnages en ligne.">
        
//         <!-- External shares -->
//         <meta property="og:title" content="Trouvez votre groupe de Jeu de Rôle (JDR)">
//         <meta property="og:description" content="Rejoignez ou créez un groupe JDR avec des outils en ligne : dés, personnages et compagnons.">
//         <meta property="og:image" content="https://dontrollsingle.fr/assets/preview-jdr.webp">
//         <meta property="og:url" content="https://dontrollsingle.fr">
//         <meta property="og:type" content="website">

//         <meta name="twitter:card" content="summary_large_image">
//         <meta name="twitter:title" content="Trouvez votre groupe de Jeu de Rôle (JDR)">
//         <meta name="twitter:description" content="Plateforme JDR : groupes, joueurs, dés et personnages en ligne.">
//         <meta name="twitter:image" content="https://dontrollsingle.fr/assets/preview-jdr.webp">
        
//         <!-- Title -->
//         <title>' . $headTitle . '</title>
//         <link rel="shortcut icon" href="icones/favicon.ico" type="image/x-icon">
        
//         <!-- if development -->
//         <script type="module" src="http://localhost:5173/@vite/client"></script>
//         <script type="module" src="http://localhost:5173/js/script.js"></script>
        
//          <!-- Production -->
//         <!-- <link rel="stylesheet" href="assets/assets/' . $cssLink . '.css">
//         <script type="module" src="assets/assets/' . $javascriptLink . '.js"></script>
//         <script type="module" src="https://dontrollsingle.fr/js/script.js"></script> -->
        
//         <!-- AOS -->
//         <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
//         <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>'
//         ;
// }
