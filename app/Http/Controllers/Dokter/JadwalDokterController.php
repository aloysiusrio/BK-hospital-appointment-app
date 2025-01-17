<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use App\Models\JadwalPeriksa;
use App\Models\User;
use Illuminate\Http\Request;

class JadwalDokterController extends Controller
{
    public function index()
    {
        $jadwal = JadwalPeriksa::where('dokter_id', auth()->user()->dokter->id)->get();
        return view('dashboard.dokter.jadwal.index', compact('jadwal'));
    }

    public function store(Request $request)
    {
        $user = User::with('dokter')->find(auth()->user()->id);

        $request->validate([
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        // Pastikan jadwal tidak bertabrakan
        // $conflictingSchedule = JadwalPeriksa::where('dokter_id', $user->dokter->id)
        //     ->where('hari', $request->hari)
        //     ->where(function ($query) use ($request) {
        //         $query->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
        //             ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])
        //             ->orWhere(function ($q) use ($request) {
        //                 $q->where('jam_mulai', '<=', $request->jam_mulai)
        //                     ->where('jam_selesai', '>=', $request->jam_selesai);
        //             });
        //     })
        //     ->first();

        // if ($conflictingSchedule) {
        //     $notification = [
        //         'status' => 'error',
        //         'title' => 'Gagal',
        //         'message' => 'Jadwal bertabrakan dengan jadwal lain',
        //     ];
        //     return redirect()->back()->with($notification);
        // }

        $conflictingDaySchedule = JadwalPeriksa::where('dokter_id', $user->dokter->id)
            ->where('hari', $request->hari)            
            ->first();

        if ($conflictingDaySchedule) {
            $notification = [
                'status' => 'error',
                'title' => 'Gagal',
                'message' => 'anda sudah memiliki jadwal di hari ini, silahkan pilih hari lain',
            ];
            return redirect()->back()->with($notification);
        }

        // Nonaktifkan jadwal lain jika ini ditandai sebagai aktif
        if ($request->has('active') && $request->active) {
            JadwalPeriksa::where('dokter_id', $user->dokter->id)->update(['active' => false]);
        }

        // Simpan jadwal baru
        JadwalPeriksa::create([
            'dokter_id' => $user->dokter->id,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'active' => $request->has('active') ? $request->active : false,
        ]);

        $notification = [
            'status' => 'toast_success',
            'title' => 'Berhasil',
            'message' => 'Jadwal berhasil ditambahkan',
        ];

        return redirect()->back()->with($notification);
    }

    public function edit($id)
    {
        $jadwal = JadwalPeriksa::findOrFail($id);
        return view('dashboard.dokter.jadwal.edit', compact('jadwal'));
    }

    public function update(Request $request, $id)
    {
        $jadwal = JadwalPeriksa::findOrFail($id);

        $request->validate([
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        // Cek konflik dengan jadwal lain
        $conflictingSchedule = JadwalPeriksa::where('dokter_id', $jadwal->dokter_id)
            ->where('id', '!=', $id)
            ->where('hari', $request->hari)
            ->where(function ($query) use ($request) {
                $query->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhere(function ($q) use ($request) {
                        $q->where('jam_mulai', '<=', $request->jam_mulai)
                            ->where('jam_selesai', '>=', $request->jam_selesai);
                    });
            })
            ->first();

        if ($conflictingSchedule) {
            return redirect()->back()->with('error', 'Jadwal bertabrakan dengan jadwal lain.');
        }

        $jadwal->update([
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return redirect()->route('dashboard.dokter.jadwal.index')
            ->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function toggleActive($id)
    {
        $jadwal = JadwalPeriksa::findOrFail($id);

        // Nonaktifkan jadwal aktif lainnya
        JadwalPeriksa::where('dokter_id', $jadwal->dokter_id)->update(['active' => false]);

        // Ubah status aktif jadwal ini
        $jadwal->update(['active' => true]);

        return redirect()->route('dashboard.dokter.jadwal.index')
            ->with('success', 'Status jadwal berhasil diubah.');
    }

    public function destroy($id)
    {
        $jadwal = JadwalPeriksa::findOrFail($id);
                
        $jadwal->delete();

        return redirect()->route('dashboard.dokter.jadwal.index')
            ->with('success', 'Jadwal berhasil dihapus.');
    }

}
