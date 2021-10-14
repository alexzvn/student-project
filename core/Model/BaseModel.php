<?php

namespace Core\Model;

class BaseModel
{
    public static MySqlConnection $connection;

    protected string $table;

    protected string $primary = 'id';

    protected $attributes = [];

    /**
     * Unsaved change
     *
     * @var array
     */
    protected $dirtyAttributes = [];

    public function __construct($attributes) {
        $this->attributes = $attributes;
    }

    public function save()
    {
        
    }

    public function delete()
    {
        if ($this->isCreated()) {
            static::$connection->execute("DELETE FROM $this->table WHERE $this->primary = $this->id");
        }
    }

    private function create() {
        
    }

    public function isCreated()
    {
        return isset($this->attributes[$this->primary]);
    }

    public function query()
    {
        $builder = new Builder(static::$connection, static::class);

        return $builder->from($this->table);
    }

    public function __get(string $key)
    {
        return $this->dirtyAttributes[$key] ?? $this->attributes[$key];
    }

    public function __set(string $key, string $value)
    {
        return $this->dirtyAttributes[$key] = $value;
    }
}
