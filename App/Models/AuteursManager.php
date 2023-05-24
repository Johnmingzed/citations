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
        $add = $this::prepareObject($auteur);
        $id = $this->create($add);
        $date = $this->findById($id);
        $auteur->setId($id);
        $auteur->setDate_Modif($date->date_modif);
        return $auteur;
    }

    public function display(int $id): Auteur
    {
        $data = $this->findById($id);
        $auteur = new Auteur($data);
        return $auteur();
    }

    public function destroy(Auteur $auteur): bool
    {
        $id = $auteur->getId();
        $this->delete($id);
        return true;
    }

    public function modify(Auteur $auteur): Auteur
    {
        $id = $auteur->getId();
        $modify = $this::prepareObject($auteur);
        $this->update($id, $modify);
        $date = $this->findById($id);
        $auteur->setDate_Modif($date->date_modif);
        return $auteur;
    }

    private static function prepareObject(Auteur $auteur): array
    {
        $prepare = [];
        $prepare['auteur'] = $auteur->getAuteur();
        $prepare['bio'] = $auteur->getBio();
        return $prepare;
    }
}
