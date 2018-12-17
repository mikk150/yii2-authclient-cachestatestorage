<?php

namespace mikk150\authclient\statestorage;

use yii\authclient\StateStorageInterface;
use yii\base\Component;
use yii\caching\Cache;
use yii\di\Instance;

/**
 * @{inheritdoc}
 */
class CacheStateStorage extends Component implements StateStorageInterface
{
    /**
     * @var Cache|array|string
     */
    public $cache = 'cache';

    /**
     * For how long StateStorage should last
     *
     * @var integer
     */
    public $duration = 600;

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->cache = Instance::ensure($this->cache, Cache::class);
    }

    /**
     * Adds a state variable.
     * If the specified name already exists, the old value will be overwritten.
     * @param string $key variable name
     * @param mixed $value variable value
     */
    public function set($key, $value)
    {
        $this->cache->set([self::class, $key], $value, $this->duration);
    }

    /**
     * Returns the state variable value with the variable name.
     * If the variable does not exist, the `$defaultValue` will be returned.
     * @param string $key the variable name
     * @return mixed the variable value, or `null` if the variable does not exist.
     */
    public function get($key)
    {
        return $this->cache->get([self::class, $key]);
    }

    /**
     * Removes a state variable.
     * @param string $key the name of the variable to be removed
     * @return bool success.
     */
    public function remove($key)
    {
        return $this->cache->delete([self::class, $key]);
    }
}
