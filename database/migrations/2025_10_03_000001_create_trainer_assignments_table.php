<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('trainer_assignments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();

            $table->foreignId('class_schedule_id')->constrained()->cascadeOnDelete();

            // ✅ gunakan unsignedBigInteger agar cocok dengan user_id (bigint unsigned)
            $table->unsignedBigInteger('trainer_id');
            $table->unsignedBigInteger('assigned_by')->nullable();

            $table->text('notes')->nullable();
            $table->timestamps();

            // ✅ relasi ke kolom user_id, bukan id
            $table->foreign('trainer_id')
                  ->references('user_id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->foreign('assigned_by')
                  ->references('user_id')
                  ->on('users')
                  ->nullOnDelete();

            $table->unique(['class_schedule_id', 'trainer_id']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('trainer_assignments');
    }
};
