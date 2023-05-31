<?php



ob_start();

?>
<div class="d-flex flex-wrap gap-3">
    <?php foreach ($data as $citation) : ?>
        <div class="card w-25">
            <div class="card-body d-flex flex-column">
                <h4 class="card-text"><?= $citation->citation ?></h4>
                <?php if ($citation->explication != null) { ?>
                    <div class="card-text d-flex flex-grow-1">
                        <?= substr(htmlentities($citation->explication),  0, 150) . '...' ?>
                    </div>
                <?php } ?>
                <div class="actions ">
                    <a href="../citation/modifier/<?= $citation->id ?>" class="btn btn-primary">Modifier</a>
                    <a href="../citation/supprimer/<?= $citation->id  ?>" class="btn btn-danger">Supprimer</a>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>

<?php

$content = ob_get_clean();
require $template;
