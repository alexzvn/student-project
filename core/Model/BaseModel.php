<?php

namespace Core\Model;

abstract class BaseModel extends SimpleOrm
{
    protected $fillable = [];

    public static function find($id)
    {
        try {
            return static::retrieveByPK($id);
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function fill(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            if (in_array($key, $this->fillable)) {
                $this->set($key, $value);
            }
        }

        return $this;
    }

    public function forceFill(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            $this->set($key, $value);
        }

        return $this;
    }
}
