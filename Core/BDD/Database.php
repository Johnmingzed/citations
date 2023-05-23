<?php

namespace Core\BDD;

use Exception;
use PDO;
use PDOException;

/**
 * Ré-écriture de PDO dans un singleton
 * Authorise une seule instance de la classe
 */
class Database extends PDO
{
    private static $instance;

    private function __construct()
    {
        // Appel des constantes de connexion
        require_once ROOT . '/conf/bdd.php';

        // DSN de connexion à la base de données
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;

        try {
            parent::__construct($dsn, DB_USER, DB_PASS);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAME UTF8');
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            header('HTTP/1.1 500 INTERNAL SERVER ERROR');
            echo 'Nous avons rencontré une erreur interne : ';
            echo $e->getMessage();
        }
        // echo uniqid();
    }

    private function __clone()
    {
    }

    public static function getInstance(): self
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}
