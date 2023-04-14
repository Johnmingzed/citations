<?php

/**
 * Controller action list
 */

// On va chercher les données du model
$utilisateurs = users_fetchAll($pdo);

 // On appelle la vue
require_once ROOT . '/view/utilisateurs/list.view.php';