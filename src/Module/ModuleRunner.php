<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 12.06.2018
 * Time: 23:32
 */

namespace Local\Module;

use ReflectionClass;
use Exception;
use ReflectionMethod;
use ReflectionParameter;

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

    /** @var string */
    const SET_PREFIX = 'set';

    /** @var string */
    const MODULE_POSTFIX = 'Module';

    /** @var string */
    const NAMESPACE_MODULE_PREFIX = '\\Local\\Module\\';

    /** @var string */
    const CONFIG_PATH = '/class/6.json';

    /**
     * ModuleRunner constructor
     * @throws Exception
     */
    public function __construct()
    {
        $this->loadConfig();
        $this->modules = [];
    }

    /**
     * Load config from json file
     * @throws Exception
     */
    private function loadConfig()
    {
        $config = file_get_contents(dirname(dirname(__DIR__)) . self::CONFIG_PATH);
        $this->config = json_decode($config, true);
        if ($this->config === null) {
            throw new Exception('Config invalid.');
        }
    }

    /**
     * initialization modules by parameters received from config
     * @throws \ReflectionException
     * @throws Exception
     */
    public function init()
    {
        if (empty($this->config)) {
            throw new Exception('Config file is empty.');
        }

        foreach ($this->config as $className => $classParams) {
            $className = self::NAMESPACE_MODULE_PREFIX . $className . self::MODULE_POSTFIX;

            $interface = new ReflectionClass(Module::class);
            $class = new ReflectionClass($className);

            if (!$class->isSubclassOf($interface)) {
                throw new Exception("$className is not module");
            }

            if (!$class->isInstantiable()) {
                throw new Exception("Class is not instantiable");
            }

            $constructor = $class->getConstructor();

            if ($constructor && $constructor->getNumberOfRequiredParameters() > 0) {
                throw new Exception("Constructor has required parameters");
            }

            /** @var Module $newModule */
            $newModule = $class->newInstance();

            $newModuleMethods = $class->getMethods();
            /** @var array $mappedNewModuleMethods mapping module methods name and ReflectionMethod for convenience */
            $mappedNewModuleMethods = [];

            foreach ($newModuleMethods as $method) {
                $mappedNewModuleMethods[$method->getName()] = $method;
            }
            foreach ($classParams as $method => $methodParams) {
                /** @var ReflectionMethod $currentMethod */
                $currentMethod = $mappedNewModuleMethods[self::SET_PREFIX . $method];
                if ($currentMethod !== null && $currentMethod->isPublic()) {
                    $newModule = $this->handleSetMethod($newModule, $currentMethod, $methodParams);
                    array_push($this->modules, $newModule);
                }
            }
        }
    }

    /**
     * run given method with given params
     * @param Module $module
     * @param ReflectionMethod $method
     * @param $param
     * @return Module
     * @throws \ReflectionException
     * @throws Exception
     */
    private function handleSetMethod(Module $module, ReflectionMethod $method, $param): Module
    {
        /** @var ReflectionParameter $arg */
        $arg = $method->getParameters()[0];
        $argClass = $arg->getClass();

        if ($argClass !== null) {
            $newParam = new ReflectionClass($argClass->getName());
            if (!$newParam->isInstantiable()) {
                throw new Exception("Param given in config for {($module::class)} not Instantiable.");
            }

            $constructor = $newParam->getConstructor();

            if ($constructor->getNumberOfParameters() > 0 && $constructor->getNumberOfRequiredParameters() == 1) {
                $param = $newParam->newInstance($param);
            } else {
                if ($constructor->getNumberOfParameters() === 0 || $constructor->getNumberOfRequiredParameters() > 1) {
                    throw new Exception("Param given in config for {($module::class)} have Constructor with different number of parameters.");
                }
            }
        }
        $method->invoke($module, $param);

        return $module;
    }

    /**
     * Some function for process module
     */
    public function execute()
    {
        foreach ($this->modules as $module) {
            d($module);
        }
    }
}