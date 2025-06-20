<?php

use App\Libraries\Core\Database\Blueprint;
use App\Libraries\Core\Database\Migration;
use App\Libraries\Core\Database\Schema;
use App\Models\Restaurant;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('description');
            $table->string('image');
            $table->string('price_tier');
            $table->string('diet');
            $table->timestamps();
        });
    }
};
