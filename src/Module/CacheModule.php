<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 13.06.2018
 * Time: 23:03
 */

namespace Local\Module;

use Local\Storage;

/**
 * Class CacheModule
 * @package Local\Module
 */
class CacheModule implements Module
{
    /** @var Storage */
    private $storage;

    /**
     * @param mixed $storage
     */
    public function setStorage(string $storage)
    {
        $this->storage = $storage;
    }

}