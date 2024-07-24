<?php

// include_once 'includes/_functions.php';

/**
 * Get HTML head content.
 *
 * @param string $headTitle - The title in the head element.
 * @return string - A string of HTML elements.
 */
function fetchHead(string $headTitle):string
{
    return 
        '<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>' . $headTitle . '</title>
        <link rel="shortcut icon" href="icones/favicon.ico" type="image/x-icon">
        <!-- if development -->
        <script type="module" src="http://localhost:5173/@vite/client"></script>
        <script type="module" src="http://localhost:5173/js/script.js"></script>';
}
