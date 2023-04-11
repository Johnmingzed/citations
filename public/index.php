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

if (isset($_GET['controller'])) {
    switch ($_GET['controller']) {
        case 'citations':
            $controller = $_GET['controller'];
            break;
        default:
            $controller = '404';
    }
} else {
    $controller = 'citations';
}

require_once ROOT . '/controller/' . $controller . '/index.php';
