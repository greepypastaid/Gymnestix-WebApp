<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('class_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('class_name');           // misal: Yoga, HIIT
            $table->date('class_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('room')->nullable();     // Studio A, dst
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('class_schedules');
    }
};
