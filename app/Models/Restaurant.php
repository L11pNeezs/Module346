<?php

namespace App\Models;

use App\Libraries\Core\Database\Model;
use App\Libraries\Core\Database\Query;
use App\Libraries\Core\Facades\DB;
use App\Services\GeoAdminApi\SearchService;

class Restaurant extends Model
{
    public function fillFromArray(array $data): void
    {
        foreach ($data as $field => $value) {
            $this->$field = $value;
        }

        $searchApi = new SearchService;
        $coordinates = $searchApi->getCoordinates($data['address']);

        $sql = "SELECT ST_SetSRID(ST_MakePoint({$coordinates->lon}, {$coordinates->lat}), 4326)";
        $geometryPoint = DB::raw($sql)->fetchAll(\PDO::FETCH_ASSOC);
        $this->coordinates = $geometryPoint[0]['st_setsrid'];
    }

    public static function getRandomRestaurant(): ?Restaurant
    {
        $result = DB::select(self::getTableName())
            ->orderBy('RANDOM()')
            ->limit(1)
            ->get()[0] ?? null;

        $restaurant = new self;
        if ($result) {
            $restaurant->fillFromArray($result);
        }

        return $restaurant;
    }

    public static function getRestaurantsByCriteria(array $criteria, int $perPage, int $pageNumber): array
    {
        $offset = ($pageNumber - 1) * $perPage;
        $query = self::getBasedQuery($criteria);
        $results = $query
            ->limit($perPage)
            ->offset($offset)
            ->get();
        $restaurants = [];

        foreach ($results as $result) {
            $restaurant = new self;
            $restaurant->fillFromArray($result);
            $restaurants[] = $restaurant;
        }

        return $restaurants;
    }

    public static function countRestaurantsByCriteria(array $criteria): int
    {
        $query = self::getBasedQuery($criteria);

        return $query->count();
    }

    public static function getBasedQuery(array $criteria): Query
    {
        $query = DB::select(self::getTableName());

        if (! empty($criteria['price_tier'])) {
            if ($criteria['price_tier'] <= 15) {
                $query->where('price_tier', '<=', $criteria['price_tier']);
            } elseif ($criteria['price_tier'] > 15 && $criteria['price_tier'] <= 30) {
                $query->where('price_tier', '>', 15)
                    ->where('price_tier', '<=', 30);
            } elseif ($criteria['price_tier'] > 30) {
                $query->where('price_tier', '>', 30);
            }
        }

        if (! empty($criteria['concept'])) {
            $query->where('concept', '=', $criteria['concept']);
        }

        if (! empty($criteria['diet'])) {
            $query->where('diet', '=', $criteria['diet']);
        }

        return $query;
    }

    public static function getConcepts(): array
    {
        $query = DB::select(self::getTableName());
        $concepts = $query->setColumns(['concept'])->get();

        return $concepts ? array_unique(array_column($concepts, 'concept')) : [];
    }

    public static function getPriceTiers(): array
    {
        $query = DB::select(self::getTableName());
        $priceTiers = $query->setColumns(['price_tier'])->get();

        return $priceTiers ? array_unique(array_column($priceTiers, 'price_tier')) : [];
    }

    public static function getDiets(): array
    {
        $query = DB::select(self::getTableName());
        $diets = $query->setColumns(['diet'])->get();

        return $diets ? array_unique(array_column($diets, 'diet')) : [];
    }
}
