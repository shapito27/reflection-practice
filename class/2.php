<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 12.06.2018
 * Time: 14:03
 */
require_once dirname(__DIR__) . '/vendor/autoload.php';

/**
 * Check type of class and can we make its instance
 */
function getClassTypeInfo(ReflectionClass $class)
{
    $className = $class->getName();
    $info = $className . "\n";

    /**
     * check if user defined
     */
    if ($class->isUserDefined()) {
        $info .= " - user defined\n";
    }

    /**
     * check if internal class
     */
    if ($class->isInternal()) {
        $info .= " - internal class\n";
    }

    /**
     * check if abstract
     */
    if ($class->isAbstract()) {
        $info .= " - abstract class\n";
    }

    /**
     * check if clonable class
     */
    if ($class->isCloneable()) {
        $info .= " - can clone class\n";
    }

    /**
     * check if final class
     */
    if ($class->isFinal()) {
        $info .= " - can't extend class\n";
    }

    /**
     * check if interface class
     */
    if ($class->isInterface()) {
        $info .= " - is interface\n";
    }

    /**
     * check if trait
     */
    if ($class->isTrait()) {
        $info .= " - is trait\n";
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
    // getting reflection of class
    $class = new ReflectionClass($classWithNameSpase);
    d(getClassTypeInfo($class));
}

// internal class example
$class = new ReflectionClass('stdClass');
d(getClassTypeInfo($class));

