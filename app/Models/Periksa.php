<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periksa extends Model
{
    use HasFactory;

    protected $table = 'periksa';
    protected $guarded = [];
    protected $with = ['obatDetail'];

    public function daftarPoli()
    {
        return $this->belongsTo(DaftarPoli::class, 'daftar_poli_id');
    }

    public function obatDetail()
    {
        return $this->hasMany(ObatDetail::class, 'periksa_id');
    }
}
