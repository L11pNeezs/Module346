<?php

namespace App\Models;

use App\Libraries\Core\Database\Blueprint;
use App\Libraries\Core\Database\Model;
use App\Libraries\Core\Database\Schema;

class Migration extends Model
{
    public static function createIfNotExists(): void
    {
        $isTableExists = Schema::hasTable(self::getTableName());
        if ($isTableExists) {
            return;
        }

        $tableName = self::getTableName();
        Schema::create($tableName, static function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
    }
}
