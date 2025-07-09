<?php

use App\Libraries\Core\Database\Blueprint;
use App\Libraries\Core\Database\Migration;
use App\Libraries\Core\Database\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('description');
            $table->string('image');
            $table->string('price_tier');
            $table->string('p_t_description');
            $table->string('concept');
            $table->string('c_description');
            $table->string('diet');
            $table->string('d_description');
            $table->timestamps();
        });
    }
};
