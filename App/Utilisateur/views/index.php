<?php



ob_start();

?>
<div class="container cards">
    <?php foreach ($data as $utilisateur) : ?>
        <div class="card w-40 m-2 p-3">
            <div class="prenom">
                <?= $utilisateur->prenom ?>
            </div>
            <div class="nom">
                <?= $utilisateur->nom ?>
            </div>
            <div class="mail">
                <?= $utilisateur->mail ?>
            </div>
            <div class="actions">
                <a href="/utilisateur/modifier/<?= $utilisateur->id ?>">Mod</a>
                <a href="/utilisateur/supprimer/<?= $utilisateur->id  ?>">Supp</a>
            </div>
        </div>
    <?php endforeach ?>
</div>

<?php

$content = ob_get_clean();
require $template;
