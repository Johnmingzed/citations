<?php

use App\Autoloader as AppAutoloader;
use App\Models\AuteursModel;
use Core\Autoloader as CoreAutoloader;
use Core\Debug;
use Core\BDD\Database;
use Core\BDD\Model;

define('ROOT', dirname(__DIR__));
require_once ROOT . '/conf/constantes.php';

// Autoloaders
require_once ROOT . '/vendor/autoload.php';
require_once ROOT . '/App/Autoloader.php';
AppAutoloader::register();
require_once ROOT . '/Core/Autoloader.php';
CoreAutoloader::register();


$auteurs = new AuteursModel;
dump($auteurs->findAll());

// Test de fonctionnement de Database
$model = new Model;
dump($model->findBy(['id' => 2]));