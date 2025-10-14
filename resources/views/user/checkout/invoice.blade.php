@extends('layouts.app')

@section('content')
<div style="max-width:900px; margin:30px auto; font-family:Arial, sans-serif; color:#333; border:1px solid #ddd; padding:30px; border-radius:8px;">

    <!-- Header -->
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <img src="{{ asset('gambar/puskopa.png') }}" alt="Logo" style="height:50px;">
        <div style="text-align:right;">
            <h3 style="margin:0;">INVOICE</h3>
            <p style="margin:0; font-size:14px;">{{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
        </div>
    </div>

    <!-- Invoice Info -->
    <div style="margin-bottom:20px; font-size:14px;">
        <p><strong>Invoice No :</strong> {{ $pemesanan->pembayaran->id_pembayaran ?? 'INV-' . $pemesanan->id_pemesanan }}</p>
        <p><strong>Tanggal :</strong> {{ \Carbon\Carbon::parse($pemesanan->pembayaran->tanggal_bayar ?? now())->translatedFormat('d F Y') }}</p>
    </div>

    <!-- Informasi Penyewa -->
    <h4 style="margin-bottom:10px;">Informasi Penyewa</h4>
    <table style="width:100%; border-collapse:collapse; margin-bottom:20px; font-size:14px;" border="1" cellpadding="8">
        <tr>
            <td><strong>Nama Penyewa</strong></td>
            <td>{{ $pemesanan->user->nama }}</td>
            <td><strong>No. Telepon</strong></td>
            <td>{{ $pemesanan->user->no_telp ?? '-' }}</td>
            <td><strong>Email</strong></td>
            <td>{{ $pemesanan->user->email ?? '-' }}</td>
        </tr>
    </table>

    <!-- Detail Pembayaran -->
    <h4 style="margin-bottom:10px;">Detail Pembayaran</h4>
    <table style="width:100%; border-collapse:collapse; margin-bottom:20px; font-size:14px;" border="1" cellpadding="8">
        <thead style="background:#f5f5f5;">
            <tr>
                <th>Mobil</th>
                <th>Paket</th>
                <th>Kota Tujuan</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Durasi</th>
                <th>Denda</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $pemesanan->mobil->nama_mobil }}</td>
                <td>{{ $pemesanan->paket->nama_paket }}</td>
                <td>{{ $pemesanan->kota_tujuan }}</td>
                <td>{{ \Carbon\Carbon::parse($pemesanan->tanggal_mulai)->format('d M Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($pemesanan->tanggal_selesai)->format('d M Y') }}</td>
                <td>{{ $durasi }} Hari</td>
                <td>Rp {{ number_format(($pemesanan->denda ?? 0) * $durasi,0,',','.') }}</td>
                <td>Rp {{ number_format($subtotal,0,',','.') }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Total Section -->
    <div style="text-align:right; margin-bottom:20px; font-size:14px;">
        <p>Subtotal : Rp {{ number_format($subtotal,0,',','.') }}</p>
        <p>Biaya layanan aplikasi : Rp {{ number_format($biayaAplikasi,0,',','.') }}</p>
        <h3 style="margin:0;">Total Pembayaran : Rp {{ number_format($total,0,',','.') }}</h3>
        <p style="margin:0; color:green; font-weight:bold;">LUNAS</p>
    </div>

    <!-- Footer -->
    <div style="margin-top:30px; font-size:13px; display:flex; justify-content:space-between; align-items:flex-start;">
        <div>
            <strong>PUSKOPKA JATENG</strong><br>
            Jl. Merak No.2, Tanjung Mas, Kec. Semarang Utara<br>
            Kota Semarang, Jawa Tengah 50174
        </div>
        <div style="text-align:right;">
            <p><strong>Kontak:</strong> (+62)82317059584</p>
            <p>Instagram: @puskopka_rentcar</p>
        </div>
    </div>
</div>
@endsection
