<?php

if (isset($_POST['auteur'], $_POST['bio'])) {
    if (!empty($_POST['auteur'])) {
        $_POST['bio']= empty($_POST['bio']) ? NULL : $_POST['bio'];

        if (auteurs_add($pdo, $_POST['auteur'], $_POST['bio'])) {
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

header('Location: index.php?controller=auteurs&action=list');
