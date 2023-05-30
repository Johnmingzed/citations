<?php

ob_start();
?>
<form class="container cards" action="/auteur/ajouter" method="post">
    <?php
    $form = new Core\HTML\Form();
    $form->input('auteur');
    $form->textarea('bio');
    $form->submit('Ajouter');
    ?>
</form>

<?php

$content = ob_get_clean();
require $template;
