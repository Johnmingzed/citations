<?php

namespace Core;

/**
 * Classe Debug
 *
 * Cette classe fournit des méthodes utilitaires pour le débogage et l'affichage de variables.
 */
class Debug
{
    /**
     * Méthode var_dump
     *
     * Affiche le contenu d'une ou plusieurs variables en utilisant la fonction var_dump de PHP.
     *
     * @param mixed ...$param Les variables à afficher.
     */
    public static function var_dump(...$param)
    {
        echo '<pre>';
        var_dump(...$param);
        echo '</pre>';
    }

    /**
     * Méthode print_r
     *
     * Affiche le contenu d'un tableau en utilisant la fonction print_r de PHP.
     *
     * @param array $data Le tableau à afficher.
     */
    public static function print_r(array $data)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
}
