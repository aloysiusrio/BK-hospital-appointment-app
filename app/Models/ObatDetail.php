<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObatDetail extends Model
{
    use HasFactory;

    protected $table = 'detail_periksa';
    protected $guarded = ['id'];
    protected $with = ['obat'];

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'obat_id');
    }

    public function periksa()
    {
        return $this->belongsTo(Periksa::class, 'periksa_id');
    }
}
