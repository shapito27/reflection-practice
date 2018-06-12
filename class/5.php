<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 12.06.2018
 * Time: 14:03
 */
require_once dirname(__DIR__) . '/vendor/autoload.php';

/**
 * Get source code of Class's methods
 */

/**
 * @param ReflectionMethod $method
 * @return string
 */
function getClassMethodsCode(ReflectionMethod $method): string
{
    /** @var string $methodFileName getting file path */
    $methodFileName = $method->getFileName();

    $startCodeLine = $method->getStartLine();
    $endCodeLine = $method->getEndLine();

    /** @var array $lines lines of source code */
    $lines = file($methodFileName);

    return implode("", array_slice($lines, $startCodeLine - 1, $endCodeLine - $startCodeLine + 1));
}

/**
 * get method PHPDoc comments
 * @param ReflectionMethod $method
 * @return string
 */
function getClassMethodDocComment(ReflectionMethod $method): string
{
    return $method->getDocComment();
}

//getting class methods source code
$class = new ReflectionClass('Local\\DataBase');
$classMethods = $class->getMethods();
foreach ($classMethods as $method) {
    //getting comment class method source code
    d(getClassMethodDocComment($method));
    d(getClassMethodsCode($method));
}