<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    protected $table = 'data_mobil';
    protected $primaryKey = 'id_mobil';
    public $incrementing = false; // karena primary key bukan auto increment
    protected $keyType = 'string';

    protected $fillable = [
        'id_mobil',
        'nama_mobil',
        'merk_mobil',
        'tahun_mobil',
        'plat_nomor',
        'spesifikasi',
        'foto_mobil',
        'status_mobil'
    ];
    public function paket()
{
    return $this->hasOne(DataPaket::class, 'id_mobil', 'id_mobil');
}

}
