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

use SobanVuex\Config\Exception\FileNotFoundException;
use SobanVuex\Config\Exception\InvalidFormatException;

/**
 * Class File
 * @package SobanVuex\Config\Loader
 */
class File implements LoaderInterface
{
    /**
     * @var array
     */
    protected $files = [];

    /**
     * @var array
     */
    protected $adapters = [
        '\\SobanVuex\\Config\\Loader\\Adapter\\Ini' => ['ini'],
        '\\SobanVuex\\Config\\Loader\\Adapter\\Json' => ['json'],
        '\\SobanVuex\\Config\\Loader\\Adapter\\Php' => ['php'],
        '\\SobanVuex\\Config\\Loader\\Adapter\\Yaml' => ['yml', 'yaml'],

    ];

    /**
     * @param string $extension
     *
     * @return string
     * @throws \SobanVuex\Config\Exception\InvalidFormatException
     */
    protected function getAdapter($extension)
    {
        foreach ($this->adapters as $adapter => $extensions) {
            if (in_array($extension, $extensions)) {
                return $adapter;
            }
        }

        throw new InvalidFormatException($extension);
    }

    /**
     * @param string $path
     *
     * @return array
     */
    protected function readDirectory($path)
    {
        $paths = [];
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator(
                $path,
                \FilesystemIterator::SKIP_DOTS
            ),
            \RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($iterator as $file) {
            if (!$file->isFile()) {
                continue;
            }
            $paths[] = $file->getRealPath();
        }

        return $paths;
    }

    /**
     * {@inheritdoc}
     */
    public function read(array $paths)
    {
        $this->files = [];

        foreach ($paths as $path) {
            $path = realpath($path);
            if (!file_exists($path)) {
                throw new FileNotFoundException($path);
            } elseif (is_dir($path)) {
                $this->read($this->readDirectory($path));
                continue;
            }

            $extension = pathinfo($path, PATHINFO_EXTENSION);
            $adapter = $this->getAdapter($extension);
            $this->files[$path] = new $adapter($path);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function data()
    {
        $data = [];
        foreach ($this->files as $file) {
            $data = array_replace_recursive($data, $file->data());
        }

        return $data;
    }
}
