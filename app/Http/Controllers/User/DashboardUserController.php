<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\DataPaket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardUserController extends Controller
{
    public function index()
    {
        $reviews = Review::latest()->take(6)->get();

        // join data_paket dengan data_mobil
        $pakets = DB::table('data_paket')
            ->join('data_mobil', 'data_paket.id_mobil', '=', 'data_mobil.id_mobil')
            ->select(
                'data_paket.*',
                'data_mobil.nama_mobil',
                'data_mobil.merk_mobil',
                'data_mobil.tahun_mobil',
                'data_mobil.plat_nomor',
                'data_mobil.spesifikasi',
                'data_mobil.foto_mobil',
                'data_mobil.status_mobil'
            )
            ->paginate(9);

        return view('user.dashboard', [
            'username' => session('username'),
            'role'     => session('role'),
            'reviews'  => $reviews,
            'pakets'   => $pakets,
        ]);
    }

public function search(Request $request)
{
    $request->validate([
        'lokasi'           => 'nullable|string|max:100',
        'wilayah'          => 'nullable|string|max:100',
        'paket'            => 'nullable|string|max:100',
        'tanggal_mulai'    => 'nullable|date',
        'tanggal_selesai'  => 'nullable|date|after_or_equal:tanggal_mulai',
    ]);

    $pakets = DB::table('data_paket')
        ->join('data_mobil', 'data_paket.id_mobil', '=', 'data_mobil.id_mobil')
        ->select(
            'data_paket.*',
            'data_mobil.nama_mobil',
            'data_mobil.merk_mobil',
            'data_mobil.tahun_mobil',
            'data_mobil.plat_nomor',
            'data_mobil.spesifikasi',
            'data_mobil.foto_mobil',
            'data_mobil.status_mobil'
        )
        ->when($request->lokasi, function ($query, $lokasi) {
            $query->where('data_paket.lokasi', 'LIKE', "%{$lokasi}%");
        })
        ->when($request->wilayah, function ($query, $wilayah) {
            $query->where('data_paket.wilayah', $wilayah);
        })
        ->when($request->paket, function ($query, $paket) {
            $query->where('data_paket.nama_paket', 'LIKE', "%{$paket}%");
        })
        ->paginate(9);

    return view('user.result', [
        'username' => session('username'),
        'role'     => session('role'),
        'pakets'   => $pakets,
        'tanggal_mulai'   => $request->tanggal_mulai,
        'tanggal_selesai' => $request->tanggal_selesai,
        'lokasi'          => $request->lokasi,
        'wilayah'         => $request->wilayah,
        'paket'           => $request->paket,
    ]);
}


  
}
