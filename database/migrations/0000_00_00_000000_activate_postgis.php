<?php

use App\Libraries\Core\Database\Blueprint;
use App\Libraries\Core\Database\Migration;
use App\Libraries\Core\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::raw('CREATE EXTENSION postgis;');
    }
};
