<?php

/**
 * php-config
 *
 * @author    Alex Soban <me@soban.co>
 * @copyright 2015 Alex Soban
 * @link      https://github.com/SobanVuex/php-config
 * @license   https://github.com/SobanVuex/php-config/blob/master/LICENSE
 */

namespace SobanVuex\Config\Loader;

/**
 * Interface LoaderInterface
 * @package SobanVuex\Config\Loader
 */
interface LoaderInterface
{

    /**
     * @param array $paths
     */
    public function read(array $paths);

    /**
     * @return array
     */
    public function data();
}
