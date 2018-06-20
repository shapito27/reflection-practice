<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 12.06.2018
 * Time: 14:03
 */
require_once dirname(__DIR__) . '/vendor/autoload.php';

/**
 * Get info about method's params
 */

/**
 * @param ReflectionParameter $arg
 * @return string
 */
function getMethodsParams(ReflectionParameter $arg): string
{
    $paramName = $arg->getName();
    $info = "$$paramName param ";
    $paramMethodInClass = $arg->getDeclaringClass();
    $paramInMethod = $arg->getDeclaringFunction();
    $paramPosition = $arg->getPosition();
    $info .= "on " . $paramPosition . " position in method {$paramInMethod->getName()} of class {$paramMethodInClass->getName()} ";
    $paramTypeClass = $arg->getClass();
    if(!empty($paramTypeClass)){
        $info .= "$$paramName have to be instance of " . $paramTypeClass . "\n";
    }else{
        $info .= "$$paramName type is " . $arg->getType() . "\n";
    }
    if($arg->isPassedByReference()){
        $info .= "$$paramName passed by reference " . "\n";
    }
    if($arg->isDefaultValueAvailable()){
        $defValue = $arg->getDefaultValue();
        $info .= "$$paramName by default equal " . $defValue . "\n";
    }

    return $info;
}


//getting class
$class = new ReflectionClass('Local\\Utils');
//getting method
$classMethod = $class->getMethod('lowerCase');
//getting parameters of method
$methodParametrs = $classMethod->getParameters();
foreach ($methodParametrs as $parameter){
    db(getMethodsParams($parameter));
}

//getting class
$class = new ReflectionClass('Local\\DataBase');
//getting method
$classMethod = $class->getMethod('setConfig');
//getting parameters of method
$methodParametrs = $classMethod->getParameters();
foreach ($methodParametrs as $parameter){
    db(getMethodsParams($parameter));
}