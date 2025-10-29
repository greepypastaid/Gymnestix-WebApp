<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            // Tambahkan kolom membership_plan_id setelah member_id
            $table->unsignedBigInteger('membership_plan_id')->nullable()->after('user_id');

            // Tambahkan foreign key (opsional tapi recommended)
            $table->foreign('membership_plan_id')->references('plan_id')->on('membership_plans')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            // Drop foreign key dulu
            $table->dropForeign(['membership_plan_id']);

            // Hapus kolomnya
            $table->dropColumn('membership_plan_id');
        });
    }
};
