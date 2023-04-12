<?php

require ROOT . '/model/auteurs.model.php';

/**
 * Controller action lit
 */

// On va chercher les données du model
$citations = citations_fetchall($pdo);
$auteurs = auteurs_fetchall($pdo);

 // On appelle la vue
require_once ROOT . '/view/citations/list.view.php';