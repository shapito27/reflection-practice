<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 12.06.2018
 * Time: 15:14
 */

namespace Local;

/**
 * Interface Cacheable
 * @package Local
 */
interface Cacheable
{
    /**
     * @return mixed
     */
    public function getKey();
}