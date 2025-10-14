<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataMobil as Mobil;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MobillController extends Controller
{
    public function index()
    {
        $mobils = Mobil::all();
        return view('admin.mobill.index', compact('mobils'));
    }

    public function create()
    {
        return view('admin.mobill.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'plat_nomor' => 'required|unique:data_mobil,plat_nomor',
            'nama_mobil' => 'required',
            'merk_mobil' => 'required',
            'tahun_mobil' => 'required|numeric',
            'spesifikasi' => 'nullable',
            'status_mobil' => 'required',
            'foto_mobil' => 'nullable|image|max:2048',
        ]);

        $mobil = new Mobil();
        $mobil->id_mobil = Str::uuid()->toString();
        $mobil->plat_nomor = $request->plat_nomor;
        $mobil->nama_mobil = $request->nama_mobil;
        $mobil->merk_mobil = $request->merk_mobil;
        $mobil->tahun_mobil = $request->tahun_mobil;
        $mobil->spesifikasi = $request->spesifikasi;
        $mobil->status_mobil = $request->status_mobil;

        if ($request->hasFile('foto_mobil')) {
            $file = $request->file('foto_mobil');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/mobil'), $filename);
            $mobil->foto_mobil = 'uploads/mobil/'.$filename;
        }

        $mobil->save();

        return redirect()->route('mobill.index')->with('success', 'Mobil berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $mobil = Mobil::findOrFail($id);
        return view('admin.mobill.edit', compact('mobil'));
    }

    public function update(Request $request, $id)
    {
        $mobil = Mobil::findOrFail($id);

        $request->validate([
            'plat_nomor' => 'required|unique:data_mobil,plat_nomor,'.$mobil->id_mobil.',id_mobil',
            'nama_mobil' => 'required',
            'merk_mobil' => 'required',
            'tahun_mobil' => 'required|numeric',
            'spesifikasi' => 'nullable',
            'status_mobil' => 'required',
            'foto_mobil' => 'nullable|image|max:2048',
        ]);

        $mobil->plat_nomor = $request->plat_nomor;
        $mobil->nama_mobil = $request->nama_mobil;
        $mobil->merk_mobil = $request->merk_mobil;
        $mobil->tahun_mobil = $request->tahun_mobil;
        $mobil->spesifikasi = $request->spesifikasi;
        $mobil->status_mobil = $request->status_mobil;

        if ($request->hasFile('foto_mobil')) {
            $file = $request->file('foto_mobil');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/mobil'), $filename);
            $mobil->foto_mobil = 'uploads/mobil/'.$filename;
        }

        $mobil->save();

        return redirect()->route('mobill.index')->with('success', 'Mobil berhasil diupdate!');
    }

    public function destroy($id)
    {
        $mobil = Mobil::findOrFail($id);
        if ($mobil->foto_mobil && file_exists(public_path($mobil->foto_mobil))) {
            unlink(public_path($mobil->foto_mobil));
        }
        $mobil->delete();

        return redirect()->route('mobill.index')->with('success', 'Mobil berhasil dihapus!');
    }
}
