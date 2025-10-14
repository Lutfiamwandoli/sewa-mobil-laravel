<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataPaket;
use App\Models\DataMobil;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaketController extends Controller
{
    public function index()
    {
        $pakets = DataPaket::with('mobil')->get();
        return view('admin.paket.index', compact('pakets'));
    }

    public function create()
    {
        $mobils = DataMobil::all();
        return view('admin.paket.create', compact('mobils'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_mobil' => 'required',
            'nama_paket' => 'required',
            'wilayah' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable',
        ]);

        $paket = new DataPaket();
$paket->id_paket = Str::random(10); // akan cocok dengan VARCHAR(10)
        $paket->id_mobil = $request->id_mobil;
        $paket->nama_paket = $request->nama_paket;
        $paket->wilayah = $request->wilayah;
        $paket->harga = $request->harga;
        $paket->deskripsi = $request->deskripsi;
        $paket->save();

        return redirect()->route('paket.index')->with('success', 'Paket berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $paket = DataPaket::findOrFail($id);
        $mobils = DataMobil::all();
        return view('admin.paket.edit', compact('paket', 'mobils'));
    }

    public function update(Request $request, $id)
    {
        $paket = DataPaket::findOrFail($id);

        $request->validate([
            'id_mobil' => 'required',
            'nama_paket' => 'required',
            'wilayah' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable',
        ]);

        $paket->id_mobil = $request->id_mobil;
        $paket->nama_paket = $request->nama_paket;
        $paket->wilayah = $request->wilayah;
        $paket->harga = $request->harga;
        $paket->deskripsi = $request->deskripsi;
        $paket->save();

        return redirect()->route('paket.index')->with('success', 'Paket berhasil diupdate!');
    }

    public function destroy($id)
    {
        $paket = DataPaket::findOrFail($id);
        $paket->delete();

        return redirect()->route('paket.index')->with('success', 'Paket berhasil dihapus!');
    }
}
