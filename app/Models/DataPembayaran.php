<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DataPembayaran extends Model
{
    use HasFactory;

    protected $table = 'data_pembayaran';
    protected $primaryKey = 'id_pembayaran';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_pembayaran',
        'id_pemesanan',
        'tanggal_bayar',
        'status_bayar',
        'jumlah_bayar',
        'bukti_bayar',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id_pembayaran)) {
                $model->id_pembayaran = 'PB-' . now()->format('Ymd') . '-' . strtoupper(Str::random(5));
            }
            if (empty($model->tanggal_bayar)) {
                $model->tanggal_bayar = now();
            }
        });
    }

    // Relasi ke pemesanan
    public function pemesanan()
    {
        return $this->belongsTo(DataPemesanan::class, 'id_pemesanan', 'id_pemesanan');
    }
}
