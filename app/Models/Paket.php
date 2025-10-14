<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    protected $table = 'data_paket'; // ganti ke nama tabel yang benar
    protected $primaryKey = 'id_paket';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_paket',
        'id_mobil',
        'nama_paket',
        'wilayah',
        'tujuan_kota',
        'harga',
        'deskripsi',
    ];
}
