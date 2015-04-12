<?php

/**
 * php-config
 *
 * @author    Alex Soban <me@soban.co>
 * @copyright 2015 Alex Soban
 * @link      https://github.com/SobanVuex/php-config
 * @license   https://github.com/SobanVuex/php-config/blob/master/LICENSE
 */

namespace SobanVuex\Config\Exception;

/**
 * Class FileNotFoundException
 * @package SobanVuex\Config\Exception
 */
class FileNotFoundException extends \Exception
{

    /**
     * @var string
     */
    protected $path;

    /**
     * @param string     $path
     * @param int        $code
     * @param \Exception $previous
     */
    public function __construct($path, $code = 0, \Exception $previous = null)
    {
        $this->path = $path;
        parent::__construct('File not found at path: ' . $this->getPath(), $code, $previous);
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

}
