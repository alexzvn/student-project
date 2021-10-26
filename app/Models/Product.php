<?php

namespace App\Models;

use Core\Model\BaseModel;

class Product extends BaseModel
{
    protected static string $table = 'products';

    protected $fillable = [
        'name',
        'price',
        'kind',
        'brand',
    ];
}
