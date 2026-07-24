<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'studio_id',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'durasi_bulan',
        'tanggal_selesai',
        'subtotal',
        'tax_amount',
        'total_harga',
        'metode_pembayaran',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }
}