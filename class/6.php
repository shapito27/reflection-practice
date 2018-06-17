<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 12.06.2018
 * Time: 14:03
 */
require_once dirname(__DIR__) . '/vendor/autoload.php';

/**
 * Modules runner. Modules DataBase, Cache, etc. Modules will be stored in xml file
 */
$moduleRunner = new \Local\Module\ModuleRunner();
$moduleRunner->init();