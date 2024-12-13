<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\JadwalPeriksa;
use App\Models\Poli;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DokterController extends Controller
{
    public function index()
    {
        $dokters = Dokter::with(['jadwalPeriksa' => function ($query) {
            $query->where('active', true);  
        }])->get();
        $polis = Poli::all();
        $doktersCount = Dokter::count();
        return view('dashboard.admin.users.dokter.index', compact('dokters', 'polis', 'doktersCount'));
    }

    public function store(Request $request)
    {
        $validation  = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:8',
            'no_hp' => 'required|numeric',
            'alamat' => 'required',
            'poli_id' => 'required|exists:poli,id',
        ]);

        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => $validation['name'],
                'email' => $validation['email'],
                'password' => bcrypt($validation['password']),
                'is_active' => true,
                'role' => 'dokter'
            ]);

            $user->dokter()->create([
                'name' => $validation['name'],
                'no_hp' => $validation['no_hp'],
                'alamat' => $validation['alamat'],
                'poli_id' => $validation['poli_id']
            ]);

            DB::commit();
            $notification = array(
                'status' => 'toast_success',
                'title' => 'Dokter berhasil ditambahkan',
                'message' => 'Data dokter berhasil ditambahkan'
            );

            return back()->with($notification);
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error($th);
            $notification = array(
                'status' => 'error',
                'title' => 'Dokter gagal ditambahkan',
                'message' => 'Data dokter gagal ditambahkan'
            );

            return back()->with($notification);
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validation  = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id . ',id',
            'no_hp' => 'required|numeric',
            'alamat' => 'required',
            'poli_id' => 'required|exists:poli,id',
            'is_active' => 'required|in:0,1',
        ]);
        try {
            DB::beginTransaction();

            if (!$user) {
                $notification = array(
                    'status' => 'error',
                    'title' => 'Dokter gagal diupdate',
                    'message' => 'Data dokter gagal diupdate'
                );

                return back()->with($notification);
            } else {
                $user->update([
                    'name' => $validation['name'],
                    'email' => $validation['email'],
                    'password' => $request->password ? bcrypt($validation['password']) : $user->password,
                    'is_active' => $validation['is_active'],
                ]);

                $user->dokter()->update([
                    'name' => $validation['name'],
                    'no_hp' => $validation['no_hp'],
                    'alamat' => $validation['alamat'],
                    'poli_id' => $validation['poli_id']
                ]);

                DB::commit();
                $notification = array(
                    'status' => 'toast_success',
                    'title' => 'Dokter berhasil diupdate',
                    'message' => 'Data dokter berhasil diupdate'
                );

                return back()->with($notification);
            }
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error($th);
            $notification = array(
                'status' => 'error',
                'title' => 'Dokter gagal diupdate',
                'message' => 'Data dokter gagal diupdate'
            );

            return back()->with($notification);
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            $notification = array(
                'status' => 'error',
                'title' => 'Dokter gagal dihapus',
                'message' => 'Data dokter gagal dihapus'
            );

            return back()->with($notification);
        }


        JadwalPeriksa::where('dokter_id', $user->dokter->id)->delete();
        $user->dokter()->delete();
        $user->delete();

        $notification = array(
            'status' => 'toast_success',
            'title' => 'Dokter berhasil dihapus',
            'message' => 'Data dokter berhasil dihapus'
        );

        return back()->with($notification);
    }

    public function editProfile()
    {
        return view('dashboard.dokter.profil.edit');
    }

    public function updateProfile(Request $request)
    {
        $user = User::with('dokter')->find(auth()->user()->id);
        $validation = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'no_hp' => 'required|numeric',
            'alamat' => 'required',
            'password' => 'nullable|min:8',
        ]);

        try {
            DB::beginTransaction();

            $updateData = [
                'name' => $validation['name'],
                'email' => $validation['email'],
            ];
    
            if (!empty($request->password)) {
                $updateData['password'] = bcrypt($request->password);
            }
    
            $user->update($updateData);

            $user->dokter()->update([
                'name' => $validation['name'],
                'no_hp' => $validation['no_hp'],
                'alamat' => $validation['alamat'],
            ]);

            DB::commit();            

            $notification = array(
                'status' => 'toast_success',
                'title' => 'Profil berhasil diperbarui',
                'message' => 'Data profil Anda berhasil diperbarui'
            );
    
            return redirect()->route('dashboard.dokter.profil.edit')->with($notification);
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error($th);
    
            $notification = array(
                'status' => 'error',
                'title' => 'Profil gagal diperbarui',
                'message' => 'Terjadi kesalahan saat memperbarui profil Anda'
            );
    
            return redirect()->route('dashboard.dokter.profil.edit')->with($notification);
        }
    }

}
