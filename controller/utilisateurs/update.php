On passe par le controlleur utilisateur UPDATE |

<?php

/* $_POST['id'] = $_GET['id'];
$_POST['is_admin'] = (isset($_POST['is_admin']) && $_POST['is_admin'] === 'on') ? 1 : 0;
die; */

debug($_POST);
if (isset($_GET['id'], $_POST['mail'])) {
    if (!empty($_POST['mail']) && !empty($_GET['id'])) {
        $_POST['prenom'] = empty($_POST['prenom']) ? NULL : ucfirst(strtolower($_POST['prenom']));
        $_POST['nom'] = empty($_POST['nom']) ? NULL : strtoupper($_POST['nom']);
        $_POST['is_admin'] = ($_POST['is_admin'] === 'on') ? 1 : 0;
        $_POST['id'] = $_GET['id'];

        // On vérifie que l'adresse mail est unique
        $sql = "SELECT COUNT(*) FROM utilisateurs WHERE mail = ?";
        $q = $pdo->prepare($sql);
        $q->execute([$_POST['mail']]);
        if ($q->fetchColumn() === 0) {
            // Si elle est unique on enregistre les modifications
            if (users_update($pdo, $_POST)) {
                $_SESSION['msg'] = [
                    'css' => 'success',
                    'txt' => 'Votre utilisateur a bien été modifiée.'
                ];
            } else {
                $_SESSION['msg'] = [
                    'css' => 'warning',
                    'txt' => 'Action impossible.'
                ];
                header('Location: index.php?controller=utilisateurs&action=edit&id='.$_GET['id'].'');
            }
        } else {
            // Sinon on affiche un message d'erreur
            $_SESSION['msg'] = [
                'css' => 'success',
                'txt' => 'Cette adresse est déjà utilisée.'
            ];
            header('Location: index.php?controller=utilisateurs&action=edit&id='.$_GET['id'].'');
        }
    } else {
        $_SESSION['msg'] = [
            'css' => 'warning',
            'txt' => 'Merci de compléter tout les champs.'
        ];
    }
}
header('Location: index.php?controller=utilisateurs&action=list');
