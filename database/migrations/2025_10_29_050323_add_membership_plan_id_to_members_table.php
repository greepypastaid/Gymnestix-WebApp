<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->unsignedBigInteger('membership_plan_id')->nullable()->after('user_id');

            $table->foreign('membership_plan_id')
                ->references('plan_id')
                ->on('membership_plans')
                ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropForeign(['membership_plan_id']);
            $table->dropColumn('membership_plan_id');
        });
    }
};
