Controller citation modification

<?php

debug($_POST);

if (isset($_GET['id'], $_POST['citation'], $_POST['auteurs_id'], $_POST['explication'])) {
    if (!empty($_POST['citation']) && !empty($_GET['id'])) {
        $_POST['auteurs_id'] = empty($_POST['auteurs_id']) ? NULL : $_POST['auteurs_id'];
        $_POST['explication'] = empty($_POST['explication']) ? NULL : $_POST['explication'];
        $_POST['id'] = $_GET['id'];

        if (citations_update($pdo, $_POST)) {
            $_SESSION['msg'] = [
                'css' => 'success',
                'txt' => 'Votre citation a bien été modifiée.'
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
