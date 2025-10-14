<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataMobil extends Model
{
    use HasFactory;

    protected $table = 'data_mobil';
    protected $primaryKey = 'id_mobil';
    public $incrementing = false; // karena primary key string
    protected $keyType = 'string';

    protected $fillable = [
        'id_mobil',
        'nama_mobil',
        'merk_mobil',
        'tahun_mobil',
        'plat_nomor',
        'spesifikasi',
        'foto_mobil',
        'status_mobil',
    ];

    // Relasi ke DataPaket
    public function paket()
    {
        return $this->hasOne(DataPaket::class, 'id_mobil', 'id_mobil');
    }
}
