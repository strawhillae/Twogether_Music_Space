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
        Schema::create('bookings', function (Blueprint $table) {
    
            $table->id();
    
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();
    
            $table->foreignId('studio_id')
                  ->constrained()
                  ->cascadeOnDelete();
    
            $table->date('tanggal');
    
            $table->time('jam_mulai');
    
            $table->time('jam_selesai');
    
            $table->integer('total_harga')->default(0);
    
            $table->enum('status', [
                'Pending',
                'Disetujui',
                'Ditolak',
                'Selesai'
            ])->default('Pending');
    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
