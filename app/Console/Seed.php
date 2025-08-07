<?php

namespace App\Console;

use App\Libraries\Core\Console\AbstractCommand;
use App\Libraries\Core\Facades\DB;
use Database\Seeders\DatabaseSeeder;

class Seed extends AbstractCommand
{
    public string $signature = 'seed';

    public string $description = 'Seed database';

    public function handle(): int
    {
        $seeder = new DatabaseSeeder;
        for ($i = 0; $i < 5; $i++) {
            $seeder->run();
        }

        $count = DB::table('restaurants')->count();
        echo "Restaurants inserted successfully. Total restaurants: $count".PHP_EOL;

        $count = DB::table('users')->count();
        echo "Users inserted successfully. Total users: $count".PHP_EOL;

        $count = DB::table('menu_items')->count();
        echo "Menus inserted successfully. Total menus: $count".PHP_EOL;

        $count = DB::table('restaurant_reviews')->count();
        echo "Reviews inserted successfully. Total reviews: $count".PHP_EOL;

        $count = DB::table('menu_item_ratings')->count();
        echo "MenuItem item ratings inserted successfully. Total ratings: $count".PHP_EOL;

        return 0;
    }
}
