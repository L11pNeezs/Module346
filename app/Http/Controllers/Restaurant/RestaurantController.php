<?php

namespace App\Http\Controllers\Restaurant;

use App\Libraries\Core\Http\Controller\AbstractController;
use App\Models\Restaurant;

class RestaurantController extends AbstractController
{
    const NB_RESTAURANTS_PER_PAGE = 6;
    public function restaurants(): string
    {
        $pageNumber = $this->getPageNumber();
        $criterias = $this->getCriterias();
        $nbPages = ceil(Restaurant::countRestaurantsByCriteria($criterias) / self::NB_RESTAURANTS_PER_PAGE);
        $restaurants = Restaurant::getRestaurantsByCriteria($criterias, self::NB_RESTAURANTS_PER_PAGE, $pageNumber);

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

    private function getCriterias(): array
    {
        $criterias = [];
        $requestVars = request()->all();
        $criteriasKeys = ['concept', 'price_tier', 'diet'];

        foreach ($criteriasKeys as $criteriaKey) {
            if (isset($requestVars[$criteriaKey]) && !empty($requestVars[$criteriaKey])) {
                $criterias[$criteriaKey] = $requestVars[$criteriaKey];
            }
        }

        return $criterias;
    }

    private function getPageNumber(): int
    {
        $requestVars = request()->all();

        return isset($requestVars['page']) && is_numeric($requestVars['page']) ? (int) $requestVars['page'] : 1;
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
