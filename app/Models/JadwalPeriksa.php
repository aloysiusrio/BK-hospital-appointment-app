<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JadwalPeriksa extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'jadwal_periksa';
    protected $guarded = ['id'];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }
}
