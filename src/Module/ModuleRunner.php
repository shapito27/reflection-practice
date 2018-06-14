<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 12.06.2018
 * Time: 23:32
 */

namespace Local\Module;

/**
 * Class ModuleRunner
 * @package Local\Module
 */
class ModuleRunner
{
    /** @var Module[] */
    private $modules;

    /** @var array */
    private $config;

    /**
     * ModuleRunner constructor
     */
    public function __construct()
    {
        $this->loadConfig();
    }

    /**
     *
     */
    private function loadConfig()
    {
        $config = file_get_contents(dirname(dirname(__DIR__)) . '/class/6.json');
        $this->config = json_decode($config, true);
    }
}