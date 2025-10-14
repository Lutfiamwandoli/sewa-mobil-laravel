@extends('layouts.manager.app')

@section('title', 'Dashboard')

@section('content')
<div style="padding:20px;">
    <h2 style="display:flex; align-items:center; gap:10px;">
        <img src="{{ asset('gambar/tdesign_dashboard-1-filled.png') }}" alt="Dashboard" style="width:30px; height:30px;">
        Dashboard
    </h2>
    <hr>
    <div style="display:flex; flex-wrap:wrap; gap:20px;">

{{-- Laporan Pemesanan --}}
        <div style="flex:1 1 calc(25% - 20px); background:#1E3E62; color:#fff;
                    border-radius:8px; text-align:center; overflow:hidden;
                    display:flex; flex-direction:column; justify-content:space-between;">
            <div style="padding:30px 20px;">
                <h4 style="margin:0; display:flex; align-items:center; justify-content:center; gap:10px;">
                    <img src="{{ asset('gambar/order.png') }}" alt="Laporan Pemesanan" style="width:25px; height:25px;">
                    Laporan Pemesanan
                </h4>
            </div>
            <div style="background:#fff; padding:10px;">
                <a href="{{ route('manager.laporan.pemesanan') }}" style="display:block; color:#1E3E62; font-weight:bold; text-decoration:none;">Lihat Detail</a>
            </div>
        </div>
        {{-- Laporan Pembayaran --}}
        <div style="flex:1 1 calc(25% - 20px); background:#1E3E62; color:#fff;
                    border-radius:8px; text-align:center; overflow:hidden;
                    display:flex; flex-direction:column; justify-content:space-between;">
            <div style="padding:30px 20px;">
                <h4 style="margin:0; display:flex; align-items:center; justify-content:center; gap:10px;">
                    <img src="{{ asset('gambar/uang3.png') }}" alt="Laporan Pembayaran" style="width:25px; height:25px;">
                    Laporan Pembayaran
                </h4>
            </div>
            <div style="background:#fff; padding:10px;">
                <a href="{{ route('manager.laporan.pembayaran') }}" style="display:block; color:#1E3E62; font-weight:bold; text-decoration:none;">Lihat Detail</a>
            </div>
        </div>

    </div>
</div>
@endsection
