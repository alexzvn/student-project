<?php

namespace Core\Support;

class Collection implements \ArrayAccess, \Iterator
{
    protected $collection;

    protected $index = 0;

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
        return array_key_exists($offset, $this->collection);
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

    public function current()
    {
        return $this->collection[$this->index];
    }

    public function next()
    {
        $this->index++;
    }

    public function key()
    {
        return $this->index;
    }

    public function valid()
    {
        return isset($this->collection[$this->key()]);
    }

    public function rewind()
    {
        $this->index = 0;
    }

    public function reverse()
    {
        $this->collection = array_reverse($this->collection);
        $this->rewind();
    }

    public function toArray()
    {
        return $this->collection;
    }
}
