<?php

/**
 * Instancie un objet PDO, pilote de la BDD
 */

$dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;

try {
    $pdo = new PDO($dsn, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo 'Connexion à la BDD réussie';
} catch (Exception $e) {
    echo 'Erreur PDO : ' . $e->getMessage();
    die;
}
