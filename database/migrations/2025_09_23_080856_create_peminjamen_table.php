<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id('peminjaman_id');
            $table->foreignId('member_id')->constrained('members', 'member_id')->onDelete('cascade');
            $table->foreignId('equipment_id')->constrained('equipments', 'equipment_id')->onDelete('cascade');
            $table->timestamp('waktu_pinjam');
            $table->timestamp('waktu_kembali')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};
