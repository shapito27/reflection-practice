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

    /**
     * ModuleRunner constructor
     * @throws Exception
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
        if ($this->config === null) {
            throw new Exception('Config invalid.');
        }
    }

    /**
     * initialization modules by parameters received from config
     * @throws \ReflectionException
     */
    public function init()
    {

        if (empty($this->config)) {
            throw new Exception('Config file is empty.');
        }

        foreach ($this->config as $className => $classParams) {
            $interface = new ReflectionClass(Module::class);
            $class = new ReflectionClass($className);

            if (!$class->isSubclassOf($interface)) {
                throw new Exception("$className is not module");
            }

            if (!$class->isInstantiable()) {
                throw new Exception("Class is not instantiable");
            }

            $constructor = $class->getConstructor();

            if ($constructor->getNumberOfRequiredParameters() > 0) {
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
                    $this->handleSetMethod($newModule, $currentMethod, $methodParams);
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
     * @throws \ReflectionException
     */
    private function handleSetMethod(Module $module, ReflectionMethod $method, $param)
    {
        /** @var ReflectionParameter[] $args */
        $args = $method->getParameters();
        $argClass = $args[0]->getClass();

        if (!empty($argClass)) {
            $newParam = new ReflectionClass($argClass);
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
    }
}