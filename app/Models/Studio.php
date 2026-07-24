<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    protected $fillable = [
        'nama_studio',
        'jenis',
        'harga',
        'kapasitas',
        'deskripsi',
        'foto',
        'status'
    ];

    public function facilities()
    {
      return $this->hasMany(Facility::class);
    }

    public function bookings()
    {
      return $this->hasMany(Booking::class);
    }

}