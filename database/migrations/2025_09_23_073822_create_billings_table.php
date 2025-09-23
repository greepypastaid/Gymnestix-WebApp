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
        Schema::create('billings', function (Blueprint $table) {
            $table->id('billing_id');
            $table->foreignId('member_id')->constrained('members', 'member_id')->onDelete('cascade');
            $table->foreignId('plan_id')->constrained('membership_plans', 'plan_id')->onDelete('cascade');
            $table->decimal('jumlah', 10, 2);
            $table->date('tanggal_tagihan');
            $table->date('tanggal_jatuh_tempo');
            $table->enum('status_pembayaran', ['Lunas', 'Belum Lunas']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billings');
    }
};
