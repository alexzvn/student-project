<?php

namespace Core\Services;

use Core\Model\BaseModel;
use Core\Service;
use mysqli;

class DatabaseService extends Service
{
    public function register()
    {
        $connection = new mysqli(
            config('database.host'),
            config('database.user'),
            config('database.pass'),
        );

        BaseModel::useConnection($connection, config('database.name'));
    }
}
