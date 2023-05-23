<?php

namespace App\Models;

use Core\BDD\Model;

class AuteursModel extends Model
{
    public function __construct()
    {
        $this->table = 'auteurs';
    }
}
