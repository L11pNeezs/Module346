<?php

namespace App\Http\Controllers\User;

use App\Libraries\Core\Http\Controller\AbstractController;
use App\Models\User;

class UserController extends AbstractController
{
    public function register()
    {
        $data = request()->all();

        $required = ['username', 'password', 'email', 'name', 'surname'];
        foreach ($required as $field) {
            if (empty($data[$field] ?? null)) {
                return view('homepage', ['error' => 'All fields are required.']);
            }
        }
        $user = new User;
        $user->username = $data['username'];
        $user->password = password_hash($data['password'], PASSWORD_BCRYPT);
        $user->email = $data['email'];
        $user->name = $data['name'];
        $user->surname = $data['surname'];
        $user->save();

        header('Location: /login');
        exit;
    }

    public function login()
    {
        $data = request()->all();

        $required = ['username', 'password'];
        foreach ($required as $field) {
            if (empty($data[$field] ?? null)) {
                return view('homepage', ['error' => 'Username and password are required.']);
            }
        }

        $user = User::find('username', $data['username']);

        if (!$user || !password_verify($data['password'], $user->password)) {
            return view('homepage', ['error' => 'Wrong username or password.']);
        }

        $_SESSION['id'] = $user->id;

        header('Location: /login');
        exit;
    }

}
