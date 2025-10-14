<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataPembayaran;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayarans = DataPembayaran::with(['pemesanan.user'])->get();
        return view('admin.pembayaran.index', compact('pembayarans'));
    }

   public function edit($id)
{
    // Ambil data pembayaran beserta relasinya
    $pembayaran = DataPembayaran::with(['pemesanan.user', 'pemesanan.paket', 'pemesanan.mobil'])
                    ->find($id);

    if (!$pembayaran) {
        return redirect()->route('admin.pembayaran.index')
            ->with('error', 'Data pembayaran tidak ditemukan!');
    }

    return view('admin.pembayaran.edit', compact('pembayaran'));
}


   public function update(Request $request, $id)
{
    $pembayaran = DataPembayaran::with('pemesanan.paket')->findOrFail($id);

    $request->validate([
        'denda' => 'nullable|numeric|min:0',
        'status_bayar' => 'required|in:Lunas,Belum Lunas,Menunggu Verifikasi'
    ]);

    // Hanya update denda jika pembayaran belum Lunas
    if($pembayaran->status_bayar != 'Lunas'){
        $pembayaran->pemesanan->denda = (int) ($request->denda ?? 0);

        // Hitung ulang jumlah bayar
        $harga_sewa = (int) ($pembayaran->pemesanan->paket->harga ?? 0);
        $durasi     = (int) ($pembayaran->pemesanan->durasi ?? 1);
        $denda      = (int) ($pembayaran->pemesanan->denda ?? 0);

        $pembayaran->jumlah_bayar = ($harga_sewa * $durasi) + ($denda * $durasi);

        $pembayaran->pemesanan->save();
    }

    $pembayaran->status_bayar = $request->status_bayar;
    $pembayaran->save();

    return redirect()->route('admin.pembayaran.index')->with('success', 'Pembayaran berhasil diupdate!');
}

}
