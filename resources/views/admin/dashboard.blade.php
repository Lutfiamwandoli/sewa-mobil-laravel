@extends('layouts.admin.app')

@section('title', 'Dashboard')

@section('content')
<div style="padding:20px;">
    <h2 style="display:flex; align-items:center; gap:10px;">
        <img src="{{ asset('gambar/tdesign_dashboard-1-filled.png') }}" alt="Dashboard" style="width:30px; height:30px;">
        Dashboard
    </h2>
    <hr>
    <div style="display:flex; flex-wrap:wrap; gap:20px;">

        {{-- Akun Pengguna --}}
        <div style="flex:1 1 calc(25% - 20px); background:#1E3E62; color:#fff;
                    border-radius:8px; text-align:center; overflow:hidden;
                    display:flex; flex-direction:column; justify-content:space-between;">
            <div style="padding:30px 20px;">
                <h4 style="margin:0; display:flex; align-items:center; justify-content:center; gap:10px;">
                    <img src="{{ asset('gambar/userr.png') }}" alt="Akun Pengguna" style="width:25px; height:25px;">
                    Akun Pengguna
                </h4>
            </div>
            <div style="background:#fff; padding:10px;">
                <a href="{{ route('datauser.index') }}" style="display:block; color:#1E3E62; font-weight:bold; text-decoration:none;">Lihat Detail</a>
            </div>
        </div>

        {{-- Mobil --}}
        <div style="flex:1 1 calc(25% - 20px); background:#1E3E62; color:#fff;
                    border-radius:8px; text-align:center; overflow:hidden;
                    display:flex; flex-direction:column; justify-content:space-between;">
            <div style="padding:30px 20px;">
                <h4 style="margin:0; display:flex; align-items:center; justify-content:center; gap:10px;">
                    <img src="{{ asset('gambar/bxsw_car.png') }}" alt="Mobil" style="width:25px; height:25px;">
                    Mobil
                </h4>
            </div>
            <div style="background:#fff; padding:10px;">
                <a href="{{ route('mobill.index') }}" style="display:block; color:#1E3E62; font-weight:bold; text-decoration:none;">Lihat Detail</a>
            </div>
        </div>

        {{-- Paket --}}
        <div style="flex:1 1 calc(25% - 20px); background:#1E3E62; color:#fff;
                    border-radius:8px; text-align:center; overflow:hidden;
                    display:flex; flex-direction:column; justify-content:space-between;">
            <div style="padding:30px 20px;">
                <h4 style="margin:0; display:flex; align-items:center; justify-content:center; gap:10px;">
                    <img src="{{ asset('gambar/package.png') }}" alt="Paket" style="width:25px; height:25px;">
                    Paket
                </h4>
            </div>
            <div style="background:#fff; padding:10px;">
                <a href="{{ route('paket.index') }}" style="display:block; color:#1E3E62; font-weight:bold; text-decoration:none;">Lihat Detail</a>
            </div>
        </div>

        {{-- Pemesanan --}}
        <div style="flex:1 1 calc(25% - 20px); background:#1E3E62; color:#fff;
                    border-radius:8px; text-align:center; overflow:hidden;
                    display:flex; flex-direction:column; justify-content:space-between;">
            <div style="padding:30px 20px;">
                <h4 style="margin:0; display:flex; align-items:center; justify-content:center; gap:10px;">
                    <img src="{{ asset('gambar/pemesanan.png') }}" alt="Pemesanan" style="width:25px; height:25px;">
                    Pemesanan
                </h4>
            </div>
            <div style="background:#fff; padding:10px;">
                <a href="{{ route('admin.pemesanan.index') }}" style="display:block; color:#1E3E62; font-weight:bold; text-decoration:none;">Lihat Detail</a>
            </div>
        </div>

        {{-- Pembayaran --}}
        <div style="flex:1 1 calc(25% - 20px); background:#1E3E62; color:#fff;
                    border-radius:8px; text-align:center; overflow:hidden;
                    display:flex; flex-direction:column; justify-content:space-between;">
            <div style="padding:30px 20px;">
                <h4 style="margin:0; display:flex; align-items:center; justify-content:center; gap:10px;">
                    <img src="{{ asset('gambar/uang2.png') }}" alt="Pembayaran" style="width:25px; height:25px;">
                    Pembayaran
                </h4>
            </div>
            <div style="background:#fff; padding:10px;">
                <a href="{{ route('admin.pembayaran.index') }}" style="display:block; color:#1E3E62; font-weight:bold; text-decoration:none;">Lihat Detail</a>
            </div>
        </div>

        {{-- Testimoni --}}
        <div style="flex:1 1 calc(25% - 20px); background:#1E3E62; color:#fff;
                    border-radius:8px; text-align:center; overflow:hidden;
                    display:flex; flex-direction:column; justify-content:space-between;">
            <div style="padding:30px 20px;">
                <h4 style="margin:0; display:flex; align-items:center; justify-content:center; gap:10px;">
                    <img src="{{ asset('gambar/review.png') }}" alt="Testimoni" style="width:25px; height:25px;">
                    Testimoni
                </h4>
            </div>
            <div style="background:#fff; padding:10px;">
                <a href="{{ route('admin.review.index') }}" style="display:block; color:#1E3E62; font-weight:bold; text-decoration:none;">Lihat Detail</a>
            </div>
        </div>

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
                <a href="{{ route('admin.laporan.pemesanan') }}" style="display:block; color:#1E3E62; font-weight:bold; text-decoration:none;">Lihat Detail</a>
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
                <a href="{{ route('admin.laporan.pembayaran') }}" style="display:block; color:#1E3E62; font-weight:bold; text-decoration:none;">Lihat Detail</a>
            </div>
        </div>

    </div>
</div>
@endsection
