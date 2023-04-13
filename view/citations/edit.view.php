<?php
$title = 'Modifier une citation';
ob_start();
?>

<main>
    <h2>Modifier une citation</h2>
    <section>

        <form action="index.php?controller=citations&action=update&id=<?= $citation['id']; ?>" method="post">
            <fieldset>
                <legend>
                    <h3>Citation à modifier</h3>
                </legend>
                <div class="input">
                    <label for="citation">Citation : </label>
                    <textarea name="citation" id="citation" rows="5" cols="60"><?= $citation['citation'] ?></textarea>
                </div>
                <div class="input">
                    <label for="auteurs_id">Auteur : </label>
                    <select name="auteurs_id" id="auteurs">
                        <option value="">Auteur inconnu</option>
                        <?php foreach ($auteurs as $auteur) : ?>
                            <option value="<?= $auteur['id']; ?>" <?php echo ($auteur['auteur'] === $citation['auteur']) ? ' selected' : ''; ?>><?= $auteur['auteur']; ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="input">
                    <label for="explication">Explication : </label>
                    <textarea name="explication" id="explication" rows="5" cols="60"><?= $citation['explication'] ?></textarea>
                </div>
                <input type="submit" value="Modifier">
            </fieldset>
        </form>
    </section>
</main>

<?php $content = ob_get_clean();

require ROOT . '/view/templates/default.php';
