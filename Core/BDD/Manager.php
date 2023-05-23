<?php

namespace Core\BDD;

use Exception;
use PDO;
use PDOException;
use PDOStatement;

class Manager extends Database
{
    protected $table;
    protected Database $db;

    /**
     * Méthode principale d'éxecution des requêtes
     * @param string $sql // Requête SQL à éxecuter
     * @param array|NULL $attributes // Attributs à ajouter à la requête
     * @return PDOStatement|false
     */
    public function statement(string $sql, array $attributes = NULL): PDOStatement|false
    {
        $this->db = parent::getInstance();

        if (is_null($attributes)) {
            // Requête simple
            return $this->db->query($sql);
        } else {
            // Requête préparée
            $q = $this->db->prepare($sql);
            $q->execute($attributes);
            return $q;
        }
    }

    /**
     * Sélection de tous les enregistrements d'une table
     * @return array Tableau des enregistrements trouvés
     */
    public function findAll(): array
    {
        $sql = 'SELECT * FROM ' . $this->table;
        $q = $this->statement($sql);
        return $q->fetchAll();
    }

    /**
     * Sélection des enregistrements en fonction d'un tableau de critères
     * @param array $attributes // Critères de sélection
     * @return array Tableau des enregistrements trouvés
     */
    public function findBy(array $attributes): array
    {
        $fields = [];
        $values = [];
        foreach ($attributes as $key => $value) {
            $fields[] = $key . ' = ? ';
            $values[] = $value;
        }
        // SELECT * FROM auteurs WHERE auteur = 'Bob';
        $sql = 'SELECT * FROM ' . $this->table . ' WHERE ' . implode(' AND ', $fields);
        $q = $this->statement($sql, $values);
        return $q->fetchAll();
    }

    /**
     * Sélection d'un enregistrement par son ID
     * @param int $id // ID de l'enregistrement
     * @return array Tableau de l'enregistrement trouvé
     */
    public function findById(int $id)
    {
        $sql = 'SELECT * FROM ' . $this->table . ' WHERE id = ' . $id;
        $q = $this->statement($sql);
        return $q->fetch();
    }

    /**
     * Création d'une entrée selon un tableau de données
     * @param array $datas// Données à enregistrer
     * @return bool
     */
    public function create(array $datas)
    {
        $fields = [];
        $values = [];
        foreach ($datas as $key => $value) {
            if ($value !== NULL && $key != 'db' && $key != 'table') {
                $fields[] = $key;
                $placeholder[] = '?';
                $values[] = $value;
            }
        }
        // INSERT INTO auteurs (key1, key2) VALUES (?, ?);
        $sql = 'INSERT INTO ' . $this->table . ' (' . implode(', ', $fields) . ') VALUES (' . implode(', ', $placeholder) . ')';
        return $this->statement($sql, $values);
    }

    /**
     * Mise à jour d'une entrée sélectionnée par son ID
     * Selon les données fournis dans un tableau
     * @param array $datas// Données à mettre à jour
     * @return bool
     */
    public function update(array $datas)
    {
        if (is_int($datas['id']) && $datas['id'] > 0) {
            $id = $datas['id'];
            unset($datas['id']);
            $fields = [];
            $values = [];
            foreach ($datas as $key => $value) {
                if ($value !== NULL && $key != 'db' && $key != 'table') {
                    $fields[] = $key . ' = ?';
                    $values[] = $value;
                }
            }
            // UPDATE auteurs SET auteur = ?, bio = ?, extra = ? WHERE id= ?
            $sql = 'UPDATE ' . $this->table . ' SET ' . implode(', ', $fields) . ' WHERE id = ?';
            $values[] = $id;
            return $this->statement($sql, $values);
        }
    }

    /**
     * Suppression d'une entrée
     * @param integer $id
     * @return bool
     */
    public function delete(int $id)
    {
        $sql = 'DELETE FROM ' . $this->table . ' WHERE id = ?';
        return $this->statement($sql, [$id]);
    }
}
