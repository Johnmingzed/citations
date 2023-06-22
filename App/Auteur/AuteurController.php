<?php

namespace App\Auteur;

use Core\Controller;


class AuteurController extends Controller
{
    protected string $title='Les auteurs';

    public function ajouter()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $compact = [
                'title' => 'Ajouter un auteur',
                'data' => []
            ];
            $this->render($compact, 'ajouter.php');
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $compact = [
                'title' => 'Ajouter un auteur',
                'data' => []
            ];
            $this->render($compact, 'ajouter.php');
        }
    }
}
