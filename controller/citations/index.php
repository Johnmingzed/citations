<?php

/**
 * Routage par action sur les citations
 */

require_once ROOT . '/model/citations.model.php';

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'list':
        case 'delete':
        case 'edit':
        case 'update':
        case 'add':
        case 'json':
        case 'read':
            $action = $_GET['action'];
            break;
        default:
            require_once ROOT . '/controller/404/index.php';
            exit;
    }
} else {
    $action = 'list';
}

require_once __DIR__ . '/' . $action . '.php';
