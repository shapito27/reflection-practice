<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 12.06.2018
 * Time: 15:14
 */

namespace Local;


interface Configurable
{
    public function setConfig(Config $config);
    public function getConfig();
}