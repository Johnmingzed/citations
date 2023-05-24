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

$datas = ['auteur' => 'Jonathan', 'bio' => 'Développeur'];
$modifications = ['auteur' => 'Jonathan PAIN-CHAMMING\'S', 'bio' => 'Développeur en formation'];
dump('data', $datas);
$jonathan = new Auteur($datas);
$manager = new AuteursManager;
dump('add', $manager->add($jonathan));
dump('destroy', $manager->destroy($jonathan));
dump('display', $manager->display(2));
// $manager->modify($jonathan);


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
