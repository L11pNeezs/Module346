<?php

namespace App\Models;

use App\Libraries\Core\Database\Model;
use App\Libraries\Core\Facades\DB;

class MenuItem extends Model
{
    public function fillFromArray(array $data): void
    {
        foreach ($data as $field => $value) {
            $this->$field = $value;
        }
    }

    public static function getMenu(int $restaurantId): array
    {
        $results = DB::table('menu_items as mi')
            ->selectRaw('mi.*, AVG(mir.rating) as avg_rating')
            ->join('menu_item_ratings as mir', 'mi.id', '=', 'mir.menu_item_id')
            ->where('mi.restaurant_id', '=', $restaurantId)
            ->groupBy('mi.id')
            ->get();

        $menus = [];
        foreach ($results as $row) {
            $menu = new self;
            $menu->fillFromArray((array) $row);
            $menus[] = $menu;
        }

        return $menus;
    }
}
