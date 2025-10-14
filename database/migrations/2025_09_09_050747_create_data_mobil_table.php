<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_mobil', function (Blueprint $table) {
            $table->string('id_mobil', 10)->primary();
            $table->string('nama_mobil', 50);
            $table->string('merk_mobil', 50);
            $table->integer('tahun_mobil');
            $table->string('plat_nomor', 10)->unique();
            $table->text('spesifikasi')->nullable();
            $table->string('foto_mobil', 50)->nullable();
            $table->enum('status_mobil', ['Tersedia', 'Disewa', 'Maintenance'])->default('Tersedia');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_mobil');
    }
};
