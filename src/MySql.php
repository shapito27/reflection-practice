<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 12.06.2018
 * Time: 14:15
 */

namespace Local;


class MySql extends DataBase
{
    /** @var string */
    public $version;
    /** @var string */
    public $dataBaseName;
    /** @var string  */
    const NAME = 'MYSQL';

    public function __construct(string $dataBaseName)
    {
        $this->dataBaseName = $dataBaseName;
    }
}