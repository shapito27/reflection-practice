<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 13.06.2018
 * Time: 23:04
 */

namespace Local\Module;

use Local\DataBase;

/**
 * Class DataBaseModule
 * @package Local\Module
 */
class DataBaseModule implements Module
{
    /** @var DataBase */
    private $database;

    /**
     * @param DataBase $database
     */
    public function setDatabase(DataBase $database)
    {
        $this->database = $database;
    }
}