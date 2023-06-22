<?php

ob_start();

$form = new Core\HTML\Form();

$form->setMethod('POST')
    ->setAction("/auteur/ajouter")
    ->setName("nonvelAuteur");

$form->nest('<div class="form-group">');

$form->addInput(["type" => 'text', "name" => "nom", "class" => "form-control"], "Nom");

$form->addTextarea(["id" => "bio", "name" => "bio", "rows" => 6, "class" => "form-control"], "Biographie");

$form->addInput(["type" => "submit", "value" => "Ajouter", "class" => "btn btn-success"]);

$form->render();

?>

<?php

$content = ob_get_clean();
require $template;
