<?php

namespace Core\BDD;

use Exception;
use PDO;

class Model extends Database
{
    protected $table = 'auteurs';
    protected $db;

    public function __construct()
    {
        $this->db = parent::getInstance();
    }

    public function statement(string $sql, array $attributes = NULL): mixed
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

    public function findAll()
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
}
