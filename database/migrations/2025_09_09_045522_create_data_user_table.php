<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_user', function (Blueprint $table) {
            $table->string('id_user', 20)->primary();
            $table->string('nama', 100);
            $table->unsignedBigInteger('nik')->unique(); // pakai lowercase & unique
            $table->string('username', 50)->unique();
            $table->string('password', 255); // hash bcrypt panjangnya 60
            $table->string('email', 100)->unique();
            $table->string('no_telepon', 20)->nullable();
            $table->enum('jenis_kelamin', ['Pria', 'Wanita']);
            $table->enum('role', ['Admin', 'Manajer', 'Penyewa'])->default('Penyewa');
            $table->string('foto', 255)->nullable(); // panjangin biar cukup untuk path file
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_user');
    }
};
