@extends('layouts.manager.app')

@section('title', 'Detail Pemesanan')

@section('content')
<div class="container mt-4">
    <div class="card p-3">
        <h6 class="mb-3 d-flex justify-content-between align-items-center">
            Detail Pemesanan
            <a href="{{ route('manager.laporan.pemesanan.cetak', $p->id_pemesanan) }}" class="btn btn-sm btn-success">Cetak</a>
        </h6>

        @php
            $fields = [
                'Nomor Transaksi' => $p->nomor_transaksi,
                'Penyewa' => $p->user->nama ?? '-',
                'Mobil' => $p->mobil->nama_mobil ?? '-',
                'Paket' => $p->paket->nama_paket ?? '-',
                'Durasi' => $p->durasi.' hari',
                'Tanggal Mulai' => $p->tanggal_mulai,
                'Tanggal Selesai' => $p->tanggal_selesai,
                'Status' => $p->status_pemesanan,
                'Catatan' => $p->catatan,
                'Denda' => number_format($p->denda,0,',','.'),
            ];
        @endphp

        @foreach($fields as $label => $value)
            <div style="display:flex; margin-bottom:12px;">
                <div style="width:150px; font-weight:bold;">{{ $label }}:</div>
                <div style="flex:1;">
                    <input type="text" class="form-control" value="{{ $value }}" readonly style="width:100%;">
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
