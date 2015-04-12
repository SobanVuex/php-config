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
 * Class InvalidFormatException
 * @package SobanVuex\Config\Exception
 */
class InvalidFormatException extends \Exception
{

    /**
     * @var string
     */
    protected $extension;

    /**
     * @param string     $extension
     * @param int        $code
     * @param \Exception $previous
     */
    public function __construct($extension, $code = 0, \Exception $previous = null)
    {
        $this->extension = $extension;
        parent::__construct('Invalid file format: ' . $this->getExtension(), $code, $previous);
    }

    /**
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

}
