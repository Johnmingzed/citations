<?php

/**
 * Supprime une citation par son ID
 */

if (isset($_GET['id'])) {
    citations_delete($pdo, $_GET['id']);
    $msg = [
        'css' => 'success',
        'txt' => 'La citation a bien été supprimée.'
    ];
}else{
    $msg = [
        'css' => 'warning',
        'txt' => 'Action impossible.'
    ];
}

$_SESSION['msg'] = $msg;
header('Location: index.php?controller=citations&action=list');
