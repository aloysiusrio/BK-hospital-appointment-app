<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index()
    {
        $obats = Obat::all();
        return view('dashboard.admin.obat.index', compact('obats'));
    }

    public function store(Request $request)
    {
            $validation = $request->validate([
                'name' => 'required',
                'kemasan' => 'required',
                'harga' => 'required|numeric|min:1',
            ]);
        

        Obat::create($validation);

        $notification = array(
            'status' => 'toast_success',
            'title' => 'Data obat berhasil ditambahkan',
            'message' => 'Data obat berhasil ditambahkan'
        );

        return redirect()->route('dashboard.admin.obat.index')->with($notification);
    }

    public function update(Request $request, $id)
    {
        $obat = Obat::findOrfail($id);

        $validation = $request->validate([
            'name' => 'required',
            'kemasan' => 'required',
            'harga' => 'required|numeric|min:1',
        ]);        

        $obat->update($validation);

        $notification = array(
            'status' => 'toast_success',
            'title' => 'Data obat berhasil diubah',
            'message' => 'Data obat berhasil diubah'
        );

        return redirect()->route('dashboard.admin.obat.index')->with($notification);
    }

    public function destroy($id)
    {
        $obat = Obat::findOrfail($id);

        $obat->delete();

        $notification = array(
            'status' => 'toast_success',
            'title' => 'Data obat berhasil dihapus',
            'message' => 'Data obat berhasil dihapus'
        );

        return redirect()->route('dashboard.admin.obat.index')->with($notification);
    }
}
