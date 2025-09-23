<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id('class_id');
            $table->foreignId('trainer_id')->constrained('trainers', 'trainer_id')->onDelete('cascade');
            $table->string('nama_kelas');
            $table->text('deskripsi');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->integer('durasi'); // dalam menit COK!
            $table->integer('kapasitas'); // maksimal peserta
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
