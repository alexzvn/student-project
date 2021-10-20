<?php

namespace App\Controllers;

use Core\Http\Auth;
use Core\Http\Response;

class UserController
{
    public function logout(Auth $auth, Response $response)
    {
        $auth->logout();

        return $response->redirect('/');
    }
}
