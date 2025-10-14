<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
    Schema::create('data_pemesanan', function (Blueprint $table) {
    $table->string('id_pemesanan', 20)->primary();

    // Foreign Keys
    $table->string('id_user', 20);
    $table->string('id_mobil', 10);
    $table->string('id_paket', 10);

    $table->string('nomor_transaksi', 50)->unique();
    $table->integer('durasi');
    $table->dateTime('tanggal_pemesanan');
    $table->string('kota_tujuan', 100);
    $table->string('wilayah', 100)->nullable();   
    $table->dateTime('tanggal_mulai');
    $table->dateTime('tanggal_selesai');
    $table->dateTime('waktu_pengembalian')->nullable();
    $table->enum('status_pemesanan', [
        'Menunggu Pembayaran','Selesai','Dibatalkan'
    ])->default('Menunggu Pembayaran');
    $table->text('catatan')->nullable();
    $table->unsignedBigInteger('denda')->default(0);

    $table->timestamps();

    // Relasi
    $table->foreign('id_user')->references('id_user')->on('data_user')->onDelete('cascade');
    $table->foreign('id_mobil')->references('id_mobil')->on('data_mobil')->onDelete('cascade');
    $table->foreign('id_paket')->references('id_paket')->on('data_paket')->onDelete('cascade');
});

    }

    public function down(): void
    {
        Schema::dropIfExists('data_pemesanan');
    }
};
