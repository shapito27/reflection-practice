<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 13.06.2018
 * Time: 23:04
 */

namespace Local\Module;

use Local\MySql;

/**
 * Class DataBaseModule
 * @package Local\Module
 */
class MySqlModule implements Module
{
    private $database;

    public function setDatabase(MySql $database)
    {
        $this->database = $database;
    }
}