<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    /** @use HasFactory<\Database\Factories\AntrianFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id',
        'nomor_antrian',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'layanans_id', 'id');
    }
}
