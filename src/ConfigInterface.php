<?php

/**
 * php-config
 *
 * @author    Alex Soban <me@soban.co>
 * @copyright 2015 Alex Soban
 * @link      https://github.com/SobanVuex/php-config
 * @license   https://github.com/SobanVuex/php-config/blob/master/LICENSE
 */

namespace SobanVuex\Config;

/**
 * Interface ConfigInterface
 * @package SobanVuex\Config
 */
interface ConfigInterface
{

    /**
     * @param string|array $paths
     *
     */
    public function load($paths);

    /**
     * @param string $key
     * @param mixed  $default
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
     *
     * @return bool
     */
    public function clear($key = null);

    /**
     * @param string $key
     *
     * @return bool
     */
    public function exists($key);

    /**
     * @param string $key
     *
     * @return bool
     */
    public function isTrue($key);

    /**
     * @param string $key
     *
     * @return bool
     */
    public function isFalse($key);

    /**
     * @param string $key
     *
     * @return bool
     */
    public function isNull($key);
}
