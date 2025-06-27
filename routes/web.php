<?php

use App\Http\Controllers\User\UserController;
use App\Libraries\Core\Router;
use App\Models\Restaurant;
use App\Models\User;

Router::get('/', static function () {
    return view('homepage', ['restaurant' => Restaurant::getRandomRestaurant(),
    ]);
});

Router::get('/login', static function () {
    if (isset($_SESSION['id'])) {
        return view('homepage');
    }
    return view('homepage');
});

Router::post('/signup', [UserController::class, 'register']);
Router::post('/login', [UserController::class, 'login']);
Router::get('/logout', [UserController::class, 'logout']);

Router::group(['prefix' => 'example'], static function () {
    Router::get('/', static function () {
        return view('example.index', ['users' => User::all()]);
    });

    Router::post('/create-user', static function () {
        [
            'username' => $username,
            'password' => $password,

            ] = request()->all();

        if (empty($username) || empty($password)) {
            return view('example.index', ['error' => 'Name and password are required.']);
        }

        $user = new User;
        $user->username = $username;
        $user->password = password_hash($password, PASSWORD_BCRYPT);
        $user->save();

        return header('Location: /example');
    });

});
