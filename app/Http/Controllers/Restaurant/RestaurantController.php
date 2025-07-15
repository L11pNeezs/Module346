<?php

namespace App\Http\Controllers\Restaurant;

use App\Libraries\Core\Http\Controller\AbstractController;
use App\Models\Restaurant;

class RestaurantController extends AbstractController
{
    const NB_RESTAURANTS_PER_PAGE = 6;
    public function restaurants(): string
    {
        $criteria = $_GET; // Use GET for filters
        $hasCriteria = !empty(array_filter([
            $criteria['concept'] ?? null,
            $criteria['price_tier'] ?? null,
            $criteria['diet'] ?? null,
        ]));

        $pageNumber = isset($criteria['page']) && is_numeric($criteria['page']) ? (int) $criteria['page'] : 1;

        if ($hasCriteria) {
            $restaurants = Restaurant::getRestaurantsByCriteria($criteria, self::NB_RESTAURANTS_PER_PAGE, $pageNumber);
            $nbPages = ceil(Restaurant::countRestaurantsByCriteria($criteria) / self::NB_RESTAURANTS_PER_PAGE);
        } else {
            $criteria = request()->all();
            $nbPages = ceil(Restaurant::countRestaurantsByCriteria($criteria) / self::NB_RESTAURANTS_PER_PAGE);
            $restaurants = Restaurant::getRestaurantsByCriteria($criteria, self::NB_RESTAURANTS_PER_PAGE, $pageNumber);
        }

        $view = 'restaurants';
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
            $view = 'partials.restaurant_cards';
        }

        return view($view, [
            'restaurants' => $restaurants,
            'pageNumber' => $pageNumber,
            'nbPages' => $nbPages,
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
}
