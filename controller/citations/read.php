<?php

require ROOT . '/model/auteurs.model.php';

/**
 * Affiche un citation au complet par son ID
 */

if (isset($_GET['id'])) {
    $citation = citations_fetchById($pdo, $_GET['id']);
} else {
    $msg = [
        'css' => 'warning',
        'txt' => 'Veuillez sélectionner une citation'
    ];
    $_SESSION['msg'] = $msg;
    header('Location: index.php?controller=citations&action=list');
}

// debug($citation);
require_once ROOT . '/view/citations/read.view.php';
