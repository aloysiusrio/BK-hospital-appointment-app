<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use App\Models\Pasien;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index()
    {
        $pasiens = Pasien::whereHas('daftarPoli', function ($query) {
            $query->whereHas('jadwal', function ($query) {
                $query->where('dokter_id', auth()->user()->dokter->id);
            });
        })->get();

        return view('dashboard.dokter.riwayat.index', compact('pasiens'));
    }

    public function show($id)
    {
        $periksa = DaftarPoli::with('periksa')->where('pasien_id', $id)->where('status','done')->whereHas('jadwal', function ($query) {
            $query->where('dokter_id', auth()->user()->dokter->id);
        })->get();
        return view('dashboard.dokter.riwayat.detail', compact('periksa'));
    }
}
