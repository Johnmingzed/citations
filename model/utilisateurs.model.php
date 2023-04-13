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