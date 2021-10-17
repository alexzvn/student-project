<?php

namespace App\Models;

use Core\Model\BaseModel;

class Product extends BaseModel
{
    protected $table = 'products';

    protected $fillable = [
        'name',
        'avatar',
        'price',
        'description',
    ];
}
