<?php

namespace App\Http\Controllers\Restaurant;

use App\Libraries\Core\Http\Controller\AbstractController;
use App\Models\Restaurant;

class RestaurantController extends AbstractController
{
    public function restaurants(): string
    {
        return view('restaurants', ['restaurants' => Restaurant::all()]);
    }

    public function contribute(): string
    {
        $data = request()->all();

        $required = ['name', 'address', 'description', 'image', 'price_tier', 'concept'];
        foreach ($required as $field) {
            if (empty($data[$field] ?? null)) {
                return view('contribute', ['error' => 'All fields are required.']);
            }
        }

        $restaurant = new Restaurant;
        $restaurant->name = $data['name'];
        $restaurant->address = $data['address'];
        $restaurant->description = $data['description'];
        $restaurant->image = $data['image'];
        $restaurant->price_tier = $data['price_tier'];
        $restaurant->concept = $data['concept'];

        if(isset($data['veggie_option'])){
            $restaurant->veggie_option = $data['veggie_option'];
        } else {
            $restaurant->veggie_option = 0;
        }
        $restaurant->save();

        return header('Location: /');
    }

    public function keypoints(): string
    {
        return view('keypoints');
    }
}
