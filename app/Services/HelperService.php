<?php

namespace App\Services;

use Core\Service;

class HelperService extends Service
{
    public function register()
    {
        require_once base_path('app/helper.php');
    }
}
