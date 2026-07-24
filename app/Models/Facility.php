<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $fillable = [
        'studio_id',
        'nama_fasilitas',
        'kategori',
    ];

    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }
}