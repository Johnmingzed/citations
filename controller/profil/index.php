<?php

/**
 * Routage par action sur les profils 
 */

require ROOT . '/model/utilisateurs.model.php';

if (isset($_GET['action']) && $_GET['action'] === 'deconnexion') unset($_SESSION['profil']);

if (isset($_POST['email'], $_POST['password'])) {
    $hash = get_password($pdo, $_POST['email']);
    if (is_string($hash) && password_verify($_POST['password'], $hash)) {
        $_SESSION['profil'] = fetch_user_by_mail($pdo, $_POST['email']);
        header('Location: index.php');
    } else {
        echo 'Erreur';
    }
}

if (!isset($_SESSION['profil'])) {
    require ROOT . '/view/utilisateurs/connexion.php';
}
