<?php

/* echo '<pre>';
print_r($_GET);
echo '</pre>'; */

/**
 * Entrée de notre application
 * Appelle le fichier conf
 * Route vers le bon controller
 */

session_start();

require_once '../inc/conf.php';
require_once '../inc/debug.php';

if (isset($_GET['controller'])) {
    switch ($_GET['controller']) {
        case 'citations':
        case 'auteurs':
        case 'utilisateurs':
        case 'profil':
            $controller = $_GET['controller'];
            break;
        default:
            $controller = '404';
    }
} else {
    $controller = 'citations';
}

if (!isset($_SESSION['profil'])) {
    $controller = 'profil';
}

require_once ROOT . '/controller/' . $controller . '/index.php';
