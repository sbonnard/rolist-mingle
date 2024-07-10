<?php

function fetchHead(string $headTitle)
{
    return 
        '<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>' . $headTitle . '</title>
        <link rel="shortcut icon" href="logo/favicon.ico" type="image/x-icon">
        <!-- if development -->
        <script type="module" src="http://localhost:5173/@vite/client"></script>
        <script type="module" src="http://localhost:5173/js/script.js"></script>';
}
