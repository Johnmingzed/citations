<?php

/**
 * Controller action lit
 */

// On va chercher les données du model
$auteurs = auteurs_fetchall($pdo);

 // On appelle la vue
require_once ROOT . '/view/auteurs/list.view.php';