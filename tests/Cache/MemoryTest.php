<?php

namespace SobanVuex\Config\Tests\Cache;

use SobanVuex\Config\Cache\Memory;

class MemoryTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Memory;
     */
    protected $memory;

    public function setUp()
    {
        $this->memory = new Memory;
    }

    public function testGet()
    {
        $foo = $this->memory->get('foo');
        $this->assertNull($foo);

        $bar = $this->memory->get('bar', true);
        $this->assertTrue($bar);
    }

    public function testSet()
    {
        $this->memory->set('foo', 'bar');
        $this->assertEquals('bar', $this->memory->get('foo'));
    }

    public function testClear()
    {
        $this->memory->set('foo', 'bar');
        $this->memory->set('bar', 'foo');
        $this->memory->clear('foo');
        $this->assertNull($this->memory->get('foo'));
        $this->assertEquals('foo', $this->memory->get('bar'));

        $this->memory->set('foo', 'bar');
        $this->memory->clear();
        $this->assertNull($this->memory->get('foo'));
        $this->assertNull($this->memory->get('bar'));
    }
}
