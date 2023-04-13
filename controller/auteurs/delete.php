<?php

/**
 * Supprime un auteur par son ID
 */

if (isset($_GET['id'])) {
    auteurs_delete($pdo, $_GET['id']);
    $msg = [
        'css' => 'success',
        'txt' => 'L\'auteur a bien été supprimé de la liste.'
    ];
}else{
    $msg = [
        'css' => 'warning',
        'txt' => 'Action impossible.'
    ];
}

$_SESSION['msg'] = $msg;
header('Location: index.php?controller=auteurs&action=list');
