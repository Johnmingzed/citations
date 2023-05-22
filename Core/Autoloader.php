<?php

namespace Core;

class Autoloader
{
    public static function register()
    {
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    private static function autoload($fqcn)
    {
        $class = $fqcn;
        $class = __DIR__;
        $class .= str_replace(__NAMESPACE__ . '\\', '', $class);
        $class .= '.php';
        if (file_exists($class)) {
            require_once $class;
        }
    }
}
