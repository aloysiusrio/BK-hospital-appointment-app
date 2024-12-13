<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use App\Models\JadwalPeriksa;
use App\Models\Pasien;
use App\Models\Poli;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    public function index()
    {
        $polis = Poli::all();
        $jadwals = JadwalPeriksa::with('dokter')
        ->where('active', true)
        ->get();

        $daftarPoli = DaftarPoli::where('pasien_id', auth()->user()->pasien->id)->get();
        return view('dashboard.pasien.poli.index', compact('polis', 'jadwals', 'daftarPoli'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'poli_id' => 'required|exists:poli,id',
            'jadwal_id' => 'required|exists:jadwal_periksa,id',
            'keluhan' => 'required',
        ]);

        $jadwal = JadwalPeriksa::with('dokter')
        ->where('id', $request->jadwal_id)
        ->where('active', true)
        ->first();
        $poli = $jadwal->dokter->poli->id;

        if ($poli != $request->poli_id) {
            $notification = array(
                'status' => 'error',
                'title' => 'Gagal',
                'message' => 'Poli yang dipilih tidak sesuai dengan jadwal dokter',
            );

            return redirect()->back()->with($notification);
        }

        $daftar = DaftarPoli::create([
            'pasien_id' => auth()->user()->pasien->id,
            'poli_id' => $request->poli_id,
            'jadwal_periksa_id' => $request->jadwal_id,
            'status' => 'waiting',
            'keluhan' => $request->keluhan,
        ]);

        $daftar->update([
            'no_antrian' => "A-$request->poli_id." . $daftar->id
        ]);

        $notification = array(
            'status' => 'toast_success',
            'title' => 'Berhasil',
            'message' => 'Pendaftaran berhasil',
        );

        $notification['no_antrian'] = $daftar->nomor_antrian;
        return redirect()->back()->with($notification);
    }

    public function show($id)
    {
        $periksa = DaftarPoli::with('periksa')->where('id', $id)->where('pasien_id', auth()->user()->pasien->id)->firstOrFail();
        return view('dashboard.pasien.poli.history', compact('periksa'));
    }
}
