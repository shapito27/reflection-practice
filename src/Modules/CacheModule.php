<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 13.06.2018
 * Time: 23:03
 */

namespace Local\Module;

/**
 * Class CacheModule
 * @package Local\Module
 */
class CacheModule
{
    /** @var Storage */
    private $storage;

    /**
     * @param mixed $storage
     */
    public function setStorage(Storage $storage)
    {
        $this->storage = $storage;
    }

}