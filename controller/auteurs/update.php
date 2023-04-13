Controller auteur modification

<?php

if (isset($_GET['id'], $_POST['auteur'], $_POST['bio'])) {
    if (!empty($_POST['auteur']) && !empty($_GET['id'])) {
        $_POST['bio'] = empty($_POST['bio']) ? NULL : $_POST['bio'];
        $_POST['id'] = $_GET['id'];

        if (auteurs_update($pdo, $_POST)) {
            $_SESSION['msg'] = [
                'css' => 'success',
                'txt' => 'Votre auteur a bien été modifiée.'
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

header('Location: index.php?controller=auteurs&action=list');
