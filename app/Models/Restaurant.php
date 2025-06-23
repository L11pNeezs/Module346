<?php

namespace App\Models;

use App\Libraries\Core\Database\Model;

class Restaurant extends Model
{
    public function getRandomRestaurant(): string
    {
        return $this->randomRestaurant();
    }
}
