<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DataPemesanan;
use App\Models\DataUser;
use App\Models\DataMobil;
use App\Models\DataPaket;
use Illuminate\Support\Str;

class PemesananSeeder extends Seeder
{
    public function run()
    {
        // Ambil sample user, mobil, paket
        $user = DataUser::first() ?? DataUser::factory()->create();
        $mobil = DataMobil::first() ?? DataMobil::factory()->create();
        $paket = DataPaket::first() ?? DataPaket::factory()->create([
            'id_mobil' => $mobil->id_mobil
        ]);

        // Buat 10 pemesanan dummy
        for ($i=1; $i<=10; $i++) {
            DataPemesanan::create([
                'id_pemesanan' => 'PM-'.now()->format('Ymd').'-'.Str::upper(Str::random(5)),
                'id_user' => $user->id_user,
                'id_mobil' => $mobil->id_mobil,
                'id_paket' => $paket->id_paket,
                'nomor_transaksi' => 'TRX-'.now()->format('Ymd').'-'.Str::upper(Str::random(6)),
                'durasi' => rand(1,5),
                'tanggal_mulai' => now()->addDays(rand(0,10)),
                'tanggal_selesai' => now()->addDays(rand(11,20)),
                'kota_tujuan' => 'Kota Sample',
                'wilayah' => 'Wilayah Sample',
                'status_pemesanan' => 'Selesai',
                'catatan' => 'Catatan dummy '.$i,
                'denda' => 0,
            ]);
        }
    }
}
