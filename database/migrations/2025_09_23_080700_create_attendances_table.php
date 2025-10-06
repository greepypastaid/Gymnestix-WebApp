<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id('attendance_id');
            $table->foreignId('member_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->foreignId('trainer_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->foreignId('class_id')->constrained('classes', 'class_id')->onDelete('cascade');
            $table->date('tanggal');
            $table->time('waktu_masuk');
            $table->time('waktu_keluar')->nullable();
            $table->integer('durasi_latihan')->nullable()->comment('Durasi dalam menit');
            $table->string('jenis_latihan')->nullable();
            $table->text('catatan')->nullable();
            $table->enum('status', ['hadir', 'izin', 'sakit', 'alpa'])->default('hadir');
            $table->timestamps();

            // Index untuk performa query
            $table->index(['member_id', 'tanggal']);
            $table->index(['trainer_id', 'tanggal']);
            $table->index(['class_id', 'tanggal']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};