<?php

use App\Libraries\Core\Router;

Router::get('/', static function () {
    return view('welcome');
});

Router::group(['prefix' => 'example'], static function () {
    Router::get('/', static function () {
        return view('example.index', ['users' => \App\Models\User::all()]);
    });

    Router::post('/create-user', static function () {
        ['username' => $username, 'password' => $password] = request()->all();

        if (empty($username) || empty($password)) {
            return view('example.index', ['error' => 'Name and password are required.']);
        }

        $user = new \App\Models\User();
        $user->username = $username;
        $user->password = password_hash($password, PASSWORD_BCRYPT);
        $user->save();

        return header('Location: /example');
    });
});
