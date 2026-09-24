<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    /** @use HasFactory<\Database\Factories\LayananFactory> */
    use HasFactory;

    protected $fillable = [
        'nama_layanan',
        'deskripsi'
    ];

    public function antrian()
    {
        return $this->hasMany(Antrian::class, 'layanans_id', 'id');
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'antrians', 'layanans_id', 'user_id');
    }
}
