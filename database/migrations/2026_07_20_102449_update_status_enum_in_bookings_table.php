<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
{
    DB::statement("ALTER TABLE bookings MODIFY COLUMN status ENUM('Pending', 'Disetujui', 'Ditolak', 'Menunggu Verifikasi', 'Selesai') DEFAULT 'Pending'");
}

    public function down(): void
    {
        DB::statement("ALTER TABLE bookings MODIFY COLUMN status ENUM('Pending', 'Disetujui', 'Ditolak', 'Selesai') DEFAULT 'Pending'");
    }
};