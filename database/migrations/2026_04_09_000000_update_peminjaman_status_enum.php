<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE `peminjaman` MODIFY `status` ENUM('pending','approved','dikembalikan','selesai') NOT NULL DEFAULT 'pending';");
        } else {
            Schema::table('peminjaman', function (Blueprint $table) {
                $table->enum('status', ['pending', 'approved', 'dikembalikan', 'selesai'])->default('pending')->change();
            });
        }
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE `peminjaman` MODIFY `status` ENUM('pending','approved','selesai') NOT NULL DEFAULT 'pending';");
        } else {
            Schema::table('peminjaman', function (Blueprint $table) {
                $table->enum('status', ['pending', 'approved', 'selesai'])->default('pending')->change();
            });
        }
    }
};
