<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DataPemesanan extends Model
{
    use HasFactory;

    protected $table = 'data_pemesanan';
    protected $primaryKey = 'id_pemesanan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_pemesanan',
        'id_user',
        'id_mobil',
        'id_paket',
        'nomor_transaksi',
        'durasi',
        'tanggal_pemesanan',
        'kota_tujuan',
        'wilayah',
        'tanggal_mulai',
        'tanggal_selesai',
        'status_pemesanan',
        'catatan',
        'denda',
    ];

    /**
     * Konversi otomatis field tanggal ke Carbon instance
     */
    protected $casts = [
        'tanggal_pemesanan' => 'datetime',
        'tanggal_mulai'     => 'datetime',
        'tanggal_selesai'   => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id_pemesanan)) {
                $model->id_pemesanan = 'PM-' . now()->format('Ymd') . '-' . strtoupper(Str::random(5));
            }
            if (empty($model->nomor_transaksi)) {
                $model->nomor_transaksi = 'TRX-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6));
            }
            if (empty($model->tanggal_pemesanan)) {
                $model->tanggal_pemesanan = now();
            }
        });
    }

    // Relasi
    public function user()
    {
        return $this->belongsTo(DataUser::class, 'id_user', 'id_user');
    }

    public function mobil()
    {
        return $this->belongsTo(DataMobil::class, 'id_mobil', 'id_mobil');
    }

    public function paket()
    {
        return $this->belongsTo(DataPaket::class, 'id_paket', 'id_paket');
    }

    public function pembayaran()
    {
        return $this->hasOne(DataPembayaran::class, 'id_pemesanan', 'id_pemesanan');
    }
}
