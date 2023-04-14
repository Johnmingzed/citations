<?php
$title = 'Modifier un utilisateur';
ob_start();
?>

<main>
    <h2>Modifier un utilisateur</h2>
    <section>

        <form action="index.php?controller=utilisateurs&action=update&id=<?= $utilisateur['id']; ?>" method="post">
            <fieldset>
                <legend>
                    <h3>Utilisateur à modifier</h3>
                </legend>
                <div class="input">
                    <label for="prenom">Prénom : </label>
                    <input type="text" name="prenom" id="prenom" value="<?= $utilisateur['prenom'] ?>">
                </div>
                <div class="input">
                    <label for="nom">Nom : </label>
                    <input type="text" name="nom" id="nom" value="<?= $utilisateur['nom'] ?>">
                </div>
                <div class="input">
                    <label for="mail">E-mail : </label>
                    <input type="email" name="mail" id="mail" value="<?= $utilisateur['mail'] ?>">
                </div>
                <div class="password">
                    <span>Mot de passe : </span>
                    <?php
                    if (!empty($utilisateur['mot_de_passe'])) {
                        echo '<span class="pw_active">ACTIF</span>';
                    } else {
                        echo '<span class="pw_inactive">INACTIF</span>';
                    }
                    ?>
                    <a class="button" href="index.php?controller=utilisateurs&action=pw_reset&id=<?= $utilisateur['id']; ?>">Réinitialiser</a>
                </div>
                <div class="id_admin">
                    <label for="id_admin">Administrateur </label>
                    <input type="checkbox" name="is_admin" id="is_admin" <?= ($utilisateur['is_admin'] === 1) ? 'checked' : '' ?>>
                </div>
                <input type="submit" value="Modifier">
                <a class="button" href="index.php?controller=utilisateurs&action=list">Annuler</a>
            </fieldset>
        </form>
    </section>
</main>

<?php $content = ob_get_clean();

require ROOT . '/view/templates/default.php';
