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
        'status',
        'deskripsi',
        'layanans_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'layanans_id', 'id');
    }
    public static function generateNomorAntrian($layananId)
    {
        $lastAntrian = self::where('layanans_id', $layananId)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($lastAntrian) {
            return $lastAntrian->nomor_antrian + 1;
        }

        return 1; // Jika belum ada antrian, mulai dari nomor 1
    }
}
