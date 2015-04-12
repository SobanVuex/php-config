<?php

/**
 * php-config
 *
 * @author    Alex Soban <me@soban.co>
 * @copyright 2015 Alex Soban
 * @link      https://github.com/SobanVuex/php-config
 * @license   https://github.com/SobanVuex/php-config/blob/master/LICENSE
 */

namespace SobanVuex\Config\Cache;

/**
 * Class Memory
 * @package SobanVuex\Config\Cache
 */
class Memory implements CacheInterface
{
    /**
     * Cached key => value entries
     *
     * @var array
     */
    protected $data = [];

    /**
     * {@inheritdoc}
     */
    public function get($key, $default = null)
    {
        if ($this->exists($key)) {
            return $this->data[$key];
        }

        return $default;
    }

    /**
     * {@inheritdoc}
     */
    public function set($key, $value)
    {
        return $this->data[$key] = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function clear($key = null)
    {
        if (null === $key) {
            $this->data = [];
        } elseif ($this->exists($key)) {
            unset($this->data[$key]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function exists($key)
    {
        return array_key_exists($key, $this->data);
    }
}
