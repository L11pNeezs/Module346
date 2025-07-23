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
            $table->geometry('coordinates')->nullable(true);
            $table->string('description');
            $table->string('image')->nullable(true);
            $table->string('price_tier');
            $table->string('p_t_description')->nullable(true);
            $table->string('concept');
            $table->string('c_description')->nullable(true);
            $table->string('diet');
            $table->string('d_description')->nullable(true);
            $table->timestamps();
        });
    }
};
