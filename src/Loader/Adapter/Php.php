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

use SobanVuex\Config\Exception\InvalidFormatException;
use SobanVuex\Config\Exception\ParseException;

/**
 * Class Php
 * @package SobanVuex\Config\Loader\Adapter
 */
class Php implements AdapterInterface
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @param string $path
     *
     * @throws \SobanVuex\Config\Exception\InvalidFormatException
     * @throws \SobanVuex\Config\Exception\ParseException
     */
    public function __construct($path)
    {
        try {
            $this->data = require $path;
        } catch (\Exception $e) {
            throw new ParseException($path);
        }

        if (empty($this->data)) {
            throw new ParseException($path);
        } elseif (!is_array($this->data)) {
            throw new InvalidFormatException($path);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function data()
    {
        return $this->data;
    }

}
