<?php

namespace Core\Database;

/**
 * Classe DbFactory
 * 
 * Cette classe est responsable de la création d'instances de base de données.
 */
class DbFactory
{
    /**
     * Constante MY_SQL
     * 
     * Constante représentant le type de base de données MySQL.
     */
    const MY_SQL = 'PDOMysql';


    //constante à venir
    //SQLITE, POSTGRE

    /**
     * Instance de la classe DbFactory
     * 
     * @var DbFactory|null L'instance de la classe DbFactory.
     */
    static $instance;

    /**
     * Méthode getDb
     * 
     * Crée et retourne une instance de base de données du type spécifié.
     * 
     * @param string $type Le type de base de données.
     * @return mixed L'instance de la base de données du type spécifié.
     */
    public static function getDb($type)
    {
        // Construction du nom de classe en fonction du type de base de données
        $class = __NAMESPACE__ . '\Db\\' . $type;

        // Vérification si la classe existe
        if (class_exists($class)) {
            return $class::getInstance();
        }
    }
}
