<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('class_user', function (Blueprint $table) {

            // Cek dulu apakah kolom membership_plan_id ada
            if (Schema::hasColumn('class_user', 'membership_plan_id')) {
                $table->dropForeign(['membership_plan_id']); // lebih aman
                $table->dropColumn('membership_plan_id');
            }

            if (Schema::hasColumn('class_user', 'user_id')) {
                $table->renameColumn('user_id', 'member_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('class_user', function (Blueprint $table) {
            if (Schema::hasColumn('class_user', 'member_id')) {
                $table->renameColumn('member_id', 'user_id');
            }

            if (!Schema::hasColumn('class_user', 'membership_plan_id')) {
                $table->unsignedBigInteger('membership_plan_id')->nullable();
                $table->foreign('membership_plan_id')
                    ->references('membership_plan_id')
                    ->on('membership_plans')
                    ->onDelete('cascade');
            }
        });
    }
};
