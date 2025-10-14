<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paket;
use App\Models\DataMobil; // ⬅️ gunakan model yang benar

class CarController extends Controller
{
    public function search(Request $request)
    {
        $wilayah      = $request->input('wilayah');
        $tujuan_kota  = $request->input('tujuan_kota');
        $paket        = $request->input('paket');
        $tgl_mulai    = $request->input('tanggal_mulai');
        $tgl_selesai  = $request->input('tanggal_selesai');

        $pakets = Paket::query()
            ->when($wilayah, fn($q) => $q->where('wilayah', $wilayah))
            ->when($tujuan_kota, fn($q) => $q->where('tujuan_kota', $tujuan_kota))
            ->when($paket, fn($q) => $q->where('nama_paket', $paket))
            ->when($tgl_mulai, fn($q) => $q->whereDate('tanggal_mulai', '>=', $tgl_mulai))
            ->when($tgl_selesai, fn($q) => $q->whereDate('tanggal_selesai', '<=', $tgl_selesai))
            ->paginate(9);

        return view('user.index', compact('pakets', 'wilayah', 'tujuan_kota', 'paket', 'tgl_mulai', 'tgl_selesai'));
    }

    public function index()
    {
        $mobils = DataMobil::paginate(9); // ⬅️ ambil data dari DataMobil
        return view('mobil.index', compact('mobils'));
    }

    public function show(Request $request, $id_mobil)
{
    $mobil = DataMobil::with('paket')->findOrFail($id_mobil);

    // Ambil query string dari search
    $tanggal_mulai = $request->query('tanggal_mulai');
    $tanggal_selesai = $request->query('tanggal_selesai');
    $tujuan_kota = $request->query('tujuan_kota');

    return view('user.detail', compact(
        'mobil', 'tanggal_mulai', 'tanggal_selesai', 'tujuan_kota'
    ));
}


}
