<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 13.06.2018
 * Time: 23:03
 */

namespace Local\Module;

/**
 * Class SessionModule
 * @package Local\Module
 */
class SessionModule implements Module
{
    /** @var int */
    private $lifeTime;

    /**
     * @param int $lifeTime
     */
    private function setLifeTime(int $lifeTime){
        if($lifeTime<=0){
            throw new \UnexpectedValueException('Wrong value of session life time');
        }

        $this->lifeTime = $lifeTime;
    }
}