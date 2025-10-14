@extends('layouts.app')

@section('content')
<div style="max-width: 1100px; margin: 30px auto; display: flex; gap: 20px; font-family: Arial, sans-serif;">

    <!-- Kolom Kiri -->
    <div style="flex: 2; background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
        
        <h2 style="font-size: 20px; font-weight: bold; margin-bottom: 20px;">Formulir Pemesanan</h2>

        <!-- Progress Bar -->
        <div style="margin: 20px 0; display: flex; justify-content: space-between; align-items: center; position: relative;">
            <div style="text-align: center; flex: 1; position: relative;">
                <div style="width:24px; height:24px; border-radius:50%; background:#01AE3B; margin:auto;"></div>
                <small>Isi Form</small>
                <div style="position:absolute; top:12px; left:50%; width:100%; height:4px; background:#01AE3B;"></div>
            </div>
            <div style="text-align: center; flex: 1; position: relative;">
                <div style="width:24px; height:24px; border-radius:50%; background:#bbb; margin:auto;"></div>
                <small>Pembayaran</small>
                <div style="position:absolute; top:12px; left:50%; width:100%; height:4px; background:#ddd;"></div>
            </div>
            <div style="text-align: center; flex: 1; position: relative;">
                <div style="width:24px; height:24px; border-radius:50%; background:#bbb; margin:auto;"></div>
                <small>Admin Menyetujui</small>
                <div style="position:absolute; top:12px; left:50%; width:100%; height:4px; background:#ddd;"></div>
            </div>
            <div style="text-align: center; flex: 1; position: relative;">
                <div style="width:24px; height:24px; border-radius:50%; background:#bbb; margin:auto;"></div>
                <small>Mulai Sewa</small>
            </div>
        </div>

        <!-- Informasi Penyewa -->
        <h3 style="font-size: 16px; font-weight: bold; margin-bottom: 10px;">Informasi Penyewa</h3>
        <p><b>Nama:</b> {{ $user->nama ?? '-' }}</p>
        <p><b>NIK:</b> {{ $user->NIK ?? '-' }}</p>
        <p><b>Email:</b> {{ $user->email ?? '-' }}</p>
        <p><b>Nomor Telepon:</b> {{ $user->no_telepon ?? '-' }}</p>
        <p><b>Jenis Kelamin:</b> {{ $user->jenis_kelamin ?? '-' }}</p>

        <hr style="margin: 20px 0;">

        <!-- Informasi Pemesanan -->
        <h3 style="font-size: 16px; font-weight: bold; margin-bottom: 10px;">Informasi Pemesanan</h3>
        <p><b>Kota Tujuan:</b> {{ $kota ?? '-' }}</p>
        <p><b>Tanggal Mulai Sewa:</b> {{ $tanggal_mulai ?? '-' }}</p>
        <p><b>Tanggal Selesai Sewa:</b> {{ $tanggal_selesai ?? '-' }}</p>
        <p><b>Mobil:</b> {{ $mobil->nama_mobil ?? '-' }} {{ $mobil->tahun_mobil ?? '' }}</p>
        <p><b>Paket:</b> {{ $paket->nama_paket ?? '-' }}</p>

        <!-- Form -->
        <form action="{{ route('checkout.store', [$mobil->id_mobil, $paket->id_paket]) }}" method="POST">
            @csrf

            <!-- Hidden input -->
            <input type="hidden" name="id_user" value="{{ $user->id_user ?? '' }}">
            <input type="hidden" name="id_mobil" value="{{ $mobil->id_mobil ?? '' }}">
            <input type="hidden" name="id_paket" value="{{ $paket->id_paket ?? '' }}">

            <input type="hidden" name="tanggal_mulai" value="{{ $tanggal_mulai ?? '' }}">
            <input type="hidden" name="tanggal_selesai" value="{{ $tanggal_selesai ?? '' }}">
            <input type="hidden" name="kota_tujuan" value="{{ $kota ?? '-' }}">
            <input type="hidden" name="wilayah" value="{{ $paket->wilayah ?? '-' }}">

            <!-- Catatan -->
            <label for="catatan"><b>Catatan</b></label>
            <textarea name="catatan" id="catatan" rows="3"
                      style="width:100%; padding:10px; border:1px solid #ddd; border-radius:6px;"></textarea>

            <button type="submit"
                    style="margin-top:15px; background:#1a3c6e; color:#fff; padding:12px 20px; border:none; border-radius:6px; font-weight:bold; cursor:pointer; width:100%;">
                Pesan Sekarang
            </button>
        </form>
    </div>

    <!-- Kolom Kanan -->
    <div style="flex: 1; background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
        <div style="display: flex; gap: 10px; margin-bottom: 15px;">
            <img src="{{ asset('storage/mobil/'.$mobil->foto_mobil) }}" 
                 alt="{{ $mobil->nama_mobil }}" 
                 style="width: 120px; height: 80px; object-fit: cover; border-radius: 6px;">
            <div>
                <p style="margin:0; font-weight:bold;">{{ $paket->nama_paket ?? '-' }}</p>
                <small>{{ $mobil->nama_mobil ?? '-' }} {{ $mobil->tahun_mobil ?? '' }}</small><br>
                <small>Kapasitas: 6 Orang</small>
            </div>
        </div>

        <h3 style="font-size: 16px; font-weight: bold; margin-bottom: 10px;">Rincian Pembayaran</h3>
        <p style="margin:5px 0;">Biaya Sewa Mobil 
            <span style="float:right;">Rp {{ number_format($paket->harga ?? 0, 0, ',', '.') }}</span>
        </p>
        <p style="margin:5px 0;">Biaya Layanan Aplikasi <span style="float:right;">Rp 0</span></p>
        <hr>
        <p style="font-size: 18px; font-weight:bold; margin:10px 0;">Total Harga 
            <span style="float:right;">Rp {{ number_format($paket->harga ?? 0, 0, ',', '.') }}</span>
        </p>
    </div>

</div>
@endsection
