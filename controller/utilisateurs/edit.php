<?php

/**
 * Sélectionne un utilisateur par son ID
 */

if (isset($_GET['id'])) {
    $utilisateur = fetch_user_by_id($pdo, $_GET['id']);
} else {
    $msg = [
        'css' => 'warning',
        'txt' => 'Veuillez sélectionner un utilisateur'
    ];
    $_SESSION['msg'] = $msg;
    header('Location: index.php?controller=utilisateurs&action=list');
}

require_once ROOT . '/view/utilisateurs/edit.view.php';
