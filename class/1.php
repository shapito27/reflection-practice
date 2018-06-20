<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 12.06.2018
 * Time: 14:03
 */
require_once dirname(__DIR__) . '/vendor/autoload.php';

/**
 * Get infornmation about class
 */
$mysql = new \Local\MySql('main_db');
$class = new ReflectionClass($mysql);
db(Reflection::export($class, true));