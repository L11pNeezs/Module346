<?php

namespace App\Http\Controllers\Map;

use App\Libraries\Core\Facades\DB;
use App\Libraries\Core\Http\Controller\AbstractController;
use App\Models\Restaurant;
use App\Services\GeoAdminApi\CoordinatesDto;
use App\Services\GeoAdminApi\SearchService;

class MapController extends AbstractController
{
    public function showMap(): string
    {
        $restaurants = Restaurant::all();
        $restaurantCoordinates = [];
        foreach ($restaurants as $restaurant) {
            $sql = "SELECT ST_X('{$restaurant->coordinates}') as lon, ST_Y('{$restaurant->coordinates}') as lat";
            $coordinates = DB::raw($sql)->fetchAll(\PDO::FETCH_ASSOC);
            $restaurantCoordinates[] = [
                'lon' => $coordinates[0]['lon'],
                'lat' => $coordinates[0]['lat'],
            ];
        }

        return view('map', ['restaurantCoordinates' => $restaurantCoordinates]);
    }
}
