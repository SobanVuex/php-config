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

use SobanVuex\Config\Exception\ParseException;

/**
 * Class Ini
 * @package SobanVuex\Config\Loader\Adapter
 */
class Ini implements AdapterInterface
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @param string $path
     *
     * @throws \SobanVuex\Config\Exception\ParseException
     */
    public function __construct($path)
    {
        $this->data = @parse_ini_file($path);

        if (empty($this->data)) {
            throw new ParseException($path);
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
