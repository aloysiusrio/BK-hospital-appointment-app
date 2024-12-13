<?php

namespace App\Services;

use App\Models\Pasien;

class GenerateRMNumberService
{
    public static function generate()
    {
        $date = date('Ym');
        $lastPasien = Pasien::orderBy('id', 'desc')->first();

        if ($lastPasien) {
            $lastPasienId = $lastPasien->id;
            $lastPasienId++;

            $lastPasienId = max(1, min($lastPasienId, 100));

            $lastPasienId = str_pad($lastPasienId, 3, '0', STR_PAD_LEFT);

            return $date . '-' . $lastPasienId;
        } else {
            return $date . '-001';
        }
    }
}
