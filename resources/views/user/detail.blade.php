@extends('layouts.app')
@php
    use Illuminate\Support\Facades\Auth;
@endphp

@section('content')
<div style="max-width: 900px; margin: 20px auto; padding: 20px; background: #fff; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); font-family: Arial, sans-serif;">

    <!-- Gambar -->
    <div style="text-align: center; margin-bottom: 20px;">
        <img src="{{ asset('storage/mobil/'.$mobil->foto_mobil) }}" 
             alt="{{ $mobil->nama_mobil }}" 
             style="width: 100%; max-height: 400px; object-fit: cover; border-radius: 10px;">
    </div>

    <!-- Nama Mobil -->
    <h2 style="font-size: 22px; font-weight: bold; margin-bottom: 5px; text-align: left; color: #111;">
        {{ $mobil->nama_mobil }} {{ $mobil->tahun_mobil }}
    </h2>

    <!-- Lokasi -->
    <div style="margin: 20px 0; border-top: 1px solid #ddd; padding-top: 15px;">
        <h3 style="font-size: 16px; font-weight: bold; margin-bottom: 10px;">Lokasi PUSKOPKA Jateng</h3>
        <p style="margin: 4px 0;"><b>Provinsi:</b> Jawa Tengah</p>
        <p style="margin: 4px 0;"><b>Kota:</b> Semarang</p>
        <p style="margin: 4px 0;"><b>Kecamatan:</b> Semarang Utara</p>
        <p style="margin: 4px 0;"><b>Alamat:</b> Jl. Merak no. 2, Tanjung Mas, Kec. Semarang Utara, Kota Semarang, Jawa Tengah 50174</p>
    </div>

    <!-- Detail Kendaraan -->
    <div style="margin: 20px 0; border-top: 1px solid #ddd; padding-top: 15px;">
        <h3 style="font-size: 16px; font-weight: bold; margin-bottom: 10px;">Detail Kendaraan</h3>
        <div style="display: flex; flex-wrap: wrap; gap: 30px;">
            <div>
                <p><b>Kapasitas Penumpang:</b> 5 Orang</p>
                <p><b>Tahun Produksi:</b> {{ $mobil->tahun_mobil }}</p>
                <p><b>Bahan Bakar:</b> Pertalite</p>
                <p><b>Warna:</b> Putih</p>
            </div>
            <div>
    <p><b>Spesifikasi:</b></p>
    <ul style="margin-left: 20px; list-style-type: disc; line-height: 1.6;">
        @foreach(explode("\n", $mobil->spesifikasi) as $spesifikasi)
            <li>{{ $spesifikasi }}</li>
        @endforeach
    </ul>
</div>

        </div>
    </div>

    <!-- Harga -->
<div style="margin: 20px 0; border-top: 1px solid #ddd; padding-top: 15px;">
    <h3 style="font-size: 16px; font-weight: bold; margin-bottom: 10px;">Harga Sewa</h3>

    @if($mobil->paket && $mobil->paket->first())
        <span style="font-weight: bold; color: #111;">
            Rp {{ number_format($mobil->paket->harga, 0, ',', '.') }}/hari
        </span>
    @else
        <p>Belum ada harga untuk mobil ini.</p>
    @endif
</div><!-- Tombol Pesan -->
@if(Auth::check())
    <a href="{{ route('checkout.index', [
            'mobil' => $mobil->id_mobil,
            'paket' => $mobil->paket->id_paket
        ]) }}?tanggal_mulai={{ request()->query('tanggal_mulai') }}
   &tanggal_selesai={{ request()->query('tanggal_selesai') }}&kota={{ request('tujuan_kota') ?? '' }}"
       style="display:block; width:100%; text-align:center; background:#1a3c6e; color:white; padding:14px; border-radius:6px; text-decoration:none; font-weight:bold; font-size:16px;">
       Pesan Sekarang
    </a>
@else
    <a href="{{ route('login') }}" 
       style="display:block; width:100%; text-align:center; background:#aaa; color:white; padding:14px; border-radius:6px; text-decoration:none; font-weight:bold; font-size:16px;">
       Login untuk Pesan
    </a>
@endif




</div>
@endsection
