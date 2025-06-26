<?php

use App\Libraries\Core\Database\Blueprint;
use App\Libraries\Core\Database\Migration;
use App\Libraries\Core\Database\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', static function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('password');
            $table->string('name');
            $table->string('surname');
            $table->string('email');
            $table->bool('is_logged');
            $table->timestamps();
        });
    }
};
