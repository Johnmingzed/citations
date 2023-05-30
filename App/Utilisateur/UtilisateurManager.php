<?php

namespace App\Utilisateur;
use Core\Database\Manager;

class UtilisateurManager extends Manager
{
    public function __construct(){
        $this->table = 'utilisateurs';
    }
}