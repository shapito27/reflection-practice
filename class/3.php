<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 12.06.2018
 * Time: 14:03
 */
require_once dirname(__DIR__) . '/vendor/autoload.php';

/**
 * Get source code of Class
 */

/**
 * @param ReflectionClass $class
 * @return string
 */
function getClassCode(ReflectionClass $class): string
{
    /** @var string $classFileName getting file path */
    $classFileName = $class->getFileName();

    $startCodeLine = $class->getStartLine();
    $endCodeLine = $class->getEndLine();

    /** @var array $lines lines of source code */
    $lines = file($classFileName);

    return implode("", array_slice($lines, $startCodeLine - 1, $endCodeLine - $startCodeLine + 1));
}

/**
 * get class PHPDoc comments
 * @param ReflectionClass $class
 * @return string
 */
function getClassDocComment(ReflectionClass $class): string
{
    return $class->getDocComment();
}

//getting class source code
$class = new ReflectionClass('Local\\DataBase');
$classSourceCode = getClassCode($class);
d($classSourceCode);

// getting class doc comment
$classComments = getClassDocComment($class);
d($classComments);