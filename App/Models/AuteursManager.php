<?php

namespace App\Models;

use Core\BDD\Manager;
use DateTime;

class AuteursManager extends Manager
{
    public function __construct()
    {
        $this->table = 'auteurs';
    }

    public function add(Auteur $auteur): Auteur
    {
        //$addId = $auteur->getId();
        $add = [];
        $add['auteur'] = $auteur->getAuteur();
        $add['bio'] = $auteur->getBio();
        $id = $this->create($add);
        $date = $this->findById($id);
        $auteur->setId($id);
        $auteur->setDate_Modif($date->date_modif);
        return $auteur;
    }
}
