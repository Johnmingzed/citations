<?php

use App\Autoloader as AppAutoloader;
use App\Models\AuteursManager;
use App\Models\Auteur;
use Core\Autoloader as CoreAutoloader;
use Core\Debug;
use Core\BDD\Database;
use Core\BDD\Manager;

define('ROOT', dirname(__DIR__));
require_once ROOT . '/conf/constantes.php';

// Autoloaders
require_once ROOT . '/vendor/autoload.php';
require_once ROOT . '/App/Autoloader.php';
AppAutoloader::register();
require_once ROOT . '/Core/Autoloader.php';
CoreAutoloader::register();

$now = new DateTime;
$datas = ['id' => 1, 'date_modif' => $now, 'auteur' => 'Jonathan', 'bio' => 'Développeur'];
$datas = ['auteur' => 'Jonathan', 'bio' => 'Développeur'];
dump($datas);
$jonathan = new Auteur($datas);
dump($jonathan);
$manager = new AuteursManager;
$manager->add($jonathan);
dump($jonathan);


die('Fin du script');



/******************************************************************************************

// Tests unitaires sur AuteursManager
$auteurs = new AuteursManager;
echo 'Test de findAll :';
dump($auteurs->findAll());
echo 'Test de findById(1) :';
dump($auteurs->findById(1));
echo 'Test de create :';
$macron = new Auteur(['auteur' => 'Macron', 'bio' => 'CEO de la France']);
dump($auteurs->create($macron));
echo 'Test de findBy :';
$test = $auteurs->findBy(['auteur' => 'Macron']);
dump($test);
$testId = $test[0]->id;
echo 'Test de update :';
dump($auteurs->update(['id' => $testId, 'auteur' => 'Macron 1er', 'bio' => 'Un sacré fils de pute']));
echo 'Test de delete :';
dump($auteurs->delete($testId));

 */
