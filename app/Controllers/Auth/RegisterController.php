<?php

namespace App\Controllers\Auth;

use App\Models\User;
use Core\Http\Auth;
use Core\Http\Request;
use Core\Http\Response;
use Core\Support\Hash;

class RegisterController
{
    public function index(Response $response, Auth $auth)
    {
        if ($auth->isLogged()) {
            return $response->redirect('/');
        }

        return $response->view('auth.register');
    }

    public function register(Response $response, Auth $auth, Request $request)
    {
        if ($errors = $this->validate($request)) {
            session()->flash('errors', $errors);

            return $response->redirect($request->referer());
        }

        $user = new User($request->only([
            'name', 'email', 'address'
        ]));

        $user->forceFill([
            'password' => Hash::make($request->password)
        ])->save();

        $auth->login($user);

        return $response->redirect('/');
    }

    public function validate(Request $request)
    {
        
    }
}
