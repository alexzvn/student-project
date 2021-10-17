<?php

namespace App\Models;

use Core\Model\BaseModel;

class User extends BaseModel
{
    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'address'
    ];
}
