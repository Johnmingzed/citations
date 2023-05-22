<?php

namespace Core;

class Debug
{
    public static function print_r(array $array): void
    {
        echo '<pre>';
        echo print_r($array);
        echo '</pre>';
    }

    public static function test(): void
    {
        echo 'TEST OK';
    }
}
