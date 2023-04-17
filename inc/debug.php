<?php

/**
 * Fonctions de debugage
 */

/**
 * Retourne une variable formaté pour plus de lisibilité
 * 
 * @param array $data
 * @return void
 */

function debug(array $data)
{
   echo '<pre>';
   print_r($data);
   echo '</pre>';
}
