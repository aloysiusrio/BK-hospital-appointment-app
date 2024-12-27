<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PeriksaController extends Controller
{
    public function index()
    {
        $daftar = DaftarPoli::whereHas('jadwal', function ($query) {
            $query->where('dokter_id', auth()->user()->dokter->id);
        })->get();

        return view('dashboard.dokter.periksa.index', compact('daftar'));
    }

    public function periksaForm($id)
    {
        $daftar = DaftarPoli::findOrfail($id);
        $obats = Obat::all();
        return view('dashboard.dokter.periksa.form', compact('daftar', 'obats'));
    }

    public function periksa(Request $request, $id)
    {
        $daftar = DaftarPoli::findOrfail($id);

        $validation  = $request->validate([
            'tgl_periksa' => 'required|date',
            'catatan' => 'required',
            'obats' => 'required|array',
        ]);

        try {
            DB::beginTransaction();
            $daftar->periksa()->create([
                'tgl_periksa' => $validation['tgl_periksa'],
                'catatan' => $validation['catatan'],
            ]);

            $biaya_periksa = 0;
            foreach ($validation['obats'] as $obat_id) {
                $obat = Obat::findOrfail($obat_id);
                $biaya_periksa += (int) $obat->harga;
                $daftar->periksa->obatDetail()->create([
                    'obat_id' => $obat->id,
                ]);
            }

            $daftar->update([
                'status' => 'done',
            ]);

            $daftar->periksa->update([
                'jumlah' => $biaya_periksa + config('serviceprice.service.price'),
                'biaya_periksa' => $biaya_periksa + config('serviceprice.service.price'),
            ]);

            DB::commit();

            $notification = array(
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Berhasil melakukan pemeriksaan ',
            );
            return redirect()->route('dashboard.dokter.periksa.index')->with($notification);
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error($th);
            $notification = array(
                'status' => 'error',
                'title' => 'Gagal',
                'message' => 'Gagal melakukan pemeriksaan',
            );
            return redirect()->back()->with($notification);
        }
    }

    public function update(Request $request, $id)
    {
        $daftar = DaftarPoli::findOrfail($id);

        $validation = $request->validate([
            'tgl_periksa' => 'required|date',
            'catatan' => 'required',
            'obats' => 'required|array',
        ]);

        try {
            DB::beginTransaction();
            
            $daftar->periksa()->update([
                'tgl_periksa' => $validation['tgl_periksa'],
                'catatan' => $validation['catatan'],
            ]);
        
            $daftar->periksa->obatDetail()->delete();
            
            $biaya_periksa = 0;
            foreach ($validation['obats'] as $obat_id) {
                $obat = Obat::findOrfail($obat_id);
                $biaya_periksa += (int) $obat->harga;

                $daftar->periksa->obatDetail()->create([
                    'obat_id' => $obat->id,
                ]);
            }
            
            $daftar->update([
                'status' => 'done',
            ]);

            $daftar->periksa->update([
                'jumlah' => $biaya_periksa + config('serviceprice.service.price'),
                'biaya_periksa' => $biaya_periksa + config('serviceprice.service.price'),
            ]);

            DB::commit();

            $notification = [
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Berhasil melakukan pemeriksaan',
            ];
            return redirect()->route('dashboard.dokter.periksa.index')->with($notification);
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error($th);

            $notification = [
                'status' => 'error',
                'title' => 'Gagal',
                'message' => 'Gagal melakukan pemeriksaan',
            ];
            return redirect()->back()->with($notification);
        }
    }
}
