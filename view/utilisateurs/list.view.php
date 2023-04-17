<?php
$title = 'Les utilisateurs';
ob_start();
?>

<main>
    <h2>Liste des utilisateurs</h2>
        <section>
        <form action="index.php?controller=utilisateurs&action=add" method="post">
            <fieldset>
                <legend>
                    <h3>Ajouter un utilisateur</h3>
                </legend>
                <div class="input">
                    <label for="prenom">Prénom : </label>
                    <input type="text" name="prenom" id="prenom">
                </div>
                <div class="input">
                    <label for="nom">Nom : </label>
                    <input type="text" name="nom" id="nom">
                </div>
                <div class="input">
                    <label for="mail">E-mail : </label>
                    <input type="email" name="mail" id="mail">
                </div>
                <div class="id_admin">
                    <label for="id_admin">Administrateur </label>
                    <input type="checkbox" name="is_admin" id="is_admin">
                </div>
                <input type="submit" value="Ajouter">
            </fieldset>
        </form>
    </section>
    <table>
        <tr>
            <th>ID</th>
            <th>Prénom</th>
            <th>Nom</th>
            <th>E-mail</th>
            <th>Admin</th>
            <th>Action</th>
        </tr>
        <?php foreach ($utilisateurs as $utilisateur) : ?>
            <tr>
                <td><?= $utilisateur['id'] ?></td>
                <td><?= $utilisateur['prenom'] ?></td>
                <td><?= $utilisateur['nom'] ?></td>
                <td><?= $utilisateur['mail'] ?></td>
                <td><?= ($utilisateur['is_admin'] === 1) ? 'OUI' : 'NON' ?></td>
                <td><a href="index.php?controller=utilisateurs&action=edit&id=<?= $utilisateur['id'] ?>">modifier</a> - 
                <a href="index.php?controller=utilisateurs&action=delete&id=<?= $utilisateur['id'] ?>">supprimer</a> - 
                <a href="index.php?controller=utilisateurs&action=pw_reset&id=<?= $utilisateur['id'] ?>">réinitialisation du mot de passe</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</main>

<?php $content = ob_get_clean();

require ROOT . '/view/templates/default.php';
