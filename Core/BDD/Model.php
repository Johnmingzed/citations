<?php

namespace Core\BDD;

use Exception;
use PDO;
use PDOException;
use PDOStatement;

class Model extends Database
{
    protected $table = 'auteurs';
    protected $db;

    public function __construct()
    {
        $this->db = parent::getInstance();
    }

    public function statement(string $sql, array $attributes = NULL): PDOStatement|false
    {
        if (is_null($attributes)) {
            //requête simple
            return $this->db->query($sql);
        } else {
            //requête préparée
            $q = $this->db->prepare($sql);
            $q->execute($attributes);
            return $q;
        }
    }

    /**
     * Sélection de tous les enregistrements d'une table
     * @return array Tableau des enregistrement trouvés
     */
    public function findAll(): array
    {
        $sql = 'SELECT * FROM ' . $this->table;
        $q = $this->statement($sql);
        return $q->fetchAll();
    }

    public function findBy(array $attributes)
    {
        $fields = [];
        $values = [];
        foreach ($attributes as $key => $value) {
            $fields[] = $key . ' = ? ';
            $values[] = $value;
        }
        $sql = 'SELECT * FROM ' . $this->table . ' WHERE ' . implode(' AND ', $fields);
        $q = $this->statement($sql, $values);
        return $q->fetchAll();
    }

    public function findById(int $id)
    {
        $sql = 'SELECT * FROM ' . $this->table . ' WHERE id = ' . $id;
        $q = $this->statement($sql);
        return $q->fetchAll();
    }

    public function create(array $attributes)
    {
        //dump($attributes);
        $fields = [];
        $values = [];
        foreach ($attributes as $key => $value) {
            $fields[] = $key;
            $values[] = '\'' . $value . '\'';
        }
        //dump($fields, $values);
        // INSERT INTO auteurs (key1, key2) VALUES ('value1', 'value2');
        $sql = 'INSERT INTO ' . $this->table . ' (' . implode(', ', $fields) . ') VALUES (' . implode(', ', $values) . ')';
        //dump($sql);
        return $this->statement($sql);
    }

    public function update(array $attributes)
    {
        if (isset($attributes['id'])) {
            $id = $attributes['id'];
            unset($attributes['id']);
            $fields = [];
            $values = [];
            foreach ($attributes as $key => $value) {
                $fields[] = $key . ' = ?';
                $values[] = $value;
            }
            // UPDATE annonces SET titre = ?, description = ?, actif = ? WHERE id= ?
            $sql = 'UPDATE ' . $this->table . ' SET ' . implode(', ', $fields) . ' WHERE id = ?';
            $values[] = $id;
            dump($sql, $values);
            return $this->statement($sql, $values);
        }
    }

    public function delete(int $id)
    {
        $sql = 'DELETE FROM ' . $this->table . ' WHERE id = ' . $id;
        return $this->statement($sql);
    }
}
