<?php

ob_start();
?>
<a class="btn btn-primary mb-3" role="button" aria-disabled="true" href="/auteur/ajouter">Ajouter un auteur</a>
<div class="d-flex flex-wrap gap-3">
    <?php foreach ($data as $auteur) : ?>
        <div class="card w-25">
            <div class="card-body">
                <h3 class="card-title"><?= $auteur->auteur ?></h3>
                <p class="card-text"><?= substr(htmlentities($auteur->bio), 0, 200) . '...' ?></p>
                <div class="actions">
                    <a href="../auteur/modifier/<?= $auteur->id ?>" class="btn btn-primary">Modifier</a>
                    <a href="../auteur/supprimer/<?= $auteur->id ?>" class="btn btn-danger">Supprimer</a>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>

<?php

$content = ob_get_clean();
require $template;
