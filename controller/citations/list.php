<?php

/**
 * Controller action lit
 */

// On va chercher les données du model
$citations = fetchall($pdo);

 // On appelle la vue
require_once ROOT . '/view/citations/list.view.php';