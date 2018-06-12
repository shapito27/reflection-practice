<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 12.06.2018
 * Time: 14:39
 */
if(!function_exists('d')){
    function d($var = null, $tittle = null){
        print_r($tittle);
        Symfony\Component\VarDumper\VarDumper::dump($var);
    }
}
if(!function_exists('dd')){
    function dd($var = null, $tittle = null){
        print_r($tittle);
        d($var);
    }
}