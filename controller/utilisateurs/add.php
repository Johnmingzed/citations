<?php

// require_once  '../model/tools.php'; ne fonctionne pas encore...

if (isset($_POST['mail'])) {
    if (!empty($_POST['mail'])) {
        $_POST['prenom'] = empty($_POST['prenom']) ? NULL : ucfirst(strtolower($_POST['prenom']));
        $_POST['nom'] = empty($_POST['nom']) ? NULL : strtoupper($_POST['nom']);
        $_POST['is_admin'] = isset($_POST['is_admin']) && $_POST['is_admin'] === 'on';

        // On vérifie que l'adresse mail est unique
        $sql = "SELECT COUNT(*) FROM utilisateurs WHERE mail = ?";
        $q = $pdo->prepare($sql);
        $q->execute([$_POST['mail']]);
        if ($q->fetchColumn() === 0) {
            // Si elle est unique on enregistre l'utilisateur
            if (users_add($pdo, $_POST['mail'], $_POST['prenom'], $_POST['nom'], $_POST['is_admin'])) {
                $msg = [
                    'css' => 'success',
                    'txt' => 'Le nouvel utilisateur a bien été créé.'
                ];
            } else {
                $msg = [
                    'css' => 'warning',
                    'txt' => 'Action impossible.'
                ];
            }
        } else {
            // Sinon on affiche un message d'erreur
            $msg = [
                'css' => 'success',
                'txt' => 'Cette adresse est déjà utilisée.'
            ];
        }
    } else {
        $msg = [
            'css' => 'warning',
            'txt' => 'Merci de compléter tout les champs.'
        ];
    }
}

$_SESSION['msg'] = $msg;
header('Location: index.php?controller=utilisateurs&action=list');
