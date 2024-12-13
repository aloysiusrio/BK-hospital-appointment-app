<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarPoli extends Model
{
    use HasFactory;

    protected $table = 'daftar_poli';
    protected $guarded = ['id'];
    protected $with = ['pasien', 'jadwal'];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id');
    }

    public function jadwal()
    {
        return $this->belongsTo(JadwalPeriksa::class, 'jadwal_periksa_id');
    }

    public function periksa()
    {
        return $this->hasOne(Periksa::class, 'daftar_poli_id');
    }
}
