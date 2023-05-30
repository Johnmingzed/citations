<?php

namespace Core\Database;

use PDO;

/**
 * Classe DbTools
 * 
 * Cette classe fournit des outils pour interagir avec la base de données.
 */
class DbTools
{
    /**
     * Méthode getFields
     * 
     * Récupère les noms des champs d'une table donnée.
     * 
     * @param string $table Le nom de la table.
     * @return array Les noms des champs de la table.
     */
    static public function getFields($table)
    {
        $columns = [];

        // Construction de la requête SQL pour récupérer les informations sur les colonnes de la table
        $sql = 'SHOW COLUMNS FROM ' . $table;

        // Récupération de l'instance de la base de données
        $db = DbFactory::getDb(DbFactory::MY_SQL);

        // Exécution de la requête SQL
        $q = $db->query($sql);

        // Récupération de toutes les colonnes sous forme de tableau associatif
        $all = $q->fetchAll(PDO::FETCH_ASSOC);

        // Parcours des colonnes et récupération des noms de champ
        foreach ($all as $value) {
            $columns[] = $value['Field'];
        }

        return $columns;
    }
}


