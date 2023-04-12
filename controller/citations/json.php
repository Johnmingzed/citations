<?php

require ROOT . '/model/auteurs.model.php';

/**
 * Controller action lit
 */

// On prépare notre fichier json
$data=[];
$data['date'] = date('c');

// On va chercher les données du model et on les intègres au fichier json
$data['citations'] = citations_fetchall($pdo);
$data['auteurs'] = auteurs_fetchall($pdo);

 // On précise que l'on change de type de document
header('Content-Type: application/json');

// On transforme notre liste de citations en objet JSON
echo json_encode($data,JSON_PRETTY_PRINT);