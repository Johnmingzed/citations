<?php

namespace Core;

/**
 * Classe Autoloader
 * 
 * Cette classe permet de charger automatiquement les classes lorsqu'elles sont utilisées.
 */
class Autoloader
{
    /**
     * Méthode register
     * 
     * Enregistre l'autoloader pour charger automatiquement les classes.
     */
    public static function register()
    {
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    /**
     * Méthode autoload
     * 
     * Charge automatiquement la classe lorsqu'elle est utilisée.
     * 
     * @param string $fqcn Le nom complet de la classe à charger.
     */
    private static function autoload($fqcn)
    {
        $class = $fqcn;

        // Suppression du préfixe du namespace de la classe
        $class = str_replace(__NAMESPACE__ . '\\', '', $class);

        // Construction du chemin vers le fichier de la classe
        $class = __DIR__ . '/' . str_replace("\\", '/', $class) . '.php';

        // Vérification de l'existence du fichier de la classe
        if (file_exists($class)) {
            require_once $class;
        }
    }
}
