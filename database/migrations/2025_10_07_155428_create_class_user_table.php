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
        Schema::create('class_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')
                ->constrained('classes', 'class_id')
                ->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users', 'user_id')->cascadeOnDelete();
            $table->foreignId('membership_plan_id')->nullable()->constrained('membership_plans', 'plan_id')->nullOnDelete();
            $table->date('joined_at')->nullable();
            $table->date('expired_at')->nullable(); // tanggal habis masa aktif
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_user');
    }
};
