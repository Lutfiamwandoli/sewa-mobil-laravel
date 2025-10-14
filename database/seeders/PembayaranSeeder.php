<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DataPemesanan;
use App\Models\DataPembayaran;

class PembayaranSeeder extends Seeder
{
    public function run()
    {
        $pemesananList = DataPemesanan::all();

        foreach($pemesananList as $pemesanan) {
            $harga_paket = $pemesanan->paket->harga ?? 100000; // default harga
            $jumlah_bayar = $harga_paket + ($pemesanan->denda * $pemesanan->durasi);

            DataPembayaran::create([
                'id_pembayaran' => 'BYR-'.now()->format('Ymd').'-'.strtoupper(\Illuminate\Support\Str::random(5)),
                'id_pemesanan' => $pemesanan->id_pemesanan,
                'jumlah_bayar' => $jumlah_bayar,
                'status_bayar' => 'Belum Lunas',
                'bukti_bayar' => null, // bisa diisi jika ada file
            ]);
        }
    }
}
