<?php

namespace App\Models;

use App\Libraries\Core\Database\Model;
use App\Libraries\Core\Facades\DB;

class Restaurant extends Model
{

    public static function getRandomRestaurant(): string
    {
        $result = DB::select(self::getTableName())
            ->orderBy('RANDOM()')
            ->limit(1)
            ->get()[0] ?? null;
        return $result['name'] ?? 'No restaurant found';
    }
}
