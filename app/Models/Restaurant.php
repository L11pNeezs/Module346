<?php

namespace App\Models;

use App\Libraries\Core\Database\Model;
use App\Libraries\Core\Facades\DB;

class Restaurant extends Model
{
    public static function getRandomRestaurant(): ?Restaurant
    {
        $result = DB::select(self::getTableName())
            ->orderBy('RANDOM()')
            ->limit(1)
            ->get()[0] ?? null;

        $restaurant = new self;
        if ($result) {
            $restaurant->id = $result['id'];
            $restaurant->name = $result['name'];
            $restaurant->address = $result['address'];
            $restaurant->description = $result['description'];
            $restaurant->image = $result['image'];
            $restaurant->price_tier = $result['price_tier'];
            $restaurant->concept = $result['concept'];
            $restaurant->diet = $result['diet'];
        }
        return $restaurant;
    }

    public static function getRestaurantsByCriteria(array $criteria): array
    {
        $query = DB::select(self::getTableName());

        if (!empty($criteria['price_tier'])) {
            if ($criteria['price_tier'] <= 15) {
                $query->where('price_tier', '<=', $criteria['price_tier']);
                if (!empty($criteria['concept'])) {
                    $query->where('concept', '=', $criteria['concept']);
                }
            } elseif ($criteria['price_tier'] > 15 && $criteria['price_tier'] <= 30) {
                $query->where('price_tier', '>', 15)
                      ->where('price_tier', '<=', 30);
                if (!empty($criteria['concept'])) {
                    $query->where('concept', '=', $criteria['concept']);
                }
            } elseif ($criteria['price_tier'] > 30) {
                $query->where('price_tier', '>', 30);
                if (!empty($criteria['concept'])) {
                    $query->where('concept', '=', $criteria['concept']);
                }
            }
        }

        if (!empty($criteria['concept'])) {
            $query->where('concept', '=', $criteria['concept']);
        }

        if (!empty($criteria['diet'])) {
            $query->where('diet', '=', $criteria['diet']);
        }

        $results = $query->get();
        $restaurants = [];

        foreach ($results as $result) {
            $restaurant = new self;
            $restaurant->id = $result['id'];
            $restaurant->name = $result['name'];
            $restaurant->address = $result['address'];
            $restaurant->description = $result['description'];
            $restaurant->image = $result['image'];
            $restaurant->price_tier = $result['price_tier'];
            $restaurant->concept = $result['concept'];
            $restaurant->diet = $result['diet'];
            $restaurants[] = $restaurant;
        }
        return $restaurants;
    }
}
