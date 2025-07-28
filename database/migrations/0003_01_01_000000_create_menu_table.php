<?php

use App\Libraries\Core\Database\Blueprint;
use App\Libraries\Core\Database\Migration;
use App\Libraries\Core\Database\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
            $table->string('name');
            $table->string('description')->nullable(true);
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
    }
};
