<?php 
$title = 'Les citations';
ob_start();
?>

<main>
    <h2>Liste des citations</h2>
    <table>
        <tr>
            <th>Citations</th>
            <th>Auteur</th>
            <th>Date de modification</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($citations as $citation) : ?>
            <tr>
                <td><?= substr($citation['citation'], 0, 30) . '...' ?></td>
                <td><?php
                    if (empty($citation['auteur'])) {
                        echo 'Anonyme';
                    } else {
                        echo $citation['auteur'];
                    }
                    ?></td>
                <td><?= $citation['date_modif'] ?></td>
                <td><a href="index.php?controller=citations&action=edit&id=<?= $citation['id'] ?>">modifier</a> - <a href="index.php?controller=citations&action=delete&id=<?= $citation['id'] ?>">supprimer</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</main>

<?php $content = ob_get_clean();

require ROOT . '/view/templates/default.php';