@extends('layouts.manager.app')

@section('title', 'Detail Pembayaran')

@section('content')
<div class="container mt-4">
    <div class="card p-3">
        <h6 class="mb-3 d-flex justify-content-between align-items-center">
            Detail Pembayaran
            <a href="{{ route('manager.laporan.pembayaran.cetak', $p->id_pembayaran) }}" class="btn btn-sm btn-success">Cetak</a>
        </h6>

        @php
            $fields = [
                'Nomor Transaksi' => $p->pemesanan->nomor_transaksi ?? '-',
                'Penyewa' => $p->pemesanan->user->nama ?? '-',
                'Mobil' => $p->pemesanan->mobil->nama_mobil ?? '-',
                'Paket' => $p->pemesanan->paket->nama_paket ?? '-',
                'Durasi' => $p->pemesanan->durasi ?? '-',
                'Tanggal Bayar' => $p->tanggal_bayar,
                'Jumlah Bayar' => number_format($p->jumlah_bayar,0,',','.'),
                'Status' => $p->status_bayar,
                'Bukti Bayar' => $p->bukti_bayar ? asset($p->bukti_bayar) : '-',
            ];
        @endphp

        @foreach($fields as $label => $value)
            <div style="display:flex; margin-bottom:12px;">
                <div style="width:150px; font-weight:bold;">{{ $label }}:</div>
                <div style="flex:1;">
                    @if($label == 'Bukti Bayar' && $p->bukti_bayar)
                        <img src="{{ $value }}" class="img-fluid" style="max-height:150px;">
                    @else
                        <input type="text" class="form-control" value="{{ $value }}" readonly style="width:100%;">
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
