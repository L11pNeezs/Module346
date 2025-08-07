<?php

use App\Http\Controllers\Map\MapController;
use App\Http\Controllers\Restaurant\RestaurantController;
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

Router::group(['prefix' => 'restaurants'], static function () {
    Router::get('/', [RestaurantController::class, 'restaurants']);
    Router::post('/', [RestaurantController::class, 'restaurants']);
    Router::post('/contribute', [RestaurantController::class, 'contribute']);
    Router::get('/contribute', static function () {
        return view('contribute', [
            'concepts' => Restaurant::getConcepts(),
            'priceTiers' => Restaurant::getPriceTiers(),
            'diets' => Restaurant::getDiets(),
        ]);
    });
    Router::get('/keypoints', [RestaurantController::class, 'keypoints']);
});

Router::get('/map', [MapController::class, 'showMap']);

Router::get('/team', static function () {
    return view('team');
});
