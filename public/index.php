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
$model = new Model;
echo 'Test de findAll :';
dump($auteurs->findAll());
echo 'Test de findById(1) :';
dump($auteurs->findById(1));
echo 'Test de create :';
dump($auteurs->create(['auteur' => 'Macron', 'bio' => 'CEO de la France']));
echo 'Test de findBy :';
$test = $model->findBy(['auteur' => 'Macron']);
dump($test);
$testId = $test[0]->id;
echo 'Test de update :';
dump($auteurs->update(['id' => $testId, 'auteur' => 'Macron 1er', 'bio' => 'Un sacré fils de pute']));
echo 'Test de delete :';
dump($model->delete($testId));
