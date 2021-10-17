<?php

namespace App\Controllers\Auth;

use App\Models\User;
use Core\Http\Auth;
use Core\Http\Request;
use Core\Http\Response;
use Core\Support\Hash;

class LoginController
{
    public function index(Auth $auth, Response $response)
    {
        if ($auth->isLogged()) {
            return $response->redirect('/');
        }

        return $response->view('auth.login');
    }

    public function login(Request $request, Auth $auth, Response $response)
    {
        if ($auth->isLogged()) {
            return $response->redirect('/');
        }

        if ($errors = $this->validate($request)) {
            session()->flash('errors', $errors);

            return $response->redirect($request->referer());
        }

        $auth->login(
            User::retrieveByField('email', $request->email, User::FETCH_ONE)
        );

        return $response->redirect('/');
    }

    public function validate(Request $request)
    {
        $errors = ['login' => 'Credential incorrect, please try again'];

        if (!$email = $request->email) {
            return $errors;
        }

        if (! $user = User::retrieveByField('email', $email)) {
            return $errors;
        }

        if (Hash::compare($request->password, $user->password)) {
            return [];
        }

        return $errors;
    }
}

