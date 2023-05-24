<?php

namespace Core;

use DateTime;

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
        echo 'TEST OK pour la classe Debug::test() <br>';
    }

    public static function dateVerif(mixed $date): DateTime
    {
        if (is_string($date)) {
            $newdate = new Datetime();
            $newdate->setTimestamp(strtotime($date));
            return $newdate;
        }
        if(is_int($date)){
            $newdate = new Datetime();
            $newdate->setTimestamp($date);
            return $newdate;
        }
        return $date;
    }
}
