<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->bigIncrements('attendance_id');
            $table->unsignedBigInteger('user_id')->nullable(); 
            $table->unsignedBigInteger('member_id')->nullable();
            $table->unsignedBigInteger('trainer_id')->nullable();
            $table->unsignedBigInteger('class_id')->nullable();
            $table->unsignedBigInteger('class_schedule_id')->nullable();
            $table->date('tanggal')->nullable();
            $table->date('attendance_date')->nullable();
            $table->dateTime('waktu_masuk')->nullable();
            $table->dateTime('check_in_at')->nullable();
            $table->dateTime('waktu_keluar')->nullable();
            $table->dateTime('check_out_at')->nullable();
            $table->integer('durasi_latihan')->nullable();
            $table->integer('duration')->nullable();
            $table->string('status')->default('present');
            $table->text('catatan')->nullable();
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('recorded_by')->nullable();

            $table->timestamps();
            if (Schema::hasTable('users')) {
                $table->foreign('user_id')->references('user_id')->on('users')->cascadeOnDelete()->nullable();
                $table->foreign('trainer_id')->references('user_id')->on('users')->nullOnDelete();
                $table->foreign('recorded_by')->references('user_id')->on('users')->nullOnDelete();
            }

            if (Schema::hasTable('members')) {
                $table->foreign('member_id')->references('member_id')->on('members')->nullOnDelete();
            }

            if (Schema::hasTable('classes')) {
                $table->foreign('class_id')->references('class_id')->on('classes')->nullOnDelete();
            }

            if (Schema::hasTable('class_schedules')) {
                $table->foreign('class_schedule_id')->references('id')->on('class_schedules')->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        // drop table only if it exists
        if (Schema::hasTable('attendances')) {
            Schema::dropIfExists('attendances');
        }
    }
};