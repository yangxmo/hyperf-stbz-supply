<?php

namespace Xmo\Api\Core;


/**
 * Class Container
 * @package Xmo\Api\Core
 */
class Container implements \ArrayAccess
{
    /**
     * 中间件
     * @var array
     */
    protected array $middlewares = array();
    /**
     * @var array
     */
    private array $instances = array();
    /**
     * @var array
     */
    private array $values = array();

    /**
     * @param $provider
     * @return $this
     */
    public function serviceRegister($provider): Container
    {
        $provider->serviceProvider($this);
        return $this;
    }

    /**
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet(mixed $offset): mixed
    {
        if (isset($this->instances[$offset])) {
            return $this->instances[$offset];
        }
        $raw = $this->values[$offset];
        $val = $this->values[$offset] = $raw($this);
        $this->instances[$offset] = $val;
        return $val;
    }


    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->values[$offset] = $value;
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset(mixed $offset): void
    {

    }

    /**
     * @return array
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }

    /**
     * @param array $middlewares
     */
    public function setMiddlewares(array $middlewares): void
    {
        $this->middlewares = $middlewares;
    }

    /**
     * 添加中间件
     * @param array $class_and_function
     * @param string $name
     * @return array
     */
    public function pushMiddlewares(array $class_and_function, string $name = ''): array
    {
        if (empty($this->middlewares)) {
            $this->middlewares[$name] = $class_and_function;
        } else {
            array_push($this->middlewares, [$name => $class_and_function]);
        }
        return $this->middlewares;
    }


    public function offsetExists($offset): bool
    {
        return !empty($this->values[$offset]);
    }
}
