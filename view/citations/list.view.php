<?php
$title = 'Les citations';
ob_start();
?>

<main>
    <h2>Liste des citations</h2>
    <section>

        <form action="index.php?controller=citations&action=add" method="post">
            <fieldset>
                <legend>
                    <h3>Ajouter une citation</h3>
                </legend>
                <div class="input">
                    <label for="citation">Citation : </label>
                    <textarea name="citation" id="citation"></textarea>
                </div>
                <div class="input">
                    <label for="auteur">Auteur : </label>
                    <select name="auteur" id="auteur">
                        <option value="">Auteur inconnu</option>
                        <?php foreach ($auteurs as $auteur) : ?>
                            <option value="<?= $auteur['id']; ?>"><?= $auteur['auteur']; ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="input">
                    <label for="explication">Explication : </label>
                    <textarea name="explication" id="explication"></textarea>
                </div>
                <input type="submit" value="Ajouter">
            </fieldset>
        </form>
    </section>
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
