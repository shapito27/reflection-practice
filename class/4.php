<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 12.06.2018
 * Time: 14:03
 */
require_once dirname(__DIR__) . '/vendor/autoload.php';

/**
 * Check type of class methods
 */

/**
 * @param ReflectionMethod $method
 * @return string
 */
function getMethodTypeInfo(ReflectionMethod $method): string
{
    $methodName = $method->getName();
    $info = $methodName . "\n";

    /**
     * check if user defined
     */
    if ($method->isUserDefined()) {
        $info .= " - user defined\n";
    }

    /**
     * check if internal method
     */
    if ($method->isInternal()) {
        $info .= " - internal method\n";
    }

    /**
     * check if abstract
     */
    if ($method->isAbstract()) {
        $info .= " - abstract method\n";
    }

    /**
     * check if public method
     */
    if ($method->isPublic()) {
        $info .= " - public method\n";
    }


    /**
     * check if protected method
     */
    if ($method->isProtected()) {
        $info .= " - protected method\n";
    }

    /**
     * check if private method
     */
    if ($method->isPrivate()) {
        $info .= " - private method\n";
    }

    /**
     * check if final method
     */
    if ($method->isFinal()) {
        $info .= " - final method\n";
    }

    /**
     * check if constructor
     */
    if ($method->isConstructor()) {
        $info .= " - constructor\n";
    }

    /**
     * check if method return reference
     */
    if ($method->returnsReference()) {
        $info .= " - returns reference\n";
    }

    $info .= "\n";

    return $info;
}

$classList = [
    'Cacheable',
    'Database',
    'MySql',
    'Oracle',
    'Utils',
];

foreach ($classList as $class) {
    // adding namespace before classname
    $classWithNameSpase = 'Local\\' . $class;
    d('Class ' . $classWithNameSpase . '. Methods:\n');
    // getting reflection of class
    $class = new ReflectionClass($classWithNameSpase);
    $classMethods = $class->getMethods();
    foreach ($classMethods as $method) {
        //getting type class method
        d(getMethodTypeInfo($method));
    }
    d('Class ' . $classWithNameSpase . '. End\n\n\n');
}