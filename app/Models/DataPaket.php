<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPaket extends Model
{
    use HasFactory;

    protected $table = 'data_paket';
    protected $primaryKey = 'id_paket';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_paket',
        'id_mobil',   // foreign key
        'nama_paket',
        'wilayah',
        'harga',
        'deskripsi',
    ];

    public function mobil()
    {
        return $this->belongsTo(DataMobil::class, 'id_mobil', 'id_mobil');
    }
}
