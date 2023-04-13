<?php

/**
 * Routage par action sur les auteurs
 */

require_once ROOT . '/model/auteurs.model.php';

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'list':
        case 'delete':
        case 'edit':
        case 'update':
        case 'add':
        case 'read':
            $action = $_GET['action'];
            break;
        default:
            require_once ROOT . '/controller/404/index.php';
    }
} else {
    $action = 'list';
}

require_once __DIR__ . '/' . $action . '.php';
