<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoli;
use App\Models\Dokter;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum', 'verified']);
    }
    public function index()
    {
        if (Auth::user()->role == 'dokter') {
            $pasien_today = DaftarPoli::whereDate('created_at', date('Y-m-d'))->count();
            $pasien_waiting = DaftarPoli::whereDate('created_at', date('Y-m-d'))->where('status', 'waiting')->count();
            $pasien_called = DaftarPoli::whereDate('created_at', date('Y-m-d'))->where('status', 'called')->count();
            $pasien_canceled = DaftarPoli::whereDate('created_at', date('Y-m-d'))->where('status', 'canceled')->count();
            $pasien_done = DaftarPoli::whereDate('created_at', date('Y-m-d'))->where('status', 'done')->count();
            return view('dashboard.index', compact('pasien_today', 'pasien_waiting', 'pasien_called', 'pasien_canceled', 'pasien_done'));
        } elseif (Auth::user()->role == 'admin') {
            $total_dokter = Dokter::all()->count();
            $total_pasien = Pasien::all()->count();
            $total_poli = Poli::all()->count();
            $total_obat = Obat::all()->count();
            return view('dashboard.index', compact('total_dokter', 'total_pasien', 'total_obat', 'total_poli'));
        } else {
            $pasien = auth()->user()->pasien;

            if (!$pasien) {
                abort(403, 'User does not have a linked Pasien record.');
            }

            $total_antrian_waiting = DaftarPoli::where('pasien_id', $pasien->id)->where('status', 'waiting')->count();
            $total_antrian_done = DaftarPoli::where('pasien_id', $pasien->id)->where('status', 'done')->count();

            return view('dashboard.index', compact('total_antrian_waiting', 'total_antrian_done'));
        }
    }
}
