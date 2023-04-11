<?php

/**
 * Composants d'accès aux données de la table citations
 */

require_once __DIR__ . '/pdo.php';

/**
 * Retourne l'ensemble des citations
 *
 * @param PDO $pdo
 * @return array
 */

function fetchall(PDO $pdo)
{
    // On définit la requête à écrire dans $sql
    $sql = 'SELECT citations.id, citations.citation, citations.explication, DATE_FORMAT(citations.date_modif, "%d/%m/%Y") as date_modif, auteurs.auteur 
    FROM citations 
    LEFT JOIN auteurs ON citations.auteurs_id = auteurs.id';

    // On prépare la requête

    // On execute la requête
    $q = $pdo->query($sql);

    // On transforme le résultat

    // On renvoit la réponse
    return $q->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Retourn une citation sélectionnée grâce à son ID
 * 
 * @param PDO $pdo
 * @param int $id
 * @return array|false
 */

function fetchById(PDO $pdo, int $id)
{
    $sql = 'SELECT * FROM citations WHERE citations.id = ?';
    $q = $pdo->prepare($sql);
    $q->execute([$id]);
    return $q->fetch(PDO::FETCH_ASSOC);
}

function add(PDO $pdo, string $citation, string $explication = null, int $auteurs_id = null)
{
    $sql = 'INSERT INTO citations (citations.citation, citations.explication, citations.auteurs_id) VALUES (:citation, :explication, :auteurs_id)';
    $q = $pdo->prepare($sql);
    $q->bindValue(':citation', $citation);
    $q->bindValue(':explication', $explication);
    $q->bindValue(':auteurs_id', $auteurs_id);
    return $q->execute();
}

function update(PDO $pdo, array $data)
{
    $sql = 'UPDATE citations SET ';
    foreach ($data as $key => $value) {
        $sql .= $key . ' = :' . $key . ', ';
    }
    $sql = substr($sql, 0, -2);
    $sql .= ' WHERE id = :id';
    $q = $pdo->prepare($sql);
    return $q->execute($data);
}

function delete(PDO $pdo, int $id)
{
    $sql = 'DELETE FROM citations WHERE id = :id';
    $q = $pdo->prepare($sql);
    return $q->execute([':id' => $id]);
}

// var_dump(fetchall($pdo));
// var_dump(fetchById($pdo, 1));
// var_dump(add($pdo, 'une autre citation personalisée'));
update($pdo, ['citation' => 'Test de modification', 'explication' => 'ceci est une explication modifiée en PHP', 'id' => 9]);

// delete($pdo, 12);
