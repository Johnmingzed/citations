<?php
$title = 'Une citation en détails';
ob_start();
?>

<main>
    <h2>Une citation en détails</h2>
    <section>
    <p><?= $citation['citation'] ?></p><cite><?= $citation['auteur'] ?></cite>
    <p class="explication"><?= $citation['explication'] ?></p>
    <p>Dernière modification : <?= $citation['date_modif'] ?></p>
    <?php if(isset($_SESSION['profil']['is_admin']) && $_SESSION['profil']['is_admin'] === 1) : ?>
    <a href="index.php?controller=citations&action=edit&id=<?= $citation['id'] ?>">modifier</a> - <a href="index.php?controller=citations&action=delete&id=<?= $citation['id'] ?>">supprimer</a>
    <?php endif ?>
    </section>
</main>

<?php $content = ob_get_clean();

require ROOT . '/view/templates/default.php';
