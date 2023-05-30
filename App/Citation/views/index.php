<?php



ob_start();

?>
<div class="container cards">
    <?php foreach ($data as $citation) : ?>
        <div class="card w-40 m-2">
            <div class="card-body">
                <h3><?= $citation->citation ?></h3>
                <?php if ($citation->explication != null) { ?>
                    <div class="explication">
                        <?= substr(htmlentities($citation->explication),  0, 150) . '...' ?>
                    </div>
                <?php } ?>
                <div class="actions">
                    <a href="/citation/modifier/<?= $citation->id ?>" class="btn btn-primary">Modifier</a>
                    <a href="/citation/supprimer/<?= $citation->id  ?>" class="btn btn-danger">Supprimer</a>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>

<?php

$content = ob_get_clean();
require $template;
