<?php
$title = 'Les auteurs';
ob_start();
?>

<main>
    <h2>Liste des auteurs</h2>
    <section>
        <form action="index.php?controller=auteurs&action=add" method="post">
            <fieldset>
                <legend>
                    <h3>Ajouter un auteur</h3>
                </legend>
                <div class="input">
                    <label for="auteur">Nom : </label>
                    <input type="text" name="auteur" id="auteur">
                </div>
                <div class="input">
                    <label for="bio">Biograhpie : </label>
                    <textarea name="bio" id="bio" rows="5" cols="60"></textarea>
                </div>
                <input type="submit" value="Ajouter">
            </fieldset>
        </form>
    </section>
    <table>
        <tr>
            <th>Auteur</th>
            <th>Biographie</th>
            <th>Date d'enregistrement</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($auteurs as $auteur) : ?>
            <tr>
                <td><a href="index.php?controller=auteurs&action=read&id=<?= $auteur['id'] ?>"><?= $auteur['auteur'] ?></a></td>
                <td><?= substr($auteur['bio'], 0, 40) . '...' ?></td>
                <td><?= $auteur['date_modif'] ?></td>
                <td><a href="index.php?controller=auteurs&action=edit&id=<?= $auteur['id'] ?>">modifier</a> - <a href="index.php?controller=auteurs&action=delete&id=<?= $auteur['id'] ?>">supprimer</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</main>

<?php $content = ob_get_clean();

require ROOT . '/view/templates/default.php';
