<?php

if (isset($_POST['citation'], $_POST['auteur'], $_POST['explication'])) {
    if (!empty($_POST['citation'])) {
        $auteur_id = empty($_POST['auteur']) ? NULL : $_POST['auteur'];
        $explication = empty($_POST['explication']) ? NULL : $_POST['explication'];

        if (citations_add($pdo, $_POST['citation'], $explication, $auteur_id)) {
            $_SESSION['msg'] = [
                'css' => 'success',
                'txt' => 'Votre citation a bien été ajoutée.'
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

header('Location: index.php?controller=citations&action=list');
