<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Libraries\Core\Router;

Router::group(['prefix' => 'admin'], static function () {
    Router::get('/', [DashboardController::class, 'index']);
    Router::get('/users',[DashboardController::class, 'showUsers']);
});

