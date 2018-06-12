<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 12.06.2018
 * Time: 15:12
 */

namespace Local;


trait Utils
{
    public function lowerCase(string $str): string
    {
        return strtolower($str);
    }
}