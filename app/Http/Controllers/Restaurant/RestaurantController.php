<?php

namespace App\Http\Controllers\Restaurant;

use App\Libraries\Core\Facades\DB;
use App\Libraries\Core\Http\Controller\AbstractController;
use App\Libraries\Core\Http\RestaurantValidator\RestaurantValidator;
use App\Models\Restaurant;
use App\Services\GeoAdminApi\SearchService;

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
        $validator = new RestaurantValidator();
        $data = request()->all();
        $searchApi = new SearchService();


        $options = [
            'priceTiers' => $validator->getPriceTierOptions(),
            'concepts' => $validator->getConceptOptions(),
            'diets' => $validator->getDietOptions(),
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            return view('contribute', $options);
        }

        $errors = $validator->validateData($data);

        if (!empty($errors)) {
            return view('partials/contribute_partial', array_merge([
                'errors' => $errors,
                'old' => $data,
            ], $options));
        }

        $restaurant = new Restaurant;
        $restaurant->name = trim($data['name']);
        $restaurant->address = trim($data['address']);
        $restaurant->description = trim($data['description']);
        $restaurant->image = trim($data['image']);
        $restaurant->price_tier = $data['price_tier'];
        $restaurant->p_t_description = $data['p_t_description'] ?? '';
        $restaurant->concept = $data['concept'];
        $restaurant->c_description = $data['c_description'];
        $restaurant->diet = $data['diet'];
        $restaurant->d_description = $data['d_description'];

        $coordinates = $searchApi->getCoordinates($data['address']);
        $sql = "SELECT ST_SetSRID(ST_MakePoint({$coordinates->lon}, {$coordinates->lat}), 4326)";
        $geometryPoint = DB::raw($sql)->fetchAll(\PDO::FETCH_ASSOC);
        $restaurant->coordinates = $geometryPoint[0]['st_setsrid'];

        $restaurant->save();

        if ($this->isAjaxRequest()) {
            $this->handleAjaxSuccess([
                'redirect' => '/',
                'message' => 'Restaurant submitted successfully',
            ]);
            return '';
        }

        header('Location: /');
        exit;
    }

    public function keypoints(): string
    {
        $data = request()->all();
        $restaurant = Restaurant::getById($data['restaurant_id']);
        $sql = "SELECT ST_X('{$restaurant->coordinates}') as lon, ST_Y('{$restaurant->coordinates}') as lat";

        $rawCoordinates = DB::raw($sql)->fetchAll(\PDO::FETCH_ASSOC);
        $restaurantCoordinates = [
            'lon' => $rawCoordinates[0]['lon'],
            'lat' => $rawCoordinates[0]['lat'],
        ];

        return view('keypoints', ['restaurantCoordinates' => $restaurantCoordinates]);
    }

    public function getFilteredRestaurants(): string
    {
        $criteria = request()->all();
        $restaurants = Restaurant::getRestaurantsByCriteria($criteria);

        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
            return view('partials.restaurant_cards', ['restaurants' => $restaurants]);
        }
        return view('restaurants', ['restaurants' => $restaurants]);
    }

    protected function isAjaxRequest(): bool
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }
}
