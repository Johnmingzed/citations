On passe par le controlleur utilisateur DELETE |
<?php

/**
 * Supprime un utilisateur par son ID
 */

if (isset($_GET['id']) && !empty($_GET['id'])) {
    users_delete($pdo, $_GET['id']);
    $msg = [
        'css' => 'success',
        'txt' => 'L\'utilisateur a bien été supprimé.'
    ];
}else{
    $msg = [
        'css' => 'warning',
        'txt' => 'Action impossible.'
    ];
}

$_SESSION['msg'] = $msg;
header('Location: index.php?controller=utilisateurs&action=list');
