<?php
$title = 'Un auteur en détails';
ob_start();
?>

<main>
    <h2>Un auteur en détails</h2>
    <section>
        <h3><?= $auteur['auteur'] ?></h3>
        <p class="explication"><?= $auteur['bio'] ?></p>
        <p>Date d'enregistement : <?= $auteur['date_modif'] ?></p>
        <?php if (isset($_SESSION['profil']['is_admin']) && $_SESSION['profil']['is_admin'] === 1) : ?>
            <a href="index.php?controller=auteurs&action=edit&id=<?= $auteur['id'] ?>">modifier</a> - <a href="index.php?controller=auteurs&action=delete&id=<?= $auteur['id'] ?>">supprimer</a>
        <?php endif ?>
    </section>
</main>

<?php $content = ob_get_clean();

require ROOT . '/view/templates/default.php';
