<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Progres extends Model
{
    protected $fillable = [
        'pengaduan_id',
        'foto_progres',
    ];

    // Relasi ke pengaduan (opsional)
    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class);
    }
}
