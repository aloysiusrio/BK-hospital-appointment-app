<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use App\Models\User;
use App\Services\GenerateRMNumberService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PgSql\Lob;

class PasienController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum', 'verified']);
    }

    public function index()
    {
        $pasiens = Pasien::all();
        return view('dashboard.admin.users.pasien.index', compact('pasiens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'name' => 'required',
            'no_ktp' => 'required|unique:pasien,no_ktp',
            'no_hp' => 'required',
            'alamat' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ]);

        try {
            DB::beginTransaction();

            $toUsersTable = [
                'name' => $request->name,
                'email' => $request->email,
                'email_verified_at' => now(),
                'role' => 'pasien',
                'is_active' => 1,
                'password' => bcrypt($request->password),
                'remember_token' => null,
            ];

            $user = User::create($toUsersTable);

            $no_rm = GenerateRMNumberService::generate();

            $toPasienTable = [
                'name' => $request->name,
                'no_ktp' => $request->no_ktp,
                'no_rm' => $no_rm,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'user_id' => $user->id,
            ];

            Pasien::create($toPasienTable);

            DB::commit();
            $notification = array(
                'message' => 'Data berhasil ditambahkan',
                'alert-type' => 'success'
            );

            return Redirect()->back()->with($notification);
        } catch (\Throwable $th) {
            DB::rollback();
            $notification = array(
                'message' => 'Data gagal ditambahkan',
                'alert-type' => 'error'
            );

            return Redirect()->back()->with($notification);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'no_ktp' => 'required|numeric', 
            'email' => 'required|email',   
            'name' => 'required|string',
            'no_hp' => 'required|string',
            'alamat' => 'required|string',
        ]);

        try {
            DB::beginTransaction();

            $user = User::find($id);

            if (!$user) {
                $notification = [
                    'message' => 'Data gagal diubah. User tidak ditemukan.',
                    'alert-type' => 'error'
                ];
                return Redirect()->back()->with($notification);
            }

            // Update tabel `users`
            $user->update([
                'name' => $request->name,
                'email' => $request->email, // Update email di tabel `users`
            ]);

            // Update tabel `pasiens`
            $user->pasien()->update([
                'no_ktp' => $request->no_ktp, // Update no_ktp
                'name' => $request->name,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
            ]);

            DB::commit();
            $notification = [
                'message' => 'Data berhasil diubah',
                'alert-type' => 'success'
            ];

            return Redirect()->back()->with($notification);
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error($th);
            $notification = [
                'message' => 'Data gagal diubah. Terjadi kesalahan.',
                'alert-type' => 'error'
            ];

            return Redirect()->back()->with($notification);
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            $notification = array(
                'message' => 'Data gagal dihapus',
                'alert-type' => 'error'
            );

            return Redirect()->back()->with($notification);
        }

        $user->pasien()->delete();

        $user->delete();

        $notification = array(
            'message' => 'Data berhasil dihapus',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
    }
}
