<?php

namespace App\Models;

use Core\Model\BaseModel;

class User extends BaseModel
{
    protected static string $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'address'
    ];
}
