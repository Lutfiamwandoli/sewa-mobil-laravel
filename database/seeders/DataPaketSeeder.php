<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataPaketSeeder extends Seeder
{
    public function run(): void
    {
        $pakets = [
            [
                'id_paket' => 'P001',
                'id_mobil' => 'MBL01',
                'nama_paket' => 'Lepas Kunci',
                'wilayah' => 'Dalam Kota',
                'tujuan_kota' => 'Semarang',
                'harga' => 300000,
                'deskripsi' => 'Rental mobil lepas kunci dalam kota Semarang',
            ],
            [
                'id_paket' => 'P002',
                'id_mobil' => 'MBL02',
                'nama_paket' => 'Driver tanpa BBM',
                'wilayah' => 'Jawa Tengah dan DIY',
                'tujuan_kota' => 'Yogyakarta',
                'harga' => 500000,
                'deskripsi' => 'Driver tanpa BBM ke Yogyakarta',
            ],
            [
                'id_paket' => 'P003',
                'id_mobil' => 'MBL03',
                'nama_paket' => 'Lepas Kunci',
                'wilayah' => 'Luar Jawa Tengah dan DIY',
                'tujuan_kota' => 'Jakarta',
                'harga' => 800000,
                'deskripsi' => 'Rental mobil ke Jakarta dengan sistem lepas kunci',
            ],
            [
                'id_paket' => 'P004',
                'id_mobil' => 'MBL01',
                'nama_paket' => 'Driver tanpa BBM',
                'wilayah' => 'Jawa Tengah dan DIY',
                'tujuan_kota' => 'Magelang',
                'harga' => 450000,
                'deskripsi' => 'Driver tanpa BBM untuk tujuan Magelang',
            ],
            [
                'id_paket' => 'P005',
                'id_mobil' => 'MBL02',
                'nama_paket' => 'Lepas Kunci',
                'wilayah' => 'Dalam Kota',
                'tujuan_kota' => 'Pekalongan',
                'harga' => 350000,
                'deskripsi' => 'Rental mobil lepas kunci Pekalongan',
            ],
        ];

        foreach ($pakets as $paket) {
            DB::table('data_paket')->insert(array_merge($paket, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
