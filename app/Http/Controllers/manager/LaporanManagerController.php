<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\DataPemesanan;
use Carbon\Carbon;
use App\Models\DataPembayaran;
use Illuminate\Http\Request;

class LaporanManagerController extends Controller
{
    // Laporan Pemesanan
    public function pemesanan()
    {
        $pemesanan = DataPemesanan::with(['user', 'mobil', 'paket', 'pembayaran'])->get();
        return view('manager.laporan.pemesanan.index', compact('pemesanan'));
    }

    public function pemesananDetail($id)
    {
        $p = DataPemesanan::with(['user', 'mobil', 'paket', 'pembayaran'])->findOrFail($id);
        return view('manager.laporan.pemesanan.detail', compact('p'));
    }
public function pemesananCetak(Request $request, $id = null)
    {
        // Jika ada id -> detail single
        if ($id) {
            $p = DataPemesanan::with(['user','mobil','paket','pembayaran'])->findOrFail($id);

            // pakai request range kalau diberikan, kalau tidak fallback ke model
            $dari = $request->get('dari');
            $sampai = $request->get('sampai');

            $tanggal_awal = $dari ? Carbon::parse($dari)->format('d-m-Y') 
                                  : ($p->tanggal_pemesanan ? $p->tanggal_pemesanan->format('d-m-Y') : now()->format('d-m-Y'));

            $tanggal_akhir = $sampai ? Carbon::parse($sampai)->format('d-m-Y')
                                     : ($p->tanggal_selesai ? $p->tanggal_selesai->format('d-m-Y') : now()->format('d-m-Y'));

            $pdf = Pdf::loadView('manager.laporan.pemesanan.cetak', compact('p','tanggal_awal','tanggal_akhir'))
                      ->setPaper('a4','landscape');

            return $pdf->download("laporan-pemesanan-{$p->id_pemesanan}.pdf");
        }

        // Jika tidak ada id -> list (range optional)
        $dari = $request->get('dari');
        $sampai = $request->get('sampai');

        $tanggal_awal = $dari ? Carbon::parse($dari)->format('d-m-Y') : now()->startOfMonth()->format('d-m-Y');
        $tanggal_akhir = $sampai ? Carbon::parse($sampai)->format('d-m-Y') : now()->endOfMonth()->format('d-m-Y');

        $query = DataPemesanan::with(['user','mobil','paket','pembayaran']);
        if ($dari && $sampai) {
            $query->whereBetween('tanggal_pemesanan', [$dari, $sampai]);
        }
        $pemesanan = $query->get();

        $pdf = Pdf::loadView('manager.laporan.pemesanan.cetak', compact('pemesanan','tanggal_awal','tanggal_akhir'))
                  ->setPaper('a4','landscape');

        return $pdf->download('laporan-pemesanan.pdf');
    }

    // Laporan Pembayaran
    public function pembayaran()
    {
        $pembayaran = DataPembayaran::with('pemesanan.user')->get();
        return view('manager.laporan.pembayaran.index', compact('pembayaran'));
    }

    public function pembayaranDetail($id)
    {
        $p = DataPembayaran::with('pemesanan.user', 'pemesanan.mobil', 'pemesanan.paket')->findOrFail($id);
        return view('manager.laporan.pembayaran.detail', compact('p'));
    }

public function pembayaranCetak(Request $request)
{
    // Ambil filter tanggal (kalau ada)
    $dari   = $request->get('dari') ?? Carbon::now()->startOfMonth()->toDateString();
    $sampai = $request->get('sampai') ?? Carbon::now()->endOfMonth()->toDateString();

    // Ambil data pembayaran + relasi
    $pembayaran = DataPembayaran::with(['pemesanan.user', 'pemesanan.mobil', 'pemesanan.paket'])
        ->whereBetween('created_at', [$dari, $sampai])
        ->get();

    // Generate PDF
    $pdf = Pdf::loadView('manager.laporan.pembayaran.cetak', [
                'pembayaran' => $pembayaran,
                'dari'       => Carbon::parse($dari)->format('d-m-Y'),
                'sampai'     => Carbon::parse($sampai)->format('d-m-Y')
            ])
            ->setPaper('a4', 'portrait');

    return $pdf->download("laporan-pembayaran-{$dari}-{$sampai}.pdf");
}
}
