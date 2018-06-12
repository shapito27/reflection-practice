<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 12.06.2018
 * Time: 14:14
 */

namespace Local;

/**
 * Class DataBase
 * @package Local
 */
abstract class DataBase implements Cacheable
{
    private $connection;
    private $config;

    /** @var string */
    private $key;

    /**
     * @return mixed
     */
    public function getKey(): string
    {
        return $this->key;
    }
}