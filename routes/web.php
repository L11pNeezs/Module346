<?php

use App\Libraries\Core\Router;
<<<<<<< HEAD
use App\Models\Restaurant;
=======
>>>>>>> 8c6edc4 (Resolve "Feature - limit in Query.php")
use App\Models\User;

Router::get('/', static function () {
    return view('teaser', ['rest' => Restaurant::randomRestaurant(),
    ]);
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
