<?php

namespace App\Models;

use Core\Model\BaseModel;

class Product extends BaseModel
{
    protected static $table = 'products';

    protected $fillable = [
        'name',
        'price',
        'kind',
        'brand',
    ];
}
