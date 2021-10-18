<?php

namespace App\Models;

use Core\Model\BaseModel;

class User extends BaseModel
{
    protected static $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'address'
    ];
}
