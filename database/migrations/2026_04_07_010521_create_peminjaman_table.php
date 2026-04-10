<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->foreignId('buku_id')->constrained()->cascadeOnDelete();
    $table->date('tanggal_pinjam')->nullable();
    $table->date('jatuh_tempo')->nullable();
    $table->date('tanggal_kembali')->nullable();
    $table->enum('status', ['pending','approved','dikembalikan','selesai'])->default('pending');
    $table->integer('denda')->default(0);
    $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('approved');
    }
};