<?php

namespace App;

class Autoloader
{
    public static function register()
    {
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    private static function autoload($fqcn)
    {
        $class = $fqcn;
        $class = str_replace(__NAMESPACE__ . '\\', '', $class);
        $class = __DIR__ . '/' .  str_replace('\\', '/', $class) . '.php';
        if (file_exists($class)) {
            require_once $class;
        }
    }
}
