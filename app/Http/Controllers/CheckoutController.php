<?php

namespace App\Http\Controllers;

use App\Models\DataMobil;
use App\Models\DataPaket;
use App\Models\DataPemesanan;
use App\Models\DataPembayaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CheckoutController extends Controller
{
     public function index(Request $request, $mobilId, $paketId)
    {
        $mobil = DataMobil::with('paket')->findOrFail($mobilId);
        $paket = $mobil->paket()->where('id_paket', $paketId)->firstOrFail();

        // langsung ambil dari Auth
        $user = Auth::user();

        $tanggal_mulai   = $request->query('tanggal_mulai');
        $tanggal_selesai = $request->query('tanggal_selesai');
        $kota            = $request->query('kota');

        $durasi = 0;
        $totalHarga = 0;
        if ($tanggal_mulai && $tanggal_selesai) {
            $durasi = Carbon::parse($tanggal_mulai)->diffInDays(Carbon::parse($tanggal_selesai)) + 1;
            $totalHarga = $paket->harga * $durasi;
        }

        return view('user.checkout.index', compact(
            'mobil', 'paket', 'user', 'tanggal_mulai', 'tanggal_selesai', 'kota', 'durasi', 'totalHarga'
        ));
    }

    // Simpan pemesanan
    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required',
            'id_mobil' => 'required',
            'id_paket' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'kota_tujuan' => 'required',
        ]);

        $tanggalMulai = Carbon::parse($request->tanggal_mulai);
        $tanggalSelesai = Carbon::parse($request->tanggal_selesai);
        $durasi = $tanggalMulai->diffInDays($tanggalSelesai) + 1;

        $pemesanan = DataPemesanan::create([
            'id_user'         => $request->id_user,
            'id_mobil'        => $request->id_mobil,
            'id_paket'        => $request->id_paket,
            'durasi'          => $durasi,
            'tanggal_mulai'   => $tanggalMulai,
            'tanggal_selesai' => $tanggalSelesai,
            'kota_tujuan'     => $request->kota_tujuan,
            'wilayah'         => $request->wilayah,
            'catatan'         => $request->catatan,
            'status_pemesanan'=> 'Menunggu Verifikasi',
        ]);

        return redirect()->route('checkout.payment', $pemesanan->id_pemesanan)
                         ->with('success', 'Pemesanan berhasil disimpan.');
    }

    // Halaman pembayaran
    public function payment($id)
    {
        $pemesanan = DataPemesanan::with(['user', 'mobil', 'paket'])->findOrFail($id);

        $durasi = Carbon::parse($pemesanan->tanggal_mulai)
                  ->diffInDays(Carbon::parse($pemesanan->tanggal_selesai)) + 1;

        $totalBayar = ($pemesanan->paket->harga * $durasi) + (($pemesanan->denda ?? 0) * $durasi);

        return view('user.checkout.payment', compact('pemesanan', 'durasi', 'totalBayar'));
    }

    // Upload bukti pembayaran
    public function uploadPayment(Request $request, $id)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $pemesanan = DataPemesanan::with('paket')->findOrFail($id);

        $fileName = null;
        if ($request->hasFile('bukti_pembayaran')) {
            $fileName = 'bukti_' . $pemesanan->id_pemesanan . '.' .
                        $request->file('bukti_pembayaran')->getClientOriginalExtension();

            $request->file('bukti_pembayaran')->storeAs('public/bukti', $fileName);
        }

        $durasi = Carbon::parse($pemesanan->tanggal_mulai)
                  ->diffInDays(Carbon::parse($pemesanan->tanggal_selesai)) + 1;

        $jumlahBayar = ($pemesanan->paket->harga * $durasi) + (($pemesanan->denda ?? 0) * $durasi);

        DataPembayaran::updateOrCreate(
            ['id_pemesanan' => $pemesanan->id_pemesanan],
            [
                'id_pembayaran' => 'BYR-' . now()->format('YmdHis'),
                'tanggal_bayar' => now(),
                'status_bayar'  => 'Menunggu Verifikasi',
                'jumlah_bayar'  => $jumlahBayar,
                'bukti_bayar'   => $fileName,
            ]
        );

        // setelah upload bukti → redirect ke invoice
        return redirect()->route('checkout.invoice', $pemesanan->id_pemesanan)
                         ->with('success', 'Bukti pembayaran berhasil dikirim!');
    }

    // Halaman Invoice
    public function invoice($id)
    {
        $pemesanan = DataPemesanan::with(['user','mobil','paket','pembayaran'])->findOrFail($id);

        $durasi = Carbon::parse($pemesanan->tanggal_mulai)
            ->diffInDays(Carbon::parse($pemesanan->tanggal_selesai)) + 1;

        $subtotal = ($pemesanan->paket->harga * $durasi) + (($pemesanan->denda ?? 0) * $durasi);
        $biayaAplikasi = 0;
        $total = $subtotal + $biayaAplikasi;

        return view('user.checkout.invoice', compact(
            'pemesanan','durasi','subtotal','biayaAplikasi','total'
        ));
    }
}
