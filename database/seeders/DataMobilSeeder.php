<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DataMobilSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('data_mobil')->insert([
            [
                'id_mobil' => 'MBL01',
                'nama_mobil' => 'Avanza',
                'merk_mobil' => 'Toyota',
                'tahun_mobil' => 2020,
                'plat_nomor' => 'B1234XYZ',
                'spesifikasi' => 'MPV 7 seater',
                'status_mobil' => 'Tersedia',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_mobil' => 'MBL02',
                'nama_mobil' => 'Xenia',
                'merk_mobil' => 'Daihatsu',
                'tahun_mobil' => 2021,
                'plat_nomor' => 'B5678ABC',
                'spesifikasi' => 'MPV irit BBM',
                'status_mobil' => 'Tersedia',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_mobil' => 'MBL03',
                'nama_mobil' => 'inova',
                'merk_mobil' => 'suzuki',
                'tahun_mobil' => 2016,
                'plat_nomor' => 'BA9876BC',
                'spesifikasi' => 'MPV irit BBM',
                'status_mobil' => 'Tersedia',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
