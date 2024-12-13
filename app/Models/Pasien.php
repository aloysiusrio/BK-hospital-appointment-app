<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasien';
    protected $guarded = ['id'];
    /**
     * Get the user associated with the patient.
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function daftarPoli()
    {
        return $this->hasMany(DaftarPoli::class, 'pasien_id');
    }
}
