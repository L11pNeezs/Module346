<?php

namespace App\Http\Controllers\Restaurant;

use App\Libraries\Core\Http\Controller\AbstractController;
use App\Models\Restaurant;

class RestaurantController extends AbstractController
{
    public function displayAll(): string
    {
        return view('restaurants', ['restaurants' => Restaurant::all()]);
    }

    public function contribute(): string
    {
        return view('contribute');
    }

}
