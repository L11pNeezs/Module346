<?php

namespace App\Models;

use App\Libraries\Core\Database\Model;

class User extends Model
{
    public function getFullName(): string
    {
        return $this->name.' - '.$this->surname;
    }
}
