<?php

namespace Core\Support;

class Collection implements \ArrayAccess
{
    protected $collection;

    public function __construct(array $collection = []) {
        $this->collection = $collection;
    }

    public static function make(array $collection = [])
    {
        return new static($collection);
    }

    public function map(callable $callback)
    {
        return static::make(array_map($callback, $this->collection));
    }

    public function each(callable $callback)
    {
        foreach ($this->collection as $key => $value) {
            $callback($value, $key);
        }
    }

    public function reduce(callable $callback, $init = null)
    {
        return static::make(array_reduce($this->collection, $callback, $init));
    }

    public function offsetExists($offset)
    {
        return isset($this->array[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->array[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->array[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->array[$offset]);
    }

    public function toArray()
    {
        return $this->collection;
    }
}
