<?php

use App\Http\Controllers\Contact\ContactController;
use App\Http\Controllers\Map\MapController;
use App\Http\Controllers\Menu\MenuItemController;
use App\Http\Controllers\Restaurant\RestaurantController;
use App\Http\Controllers\Restaurant\RestaurantReviewController;
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
    Router::get('/keypoints', [RestaurantController::class, 'keypoints', MenuItemController::class, 'menu']);
    Router::post('/menu-rate', [MenuItemController::class, 'rateItem']);
    Router::post('/restaurant-rate', [RestaurantReviewController::class, 'rateRestaurant']);
});

Router::get('/map', [MapController::class, 'showMap']);

Router::get('/team', static function () {
    return view('team');
});

Router::group(['prefix' => 'menu_reviews'], static function () {
    Router::get('/', [MenuItemController::class, 'reviews']);
    Router::post('/edit_review', [MenuItemController::class, 'updateReview']);
    Router::post('/delete_review', [MenuItemController::class, 'deleteReview']);
});

Router::group(['prefix' => 'restaurant_reviews'], static function () {
    Router::get('/', [RestaurantReviewController::class, 'reviews']);
    Router::post('/edit_review', [RestaurantReviewController::class, 'updateReview']);
    Router::post('/delete_review', [RestaurantReviewController::class, 'deleteReview']);
});

router::group(['prefix' => 'contact'], static function () {
    Router::get('/', [ContactController::class, 'contact']);
    Router::post('/', [ContactController::class, 'send']);
    Router::get('/success', [ContactController::class, 'success']);
});
