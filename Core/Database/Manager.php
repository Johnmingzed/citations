<?php

namespace Core\Database;

use \PDO;
use \PDOException;
use \PDOStatement;
use \Core\Debug;
use \Core\Entity;
use \Core\Database\DbTools;
use Throwable;
use Exception;

/**
 * Classe Manager
 *
 * Description : Cette classe est responsable de la gestion des opérations de base de données.
 * Elle permet d'effectuer des requêtes SQL, récupérer des données à partir de la base de données,
 * et effectuer des opérations de création.
 *
 * @package Core\Database
 */
class Manager 
{
    /**
     * @var string $table Le nom de la table associée à cette classe Manager.
     */
    protected $table;

    /**
     * Méthode statement
     *
     * Description : Exécute une requête SQL sur la base de données.
     *
     * @param string $sql La requête SQL à exécuter.
     * @param array|null $attributs Les attributs à lier à la requête préparée (facultatif).
     * @return PDOStatement Le résultat de la requête SQL.
     */
    public function statement(string $sql, array $attributs = null)
    {
        $db = DbFactory::getDb(DbFactory::MY_SQL);
        if (is_null($attributs)) {

            $q = $db->query($sql);
            return $q;
        } else {

            $q = $db->prepare($sql);
            $q->execute($attributs);
            return $q;
        }
    }

    /**
     * Méthode getEntityClassName
     *
     * Description : Récupère le nom de la classe de l'entité associée à cette classe Manager.
     *
     * @return string Le nom de la classe de l'entité.
     */
    protected function getEntityClassName()
    {
        $class_name = substr(ucfirst($this->table), 0, -1);
        $class_name = '\App\\' . $class_name . '\\' . $class_name . 'Entity';
        return $class_name;
    }


    /**
     * Méthode findAll
     *
     * Description : Récupère tous les enregistrements de la table associée à cette classe Manager.
     *
     * @return array Un tableau contenant tous les enregistrements sous forme d'objets de l'entité associée.
     */
    public function findAll()
    {
        $sql = 'SELECT * FROM ' . $this->table;
        $q = $this->statement($sql);
        return $q->fetchAll(PDO::FETCH_CLASS, $this->getEntityClassName());
    }

    /**
     * Méthode findBy
     *
     * Description : Récupère les enregistrements correspondant aux critères spécifiés de la table associée à cette classe Manager.
     *
     * @param array $data Un tableau associatif des critères de recherche.
     * @return array Un tableau contenant les enregistrements correspondants sous forme d'objets de l'entité associée.
     */
    public function findBy(array $data)
    {
        $champs = array();
        $valeurs = array();

        foreach ($data as $key => $value) {
            $champs[] = $key . ' = ?';
            $valeurs[] = $value;
        }
        $sql = 'SELECT * FROM ' . $this->table . ' WHERE ' . implode(' AND ', $champs);
        $q = $this->statement($sql, $valeurs);
        return $q->fetchAll(PDO::FETCH_CLASS, $this->getEntityClassName());
    }

    /**
     * Méthode find
     *
     * Description : Récupère un enregistrement  en fonction de l'ID.
     *
     * @param int $id L'ID de l'enregistrement à rechercher.
     * @return mixed L'enregistrement correspondant sous forme d'objet de l'entité associée ou faux.
     */
    public function find(int $id)
    {
        $list = $this->findBy(['id' => $id]);
        if(isset($list[0])){
            return $list[0];
        }
        return false;
    }


    /**
     * Méthode create
     *
     * Description : Crée un nouvel enregistrement dans la table associée à cette classe Manager.
     *
     * @param Entity $entity L'objet de l'entité à créer.
     * @return mixed L'enregistrement créé sous forme d'objet de l'entité associée.
     * @throws Exception Si l'enregistrement existe déjà.
     */
    public function create(Entity $entity)
    {
        if (!$entity->est_nouveau()) trigger_error('Déjà enregistré', E_USER_ERROR);

        $champs = [];
        $interrogation = [];
        $valeurs = [];
        $columns = DbTools::getFields($this->table);
        foreach ($columns as $column) {
            $getter = 'get' . ucfirst($column);
            if (!is_null($entity->$getter())) {
                $champs[] = $column;
                $interrogation[] = '?';
                $valeurs[] = $entity->$getter();
            }
        }

        $sql = 'INSERT INTO ' . $this->table . '(' . implode(', ', $champs) . ')';
        $sql .= ' VALUES (' . implode(', ', $interrogation) . ')';
        try {
            $q = $this->statement($sql, $valeurs);
            $id = DbFactory::getDb(DbFactory::MY_SQL)->lastInsertId();
            return $this->find($id);
        } catch (PDOException $e) {
            if (DEBUG) {
                echo $e->getMessage();
            }
        }
    }


    /**
     * Méthode delete
     *
     * Description : Supprime un enregistrement spécifique de la table associée à cette classe Manager en fonction de l'ID.
     *
     * @param int $id L'ID de l'enregistrement à supprimer.
     * @return bool True si la suppression a réussi, sinon False.
     */
    public function delete(int $id): bool
    {
        $sql = 'DELETE FROM ' . $this->table . ' WHERE id=?';
        try {
            $this->statement($sql, [$id]);
            return true;
        } catch (PDOException $e) {
            if (DEBUG) {
                echo $e->getMessage();
            }
        }
        return false;
    }

    /**
     * Méthode update
     *
     * Description : Met à jour un enregistrement existant dans la table associée à cette classe Manager.
     *
     * @param Entity $entity L'objet de l'entité à mettre à jour.
     * @return bool True si la mise à jour a réussi, sinon False.
     * @throws Exception Si l'enregistrement n'est pas trouvé.
     */
    public function update(Entity $entity)
    {
        if ($entity->est_nouveau()) {
            throw new Exception("L'enregistrement n'existe pas et ne peut pas être mis à jour.");
        }

        $champs_valeurs = [];
        $valeurs = [];
        $columns = DbTools::getFields($this->table);

        foreach ($columns as $column) {
            $getter = 'get' . ucfirst($column);
            if (!is_null($entity->$getter())) {
                $champs_valeurs[] = $column . ' = ?';
                $valeurs[] = $entity->$getter();
            }
        }

        $valeurs[] = $entity->getId(); // Ajout de l'ID comme valeur pour la condition WHERE

        $sql = 'UPDATE ' . $this->table . ' SET ' . implode(', ', $champs_valeurs) . ' WHERE id = ?';

        try {
            $this->statement($sql, $valeurs);
            return true;
        } catch (PDOException $e) {
            if (DEBUG) {
                echo $e->getMessage();
            }
            return false;
        }
    }
}
