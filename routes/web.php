<?php

use App\Libraries\Core\Router;
use App\Models\User;

Router::get('/', static function () {
    return view('welcome');
});

Router::group(['prefix' => 'example'], static function () {
    Router::get('/', static function () {
        return view('example.index', ['users' => User::all()]);
    });

    Router::post('/create-user', static function () {
        ['username' => $username, 'password' => $password] = request()->all();

        if (empty($username) || empty($password)) {
            return view('example.index', ['error' => 'Name and password are required.']);
        }

        $user = new User();
        $user->username = $username;
        $user->password = password_hash($password, PASSWORD_BCRYPT);
        $user->save();

        return header('Location: /example');
    });
});
