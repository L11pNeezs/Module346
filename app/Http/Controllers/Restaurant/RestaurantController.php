<?php

namespace App\Http\Controllers\Restaurant;

use App\Libraries\Core\Http\Controller\AbstractController;
use App\Models\Restaurant;

class RestaurantController extends AbstractController
{
    public function restaurants(): string
    {
        $pageNumber = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
        return view('restaurants', [
            'restaurants' => Restaurant::paginate(3, $pageNumber),
            'pageNumber' => $pageNumber,
            'nbPages' => ceil(Restaurant::countAll(3, $pageNumber) / 3)
        ]);
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
        $restaurant->p_t_description = $data['p_t_description'];
        $restaurant->concept = $data['concept'];
        $restaurant->c_description = $data['c_description'];
        $restaurant->diet = $data['diet'];
        $restaurant->d_description = $data['d_description'];
        $restaurant->save();

        return header('Location: /');
    }

    public function keypoints(): string
    {
        return view('keypoints');
    }

    public function getFilteredRestaurants(): string
    {
        $criteria = request()->all();
        $restaurants = Restaurant::getRestaurantsByCriteria($criteria);

        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
            return view('partials.restaurant_cards', ['restaurants' => $restaurants]);
        }
        return view('restaurants', ['restaurants' => $restaurants]);
    }
}
