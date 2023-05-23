<?php

namespace Core\BDD;

use Exception;
use PDO;
use PDOException;

/**
 * Ré-écrit PDO dans un singleton
 */
class Database extends PDO
{
    static $instance;

    protected function __construct()
    {
        require_once ROOT . '/conf/bdd.php';
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
        try {
            parent::__construct($dsn, DB_USER, DB_PASS);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAME UTF8');
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        } catch (Exception $e) {
            header('HTTP/1.1 500 INTERNAL SERVER ERROR');
            echo 'Nous avons rencontré une erreur interne : ';
            echo $e->getMessage();
        }
        // echo uniqid();
    }

    private function __clone()
    {
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}
