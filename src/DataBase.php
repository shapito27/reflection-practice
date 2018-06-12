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
abstract class DataBase implements Cacheable, Configurable
{
    private $connection;

    /** @var Config */
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

    /**
     * @return mixed
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @param $connection
     */
    public function setConnection($connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return Config
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param Config $config
     */
    public function setConfig(Config $config)
    {
        $this->config = $config;
    }

    /**
     *
     */
    private function destroyConnection()
    {
        $this->connection = null;
    }
}