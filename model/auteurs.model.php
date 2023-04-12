<?php

/**
 * Composants d'accès aux données de la table auteurs
 */

require __DIR__ . '/pdo.php';

function auteurs_fetchall(PDO $pdo){
    $sql = 'SELECT * FROM auteurs ORDER BY auteur';
    $q = $pdo->query($sql);
    return $q->fetchAll(PDO::FETCH_ASSOC);
}