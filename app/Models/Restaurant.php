<?php

namespace App\Models;

use App\Libraries\Core\Database\Model;

class Restaurant extends Model
{
    public function randomRestaurant(): string
    {
        return $this->getRandomRestaurant();
    }
}
