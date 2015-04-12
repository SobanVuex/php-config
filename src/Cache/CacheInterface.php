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
 * Interface CacheInterface
 * @package SobanVuex\Config\Cache
 */
interface CacheInterface
{
    /**
     * @param string $key
     * @param null   $default
     *
     * @return mixed
     */
    public function get($key, $default = null);

    /**
     * @param string $key
     * @param mixed  $value
     */
    public function set($key, $value);

    /**
     * @param string|null $key
     */
    public function clear($key = null);

    /**
     * @param string $key
     *
     * @return bool
     */
    public function exists($key);
}
