<?php

ob_start();
?>
<a class="btn btn-primary" role="button" aria-disabled="true" href="/auteur/ajouter">Ajouter un auteur</a>
<div class="container cards">
    <?php foreach ($data as $auteur) : ?>
        <div class="card w-40 m-2">
            <div class="card-body">
                <h3 class="card-title"><?= $auteur->auteur ?></h3>
                <p class="card-text"><?= substr(htmlentities($auteur->bio), 0, 200) . '...' ?></p>
                <a href="/auteur/modifier/<?= $auteur->id ?>" class="btn btn-primary">Modifier</a>
                <a href="/auteur/supprimer/<?= $auteur->id ?>" class="btn btn-danger">Supprimer</a>
            </div>
        </div>
    <?php endforeach ?>
</div>

<?php

$content = ob_get_clean();
require $template;
