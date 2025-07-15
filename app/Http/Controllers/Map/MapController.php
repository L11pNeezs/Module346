<?php

namespace App\Http\Controllers\Map;

use App\Libraries\Core\Http\Controller\AbstractController;
use App\Models\Restaurant;
use App\Services\GeoAdminApi\CoordinatesDto;
use App\Services\GeoAdminApi\SearchService;

class MapController extends AbstractController
{
    public function showMap(): string
    {
        $searchApi = new SearchService();
        $restaurants = Restaurant::all();

        $restaurantCoordinates = [];
        foreach ($restaurants as $restaurant) {
            $restaurantCoordinates[$restaurant->id] = [
                'name' => $restaurant->name,
                'coords' => $searchApi->getCoordinates($restaurant->address),
            ];
        }

        return view('map', ['restaurantCoordinates' => array_values($restaurantCoordinates)]);
    }

}
