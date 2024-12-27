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
        $notification = [
            'status' => 'error',
            'title' => 'Gagal',
            'message' => 'Poli yang dipilih tidak sesuai dengan jadwal dokter',
        ];

        return redirect()->back()->with($notification);
    }

    $tanggalHariIni = now()->format('Y-m-d');

    // Hitung jumlah antrian untuk hari ini dan poli yang sama
    $jumlahAntrianHariIni = DaftarPoli::where('tanggal', $tanggalHariIni)
    ->whereHas('jadwal.dokter', function ($query) use ($request) {
        $query->where('poli_id', $request->poli_id);
    })
    ->count();

    $noAntrian = $jumlahAntrianHariIni + 1;

    $daftar = DaftarPoli::create([
        'pasien_id' => auth()->user()->pasien->id,
        'poli_id' => $request->poli_id,
        'jadwal_periksa_id' => $request->jadwal_id,
        'status' => 'waiting',
        'keluhan' => $request->keluhan,
        'tanggal' => $tanggalHariIni,
        'no_antrian' => "A-$request->poli_id-$noAntrian",
    ]);

    $notification = [
        'status' => 'toast_success',
        'title' => 'Berhasil',
        'message' => 'Pendaftaran berhasil',
        'no_antrian' => $daftar->no_antrian,
    ];

    return redirect()->back()->with($notification);
}


    public function show($id)
    {
        $periksa = DaftarPoli::with('periksa')->where('id', $id)->where('pasien_id', auth()->user()->pasien->id)->firstOrFail();
        return view('dashboard.pasien.poli.history', compact('periksa'));
    }
}
