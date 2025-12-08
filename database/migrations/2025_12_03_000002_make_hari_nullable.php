<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Use raw SQL to avoid dependency on doctrine/dbal
        DB::statement("ALTER TABLE `classes` MODIFY `hari` VARCHAR(20) NULL;");
    }

    public function down(): void
    {
        // Revert to NOT NULL (may fail if nulls exist)
        DB::statement("ALTER TABLE `classes` MODIFY `hari` VARCHAR(20) NOT NULL;");
    }
};
