<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pelapor',
        'email',
        'tanggal_pengaduan',
        'jenis_kerusakan',
        'lokasi_kerusakan',
        'foto_kerusakan',
        'status',
        'petugas',
    ];

    public function progres()
    {
        return $this->hasMany(Progres::class);
    }
}
