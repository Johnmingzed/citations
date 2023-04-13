<?php
$title = 'Les auteurs';
ob_start();
?>

<main>
    <h2>Liste des auteurs</h2>

    <table>
        <tr>
            <th>Auteur</th>
            <th>Biographie</th>
            <th>Date d'enregistrement</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($auteurs as $auteur) : ?>
            <tr>
                <td><?= $auteur['auteur'] ?></a></td>
                <td><a href="index.php?controller=auteurs&action=read&id=<?= $auteur['id'] ?>"><?= substr($auteur['bio'], 0, 40) . '...' ?></a></td>
                <td><?= $auteur['date_modif'] ?></td>
                <td><a href="index.php?controller=auteurs&action=edit&id=<?= $auteur['id'] ?>">modifier</a> - <a href="index.php?controller=auteurs&action=delete&id=<?= $auteur['id'] ?>">supprimer</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</main>

<?php $content = ob_get_clean();

require ROOT . '/view/templates/default.php';
