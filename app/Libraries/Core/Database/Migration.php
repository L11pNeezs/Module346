<?php

namespace App\Libraries\Core\Database;

abstract class Migration
{
    abstract public function up(): void;

    public function down(): void {}
}
