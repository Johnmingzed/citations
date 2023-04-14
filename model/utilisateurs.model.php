<?php

/**
 * Composants d'accès aux données de la table utilisateurs
 */

require __DIR__ . '/pdo.php';

function get_password(PDO $pdo, string $email){
    $sql = 'SELECT mot_de_passe FROM utilisateurs WHERE mail = ?';
    $q = $pdo->prepare($sql);
    $q->execute([$email]);
    return $q->fetchColumn();
}





function fetch_user_by_mail(PDO $pdo, string $email){
    $sql = 'SELECT id, nom, prenom, mail, is_admin FROM utilisateurs WHERE mail = ?';
    $q = $pdo->prepare($sql);
    $q->execute([$email]);
    return $q->fetch(PDO::FETCH_ASSOC);
}




/**
 * Retourne l'ensemble des utilisateurs
 *
 * @param PDO $pdo
 * @return array
 */
function users_fetchAll(PDO $pdo)
{
    $sql = 'SELECT id, nom, prenom, mail, is_admin FROM utilisateurs';
    $q = $pdo->query($sql);
    return $q->fetchAll(PDO::FETCH_ASSOC);
}




/**
 * Ajouter un nouvel utilisateur
 * 
 * @param PDO $pdo
 * @param string $mail
 * @param string $prenom
 * @param string $nom
 * @param bool $is_admin
 * @return bool
 */
function users_add(PDO $pdo, string $mail, string $prenom = null, string $nom = null, bool $is_admin = null)
{
    $sql = 'INSERT INTO utilisateurs (mail, prenom, nom, is_admin) VALUES (:mail, :prenom, :nom, :is_admin)';
    $q = $pdo->prepare($sql);
    $q->bindValue(':mail', $mail);
    $q->bindValue(':prenom', $prenom);
    $q->bindValue(':nom', $nom);
    $q->bindValue(':is_admin', $is_admin);
    return $q->execute();
}




/**
 * Supprime un utilisateur par son ID
 * 
 * @param PDO $pdo
 * @param int $id
 * @return bool
 */
function users_delete(PDO $pdo, int $id)
{
    $sql = 'DELETE FROM utilisateurs WHERE id = ?';
    $q = $pdo->prepare($sql);
    return $q->execute([$id]);
}