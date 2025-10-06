<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('attendances', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();

            // Member yang hadir (pakai users.user_id agar konsisten)
            $table->unsignedBigInteger('user_id');

            // Opsional: terkait jadwal kelas (dari modul schedule)
            $table->foreignId('class_schedule_id')->nullable()->constrained()->nullOnDelete();

            // Tanggal kehadiran (memudahkan filter)
            $table->date('attendance_date');

            // Waktu masuk/keluar (boleh kosong kalau absen)
            $table->dateTime('check_in_at')->nullable();
            $table->dateTime('check_out_at')->nullable();

            // Status: present / absent / late
            $table->enum('status', ['present', 'absent', 'late'])->default('present');

            // Dicatat oleh siapa (admin/trainer), nullable
            $table->unsignedBigInteger('recorded_by')->nullable();

            $table->text('notes')->nullable();
            $table->timestamps();

            // FKs ke users.user_id
            $table->foreign('user_id')->references('user_id')->on('users')->cascadeOnDelete();
            $table->foreign('recorded_by')->references('user_id')->on('users')->nullOnDelete();

            // Hindari duplikasi entri per user & tanggal (dan jadwal jika ada)
            $table->unique(['user_id', 'attendance_date', 'class_schedule_id']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('attendances');
    }
};
