<?php

require ROOT . '/model/auteurs.model.php';

/**
 * Sélectionne un citation au complet par son ID
 * ainsi que la liste des auteurs
 */

if (isset($_GET['id'])) {
    $citation = citations_fetchById($pdo, $_GET['id']);
    $auteurs = auteurs_fetchall($pdo);
} else {
    $msg = [
        'css' => 'warning',
        'txt' => 'Veuillez sélectionner une citation'
    ];
    $_SESSION['msg'] = $msg;
    header('Location: index.php?controller=citations&action=list');
}

// debug($citation);
require_once ROOT . '/view/citations/edit.view.php';
