<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_pembayaran', function (Blueprint $table) {
            $table->string('id_pembayaran', 20)->primary();
            $table->string('id_pemesanan', 20);

            $table->dateTime('tanggal_bayar')->nullable();
            // Ganti ENUM menjadi VARCHAR(30) agar fleksibel
            $table->string('status_bayar', 30)->default('Menunggu Verifikasi');
            $table->unsignedBigInteger('jumlah_bayar')->default(0);
            $table->string('bukti_bayar', 100)->nullable();

            $table->timestamps();

            // Relasi ke pemesanan
            $table->foreign('id_pemesanan')
                  ->references('id_pemesanan')
                  ->on('data_pemesanan')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_pembayaran');
    }
};

