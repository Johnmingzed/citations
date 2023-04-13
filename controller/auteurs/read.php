<?php

/**
 * Affiche un auteur et sa biographie complète par son ID
 */

if (isset($_GET['id'])) {
    $auteur = auteurs_fetchById($pdo, $_GET['id']);
} else {
    $msg = [
        'css' => 'warning',
        'txt' => 'Veuillez sélectionner un auteur'
    ];
    $_SESSION['msg'] = $msg;
    header('Location: index.php?controller=auteurs&action=list');
}

// debug($auteur);
require_once ROOT . '/view/auteurs/read.view.php';
