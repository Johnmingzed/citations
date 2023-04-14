<?php

/**
 * Routage par action sur les utilisateurs
 */

if (isset($_SESSION['profil']['is_admin']) && $_SESSION['profil']['is_admin'] === 1) {

    require_once ROOT . '/model/utilisateurs.model.php';

    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'list':
            case 'delete':
            case 'edit':
            case 'update':
            case 'add':
                $action = $_GET['action'];
                break;
            default:
                require_once ROOT . '/controller/404/index.php';
        }
    } else {
        $action = 'list';
    }

    require_once __DIR__ . '/' . $action . '.php';
} else {
    header('Location: index.php');
}
