<?php
$title = 'Modifier un auteur';
ob_start();
?>

<main>
    <h2>Modifier un auteur</h2>
    <section>

        <form action="index.php?controller=auteurs&action=update&id=<?= $auteur['id']; ?>" method="post">
            <fieldset>
                <legend>
                    <h3>Auteur à modifier</h3>
                </legend>
                <div class="input">
                    <label for="auteur">Nom : </label>
                    <input type="text" name="auteur" id="auteur" value="<?= $auteur['auteur'] ?>">
                </div>
                <div class="input">
                    <label for="bio">Biograhpie : </label>
                    <textarea name="bio" id="bio" rows="5" cols="60"><?= $auteur['bio'] ?></textarea>
                </div>
                <input type="submit" value="Modifier">
                <a class="button" href="index.php?controller=auteurs&action=list">Annuler</a>
            </fieldset>
        </form>
    </section>
</main>

<?php $content = ob_get_clean();

require ROOT . '/view/templates/default.php';
