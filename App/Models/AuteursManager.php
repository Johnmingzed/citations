<?php

namespace App\Models;

use Core\BDD\Manager;

class AuteursManager extends Manager
{
    public function __construct()
    {
        $this->table = 'auteurs';
    }
}
