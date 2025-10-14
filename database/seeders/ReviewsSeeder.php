<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewsSeeder extends Seeder
{
    public function run(): void
    {
        Review::create([
            'nama' => 'Budi',
            'rating' => 5,
            'mobil' => 'Toyota Avanza',
            'komentar' => 'Pelayanan sangat memuaskan, mobil bersih dan nyaman!',
        ]);

        Review::create([
            'nama' => 'Sinta',
            'rating' => 4,
            'mobil' => 'Honda Brio',
            'komentar' => 'Harga terjangkau dan proses cepat. Recommended!',
        ]);
    }
}
