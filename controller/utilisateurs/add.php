On passe par le controlleur utilisateur ADD |

<?php

debug($_POST);

if (isset($_POST['mail'])) {
    if (!empty($_POST['mail'])) {
        $_POST['prenom'] = empty($_POST['prenom']) ? NULL : ucfirst(strtolower($_POST['prenom']));
        $_POST['nom'] = empty($_POST['nom']) ? NULL : strtoupper($_POST['nom']);
        $_POST['is_admin'] = isset($_POST['is_admin']) && $_POST['is_admin'] === 'on';

        if (users_add($pdo, $_POST['mail'], $_POST['prenom'], $_POST['nom'], $_POST['is_admin'])) {
            $_SESSION['msg'] = [
                'css' => 'success',
                'txt' => 'Le nouvel utilisateur a bien été créé.'
            ];
        } else {
            $_SESSION['msg'] = [
                'css' => 'warning',
                'txt' => 'Action impossible.'
            ];
        }
    } else {
        $_SESSION['msg'] = [
            'css' => 'warning',
            'txt' => 'Merci de compléter tout les champs.'
        ];
    }
}

header('Location: index.php?controller=utilisateurs&action=list');
