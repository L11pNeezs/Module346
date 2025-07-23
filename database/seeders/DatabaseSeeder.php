<?php

namespace Database\Seeders;

use App\Libraries\Core\Facades\DB;
use App\Libraries\Core\RestaurantFaker;
use App\Libraries\Core\UserFaker;

class DatabaseSeeder
{
    public function run(): void
    {
        DB::table('restaurants')->insert([
            'name' => RestaurantFaker::name(),
            'address' => RestaurantFaker::address(),
            'coordinates' => RestaurantFaker::coordinates(),
            'description' => RestaurantFaker::description(),
            'image' => RestaurantFaker::image(),
            'price_tier' => RestaurantFaker::priceTier(),
            'price_tier_description' => RestaurantFaker::ptDescription(),
            'concept' => RestaurantFaker::concept(),
            'concept_description' => RestaurantFaker::cDescription(),
            'diet' => RestaurantFaker::diet(),
            'diet_description' => RestaurantFaker::dDescription(),
        ]);

        DB::table('users')->insert([
            'username' => UserFaker::username(),
            'password' => UserFaker::password(),
            'name' => UserFaker::name(),
            'surname' => UserFaker::surname(),
            'email' => UserFaker::email(),
        ]);
    }
}
