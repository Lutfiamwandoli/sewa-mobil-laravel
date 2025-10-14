<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataPemesanan;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
     public function index()
    {
        $pemesanan = DataPemesanan::with(['user', 'mobil', 'paket', 'pembayaran'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.pemesanan.index', compact('pemesanan'));
    }

    public function show($id)
    {
        $pemesanan = DataPemesanan::with(['user', 'mobil', 'paket', 'pembayaran'])->findOrFail($id);
        return view('admin.pemesanan.show', compact('pemesanan'));
    }


    public function destroy($id)
    {
        $pemesanan = DataPemesanan::findOrFail($id);
        $pemesanan->delete();
        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan berhasil dihapus!');
    }
}
