<?php

use App\Libraries\Core\Database\Blueprint;
use App\Libraries\Core\Database\Migration;
use App\Libraries\Core\Database\Schema;
use App\Models\User;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', static function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('password');
            $table->timestamps();
        });
    }
};
