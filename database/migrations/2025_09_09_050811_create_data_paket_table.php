<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_paket', function (Blueprint $table) {
            $table->string('id_paket', 10)->primary();
            $table->string('id_mobil', 10); // relasi ke data_mobil
            $table->enum('nama_paket', ['Lepas Kunci', 'Driver tanpa BBM']);
            $table->enum('wilayah', [
                'Dalam Kota',
                'Jawa Tengah dan DIY',
                'Luar Jawa Tengah dan DIY'
            ]);
            $table->enum('tujuan_kota', [
                'Bandung','Jakarta','Magelang','Pekalongan',
                'Semarang','Surabaya','Yogyakarta'
            ]);
            $table->integer('harga');
            $table->text('deskripsi')->nullable();
            $table->timestamps();

            // foreign key ke tabel data_mobil
            $table->foreign('id_mobil')
                  ->references('id_mobil')
                  ->on('data_mobil')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_paket');
    }
};
