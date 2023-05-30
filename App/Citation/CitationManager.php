<?php

namespace App\Citation;

use Core\Database\Manager;
use Core\Entity;
use App\Auteur\AuteurEntity;

use PDO;

/**
 * Classe Manager pour la classe CitationEntity.
 */
class CitationManager extends Manager
{
    /**
     * Constructeur de la classe CitationManager.
     */
    public function __construct()
    {
        $this->table = 'citations';
    }

    /**
     * Méthode findAll
     *
     * Description : Récupère tous les enregistrements de la table associée à cette classe Manager.
     * Cette méthode effectue une jointure avec la table "auteurs" pour récupérer les auteurs des citations.
     *
     * @return array Un tableau contenant tous les enregistrements sous forme d'objets de l'entité associée.
     */
    public function findAll()
    {
        $sql = 'SELECT citations.*, 
                    auteurs.id AS auteurs_id, 
                    auteurs.auteur AS auteurs_auteur,
                    auteurs.bio AS auteurs_bio,
                    auteurs.date_modif AS auteurs_date_modif
                FROM citations
                LEFT JOIN auteurs ON citations.auteurs_id = auteurs.id';

        $q = $this->statement($sql);
        //$q->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->getEntityClassName());

     
        $data = $q->fetchAll();
        $citations = [];

        foreach($data as $obj){
            $citation = new CitationEntity();
            $citation->setId($obj->id);
            $citation->setCitation($obj->citation);
            $citation->setDate_modif($obj->date_modif);
            $citation->setAuteurs_id($obj->auteurs_id);
            if($obj->explication !== null){
                $citation->setExplication($obj->explication);
            }
            
            if($obj->auteurs_id !== null){
                $auteur = new AuteurEntity();
                $auteur->setId($obj->auteurs_id);
                $auteur->setAuteur($obj->auteurs_auteur);
                $auteur->setBio($obj->auteurs_bio);
                $auteur->setDate_modif($obj->auteurs_date_modif);
                $citation->setAuteur($auteur);
            }
            
            
            $citations[]=$citation;

        }
        
        return $citations;
    }

    /**
     * Méthode find
     *
     * Description : Récupère un enregistrement en fonction de l'ID.
     * Cette méthode effectue une jointure avec la table "auteurs" pour récupérer l'auteur de la citation.
     *
     * @param int $id L'ID de l'enregistrement à rechercher.
     * @return mixed L'enregistrement correspondant sous forme d'objet de l'entité associée ou faux.
     */
    public function find(int $id)
    {
        $sql = 'SELECT citations.*, 
                    auteurs.id AS auteurs_id, 
                    auteurs.auteur AS auteurs_auteur,
                    auteurs.bio AS auteurs_bio,
                    auteurs.date_modif AS auteurs_date_modif
                FROM citations
                LEFT JOIN auteurs ON citations.auteurs_id = auteurs.id
                WHERE citations.id = ?';

        $q = $this->statement($sql, [$id]);
        //$q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $this->getEntityClassName());

        $data = $q->fetch();
       

        if ($data) {
            $citation = new CitationEntity();
            $citation->setId($data->id);
            $citation->setCitation($data->citation);
            $citation->setDate_modif($data->date_modif);
            $citation->setAuteurs_id($data->auteurs_id);
            if($data->explication !== null){
                $citation->setExplication($data->explication);
            }
            if($data->auteurs_id !== null){ //deux fois que je l'ecris : mériterait une factrorisation
                $auteur = new AuteurEntity();
                $auteur->setId($data->auteurs_id);
                $auteur->setAuteur($data->auteurs_auteur);
                $auteur->setBio($data->auteurs_bio);
                $auteur->setDate_modif($data->auteurs_date_modif);
                $citation->setAuteur($auteur);
            }
            return $citation;
        }

        return false;
    }


    /**
     * Méthode findBy
     * 
     * Description: Récupère des enregistrement Citations en fonction des conditions passées en paramètre
     * Cette méthode effectue une jointure avec la table "auteurs" pour récupérer l'auteur de chaque citation.
     *
     * @param array $conditions
     * @return void
     */
    public function findBy(array $conditions)
    {
        $sql = 'SELECT citations.*, 
                    auteurs.id AS auteurs_id, 
                    auteurs.auteur AS auteurs_auteur,
                    auteurs.bio AS auteurs_bio,
                    auteurs.date_modif AS auteurs_date_modif
                FROM citations
                LEFT JOIN auteurs ON citations.auteurs_id = auteurs.id';

        $champs = [];
        $values = [];

        foreach($conditions as $key=>$value){
            $champs[] = $key . ' = ?';
            $values[] = $value;
        }

        $sql .= ' WHERE ' . implode(' AND ', $champs);

        $q = $this->statement($sql, $values);

        $data = $q->fetchAll();
        $citations = [];

        foreach($data as $obj){ //Et encore une fois répétition. Il faudra vraiment factoriser
            $citation = new CitationEntity();
            $citation->setId($obj->id);
            $citation->setCitation($obj->citation);
            $citation->setDate_modif($obj->date_modif);
            $citation->setAuteurs_id($obj->auteurs_id);
            if($obj->explication !== null){
                $citation->setExplication($obj->explication);
            }
            
            if($obj->auteurs_id !== null){
                $auteur = new AuteurEntity();
                $auteur->setId($obj->auteurs_id);
                $auteur->setAuteur($obj->auteurs_auteur);
                $auteur->setBio($obj->auteurs_bio);
                $auteur->setDate_modif($obj->auteurs_date_modif);
                $citation->setAuteur($auteur);
            }
            
            
            $citations[]=$citation;

        }
        
        return $citations;

    }



    
}
