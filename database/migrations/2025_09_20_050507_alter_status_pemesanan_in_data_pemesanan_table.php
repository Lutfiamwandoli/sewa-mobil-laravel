<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('data_pemesanan', function (Blueprint $table) {
            $table->enum('status_pemesanan', [
                'Menunggu Verifikasi',
                'Menunggu Pembayaran',
                'Diproses',
                'Disetujui',
                'Ditolak',
                'Selesai',
                'Dibatalkan'
            ])->default('Menunggu Verifikasi')->change();
        });
    }

    public function down()
    {
        Schema::table('data_pemesanan', function (Blueprint $table) {
            $table->enum('status_pemesanan', [
                'Menunggu Pembayaran','Selesai','Dibatalkan'
            ])->default('Menunggu Pembayaran')->change();
        });
    }
};
