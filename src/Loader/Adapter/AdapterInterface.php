<?php

/**
 * php-config
 *
 * @author    Alex Soban <me@soban.co>
 * @copyright 2015 Alex Soban
 * @link      https://github.com/SobanVuex/php-config
 * @license   https://github.com/SobanVuex/php-config/blob/master/LICENSE
 */

namespace SobanVuex\Config\Loader\Adapter;

/**
 * Interface AdapterInterface
 * @package SobanVuex\Config\Loader\Adapter
 */
interface AdapterInterface
{

    /**
     * @return array
     */
    public function data();
}
