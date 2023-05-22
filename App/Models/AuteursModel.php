<?php

namespace App\Models;

use Core\BDD\Model;

class AuteursModel extends Model
{
    public function __construct()
    {
        $this->db = parent::getInstance();
        $this->table = 'auteurs';
    }
}
