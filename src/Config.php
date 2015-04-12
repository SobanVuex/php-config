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

use SobanVuex\Config\Cache\CacheInterface;
use SobanVuex\Config\Cache\Memory;
use SobanVuex\Config\Loader\File;
use SobanVuex\Config\Loader\LoaderInterface;

/**
 * Class Config
 * @package SobanVuex\Config
 */
class Config implements ConfigInterface
{
    const SEPARATOR = '.';

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var \SobanVuex\Config\Loader\LoaderInterface
     */
    protected $loader;

    /**
     * @var \SobanVuex\Config\Cache\CacheInterface
     */
    protected $cache;

    /**
     * @param string|array                             $paths
     * @param \SobanVuex\Config\Cache\CacheInterface   $cache
     * @param \SobanVuex\Config\Loader\LoaderInterface $loader
     */
    public function __construct($paths = [], CacheInterface $cache = null, LoaderInterface $loader = null)
    {
        $this->cache = $cache ?: new Memory;
        $this->loader = $loader ?: new File;
        $this->load($paths);
    }

    /**
     * {@inheritdoc}
     */
    public function load($paths)
    {
        $this->loader->read((array) $paths);
        $this->data = array_replace_recursive($this->data, $this->loader->data());
    }

    /**
     * {@inheritdoc}
     */
    public function get($key, $default = null)
    {
        if ($this->cache->exists($key)) {
            return $this->cache->get($key);
        }
        $data = $this->data;
        foreach ($this->split($key) as $path) {
            if (!isset($data[$path])) {
                return $default;
            }
            $data = $data[$path];
        }

        return $this->cache->set($key, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function set($key, $value)
    {
        $data = &$this->data;
        foreach ($this->split($key) as $path) {
            $data = &$data[$path];
        }
        $data = $value;
        $this->cache->set($key, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function clear($key = null)
    {
        if ($key) {
            $data = &$this->data;
            foreach ($this->split($key) as $path) {
                if (!isset($data[$path])) {
                    return;
                }
                $data = &$data[$path];
            }
            unset($data);
        } else {
            $this->data = [];
        }
        $this->cache->clear($key);
    }

    /**
     * {@inheritdoc}
     */
    public function exists($key)
    {
        if ($this->cache->exists($key)) {
            return true;
        }
        $data = $this->data;
        foreach ($this->split($key) as $path) {
            if (!isset($data[$path])) {
                return false;
            }
            $data = $data[$path];
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isTrue($key)
    {
        return $this->exists($key) && $this->get($key) === true;
    }

    /**
     * {@inheritdoc}
     */
    public function isFalse($key)
    {
        return $this->exists($key) && $this->get($key) === false;
    }

    /**
     * {@inheritdoc}
     */
    public function isNull($key)
    {
        return $this->exists($key) && $this->get($key) === null;
    }

    /**
     * @param $path
     *
     * @return array
     */
    protected function split($path)
    {
        return explode(static::SEPARATOR, $path);
    }
}
