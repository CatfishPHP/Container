<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use Catfish\Container\Container;
use Catfish\Container\Exceptions\NotFoundException;

class ContainerTest extends TestCase
{
    public function testCreateContainer()
    {
        $container = new Container();
        $this->assertInstanceOf(Container::class, $container);
    }

    public function testSetGetScalarFromContainer()
    {
        unset($GLOBALS['di']);
        $value = 123;

        $container = new Container();
        $container->add('wat', $value);
        $this->assertSame(
            $value,
            $container->get('wat')
        );
    }

    public function testSetGetClosure()
    {
        unset($GLOBALS['di']);
        $value = 123;
        $closure = function () use ($value) {
            return $value;
        };
        $container = new Container();
        $container->add('wat', $closure);
        $this->assertSame(
            $value,
            $container->get('wat')
        );
    }

    public function testExceptionThrownWhenItemNotFound()
    {
        unset($GLOBALS['di']);
        $this->expectException(NotFoundException::class);
        $container = new Container();
        $container->get('wat');
    }
}
