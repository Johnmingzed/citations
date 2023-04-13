<?php

/**
 * Composants d'accès aux données de la table auteurs
 */

require __DIR__ . '/pdo.php';

/**
 * Retourne l'ensemble des auteurs
 *
 * @param PDO $pdo
 * @return array
 */
function auteurs_fetchall(PDO $pdo)
{
    $sql = 'SELECT * FROM auteurs ORDER BY auteur';
    $q = $pdo->query($sql);
    return $q->fetchAll(PDO::FETCH_ASSOC);
}




/**
 * Retourne un auteur sélectionnée par son ID
 * 
 * @param PDO $pdo
 * @param int $id
 * @return array|false
 */
function auteurs_fetchById(PDO $pdo, int $id)
{
    $sql = 'SELECT * FROM auteurs WHERE auteurs.id = ?';
    $q = $pdo->prepare($sql);
    $q->execute([$id]);
    return $q->fetch(PDO::FETCH_ASSOC);
}




/**
 * Ajouter d'un nouvel auteur
 * 
 * @param PDO $pdo
 * @param string $auteur
 * @param string $bio
 * @return bool
 */
function auteurs_add(PDO $pdo, string $auteur, string $bio = null)
{
    $sql = 'INSERT INTO auteurs (auteur, bio) VALUES (:auteur, :bio)';
    $q = $pdo->prepare($sql);
    $q->bindValue(':auteur', $auteur);
    $q->bindValue(':bio', $bio);
    return $q->execute();
}




/**
 * Mettre à jour un auteur sélectionnée par son ID
 * 
 * @param PDO $pdo
 * @param array $data : tableau contenant les données de l'auteur dont son id
 * @return bool
 */
function auteurs_update(PDO $pdo, array $data)
{
    $sql = 'UPDATE auteurs SET ';
    foreach ($data as $key => $value) {
        $sql .= $key . ' = :' . $key . ', ';
    }
    $sql = substr($sql, 0, -2);
    $sql .= ' WHERE id = :id';
    $q = $pdo->prepare($sql);
    return $q->execute($data);
}




/**
 * Supprimer un auteur sélectionnée par son ID
 * 
 * @param PDO $pdo
 * @param int $id
 * @return bool
 */

function auteurs_delete(PDO $pdo, int $id)
{
    $sql = 'DELETE FROM auteurs WHERE id = :id';
    $q = $pdo->prepare($sql);
    return $q->execute([':id' => $id]);
}
