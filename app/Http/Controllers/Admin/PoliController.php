<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Poli;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    public function index()
    {
        $polis = Poli::all();
        return view('dashboard.admin.poli.index', compact('polis'));
    }

    public function store(Request $request)
    {
        $validation  = $request->validate([
            'name' => 'required',
            'keterangan' => 'required'
        ]);

        Poli::create($validation);

        $notification = array(
            'status' => 'toast_success',
            'title' => 'Poli berhasil ditambahkan',
            'message' => 'Data poli berhasil ditambahkan'
        );

        return back()->with($notification);
    }

    public function update(Request $request, $id)
    {
        $validation  = $request->validate([
            'name' => 'required',
            'keterangan' => 'required'
        ]);

        $poli = Poli::find($id);

        if (!$poli) {
            $notification = array(
                'status' => 'error',
                'title' => 'Poli tidak ditemukan',
                'message' => 'Data poli tidak ditemukan'
            );

            return back()->with($notification);
        }

        $poli->update($validation);

        $notification = array(
            'status' => 'toast_success',
            'title' => 'Poli berhasil diupdate',
            'message' => 'Data poli berhasil diupdate'
        );

        return back()->with($notification);
    }

    public function destroy($id)
    {
        $poli = Poli::find($id);

        if (!$poli) {
            $notification = array(
                'status' => 'error',
                'title' => 'Poli tidak ditemukan',
                'message' => 'Data poli tidak ditemukan'
            );

            return back()->with($notification);
        }

        $poli->delete();

        $notification = array(
            'status' => 'toast_success',
            'title' => 'Poli berhasil dihapus',
            'message' => 'Data poli berhasil dihapus'
        );

        return back()->with($notification);
    }
}
