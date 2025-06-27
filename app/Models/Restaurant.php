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
            $restaurant->veggie_option = $result['veggie_option'];
        }
        return $restaurant;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getPriceTier(): string
    {
        return $this->price_tier;
    }

    public function getConcept(): string
    {
        return $this->concept;
    }

    public function getVeggieOption(): string
    {
        return $this->veggie_option;
    }

}
