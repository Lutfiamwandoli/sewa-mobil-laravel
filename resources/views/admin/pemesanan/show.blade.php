@extends('layouts.admin.app')

@section('title', 'Detail Pemesanan')

@section('content')
<div class="container mt-4" style="margin-top:16px;">
    <div class="card p-4" style="padding:16px; position:relative;">
        {{-- Tombol X --}}
        <a href="{{ route('admin.pemesanan.index') }}" style="position:absolute; top:16px; right:16px; font-size:18px; text-decoration:none; color:#dc3545; font-weight:bold;">&times;</a>

        <h6 class="mb-3" style="margin-bottom:16px;">Detail Pemesanan</h6>

        <div class="row mb-2" style="margin-bottom:12px;">
            <div class="col-4" style="font-weight:500;">Nomor Transaksi</div>
            <div class="col-8">{{ $pemesanan->nomor_transaksi }}</div>
        </div>

        <div class="row mb-2" style="margin-bottom:12px;">
            <div class="col-4" style="font-weight:500;">Mobil</div>
            <div class="col-8">{{ $pemesanan->mobil ? $pemesanan->mobil->nama_mobil : '-' }}</div>
        </div>

        <div class="row mb-2" style="margin-bottom:12px;">
            <div class="col-4" style="font-weight:500;">Harga Sewa 1 Unit</div>
            <div class="col-8">Rp {{ $pemesanan->paket ? number_format($pemesanan->paket->harga,0,',','.') : '-' }}</div>
        </div>

        <div class="row mb-2" style="margin-bottom:12px;">
            <div class="col-4" style="font-weight:500;">Jumlah Pesanan</div>
            <div class="col-8">{{ $pemesanan->durasi }} Hari</div>
        </div>

        <div class="row mb-2" style="margin-bottom:12px;">
            <div class="col-4" style="font-weight:500;">Subtotal</div>
            <div class="col-8">Rp {{ $pemesanan->paket ? number_format($pemesanan->paket->harga * $pemesanan->durasi,0,',','.') : '-' }}</div>
        </div>

        @if($pemesanan->catatan)
        <div class="row mb-2" style="margin-bottom:12px;">
            <div class="col-4" style="font-weight:500;">Catatan</div>
            <div class="col-8">{{ $pemesanan->catatan }}</div>
        </div>
        @endif

        @if($pemesanan->denda)
        <div class="row mb-2" style="margin-bottom:12px;">
            <div class="col-4" style="font-weight:500;">Denda</div>
            <div class="col-8">Rp {{ number_format($pemesanan->denda,0,',','.') }}</div>
        </div>
        @endif

    </div>
</div>
@endsection
