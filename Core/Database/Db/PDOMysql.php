<?php

namespace Core\Database\Db;

use PDO;
use PDOException;
use PDOStatement;

/**
 * Classe PDOMysql
 *
 * Cette classe étend la classe PDO de PHP et représente une connexion à une base de données MySQL.
 */
class PDOMysql extends PDO
{
    static $instance;

    /**
     * Constructeur de la classe PDOMysql.
     *
     * Initialise une connexion à la base de données MySQL en utilisant les paramètres de configuration.
     * Configure les attributs PDO pour le mode de gestion des erreurs et le mode de récupération des résultats.
     */
    private function __construct()
    {
        // Inclusion du fichier de configuration de la base de données
        require_once ROOT . '/conf/bdd.php';

        // Construction de la chaîne de connexion DSN
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;

        // Appel du constructeur de la classe PDO parent avec la chaîne de connexion et les informations d'identification
        parent::__construct($dsn, DB_USER, DB_PASS);

        // Configuration des attributs PDO
        if (DEBUG) {
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } else {
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
        }

        $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
    }

    /**
     * Méthode getInstance
     *
     * Récupère l'instance unique de la classe PDOMysql ou en crée une nouvelle si elle n'existe pas encore.
     *
     * @return PDOMysql L'instance unique de la classe PDOMysql.
     */
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}
