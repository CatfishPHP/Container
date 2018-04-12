<?php
namespace Catfish\Container;

use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Catfish\Container\Exceptions\NotFoundException;
use Tightenco\Collect\Support\Collection;

class Container implements ContainerInterface, \ArrayAccess
{
    /**
     * Container constructor.
     */
    public function __construct()
    {
        if (! array_key_exists('di', $GLOBALS)) {
            $this->init();
        }
    }

    /**
     * Initialize the container
     */
    protected function init()
    {
        $GLOBALS['di'] = collect(['singleton' => []]);
    }

    /**
     * @return Collection
     */
    public function getContainer(): Collection
    {
        if (! array_key_exists('di', $GLOBALS)) {
            $this->init();
        }

        return $GLOBALS['di'];
    }

    /**
     * @param string $id
     *
     * @throws NotFoundExceptionInterface
     * @return mixed Entry.
     */
    public function get($id)
    {
        $target = $this->getContainer()->get($id, function () use ($id) {
            $message = sprintf('%s not handled by this container', $id);
            throw new NotFoundException($message);
        });

        return $target instanceof \Closure
            ? $target()
            : $target;
    }

    /**
     * @param string $id
     * @return bool
     */
    public function has($id): bool
    {
        $container = $this->getContainer();

        return $container->has($id);
    }

    /**
     * @param string $key
     * @param mixed  $concrete
     */
    public function add(string $key, $concrete)
    {
        $this->getContainer()->put($key, $concrete);
    }

    /**
     * @param string $object
     * @param array $params
     *
     * @return mixed
     */
    public function make(string $object, array $params)
    {
        return \call_user_func_array($object, $params);
    }

    /**
     * @param string $method
     * @param array  $arguments
     * @return mixed
     */
    public static function __callStatic($method, $arguments)
    {
        $container = new self;

        return \call_user_func_array([$container, $method], $arguments);
    }

    /**
     * @param string $method
     * @param array  $arguments
     * @return mixed
     */
    public function __call($method, $arguments)
    {
        return $this->{$method}($arguments);
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return $this->getContainer()->offsetExists($offset);
    }

    /**
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->getContainer()->offsetGet($offset);
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value): void
    {
        $this->getContainer()->offsetSet($offset, $value);
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset): void
    {
        $this->getContainer()->offsetUnset($offset);
    }
}
