Ne fonctionne pas encore...

<?php

/**
 * Outils divers d'accès aux données
 */

require_once __DIR__ . '/pdo.php';

/**
 * Vérifie qu'une donnée est bien unique
 * en s'assurant qu'elle n'existe pas déjà dans la base
 * 
 * @param PDO $pdo
 * @param string $database
 * @param string $key
 * @param string $test
 * @return bool
 */
function uniquity_check(PDO $pdo, $database, $key, $test)
{
    $database = $pdo->quote($database);
    $key = $pdo->quote($key);
    $sql = 'SELECT COUNT(*) FROM `$database` WHERE `$key` = :test';
    $q = $pdo->prepare($sql);
    $q->bindParam(':test', $test);
    $q->execute();
    return $q->fetchColumn() == 0;
}
