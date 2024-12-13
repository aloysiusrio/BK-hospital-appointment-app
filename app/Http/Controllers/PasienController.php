<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoli;
use App\Models\JadwalPeriksa;
use App\Models\Pasien;
use App\Models\User;
use App\Services\GenerateRMNumberService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PasienController extends Controller
{
    public function register(Request $request)
    {

        try {
            DB::beginTransaction();
            $request->validate([
                'name' => 'required',
                'alamat' => 'required',
                'no_ktp' => 'required|unique:pasien,no_ktp',
                'no_hp' => 'required',
                'email' => 'required|unique:users,email',
                'password' => 'required|min:6',
            ]);

            $no_rm = GenerateRMNumberService::generate();

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => 'pasien',
                'password' => bcrypt($request->password),
                'is_active' => 1,
            ]);

            $pasien = Pasien::create([
                'name' => $request->name,
                'alamat' => $request->alamat,
                'no_ktp' => $request->no_ktp,
                'no_hp' => $request->no_hp,
                'no_rm' => $no_rm,
                'user_id' => $user->id,
            ]);

            DB::commit();
            $notification = array(
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Pendaftaran berhasil',
            );
            return redirect()->route('login')->with($notification);
        } catch (\Throwable $th) {
            DB::rollBack();
            $notification = array(
                'status' => 'error',
                'title' => 'Gagal',
                'message' => 'Pendaftaran gagal',
            );
            return redirect()->back()->with($notification);
        }
    }
}
