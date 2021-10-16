<?php

namespace Core\Model;

abstract class BaseModel extends SimpleOrm
{
    public static function find($id)
    {
        return static::retrieveByPK($id);
    }
}
