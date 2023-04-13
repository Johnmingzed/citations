On passe par le controlleur utilisateur ADD |

<?php

debug($_POST);

if (isset($_POST['mail'])) {
    if (!empty($_POST['mail'])) {
        $_POST['prenom'] = empty($_POST['prenom']) ? NULL : ucfirst(strtolower($_POST['prenom']));
        $_POST['nom'] = empty($_POST['nom']) ? NULL : strtoupper($_POST['nom']);
        $_POST['is_admin'] = empty($_POST['is_admin']) ? NULL : $_POST['is_admin'];

        if (auteurs_add($pdo, $_POST['auteur'], $_POST['prenom'])) {
            $_SESSION['msg'] = [
                'css' => 'success',
                'txt' => 'Votre auteur a bien été ajoutée.'
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

// header('Location: index.php?controller=utilisateurs&action=list');
