@extends('layouts.app')

@section('content')
<div style="max-width: 1100px; margin: 30px auto; font-family: Arial, sans-serif;">

    <div style="display:flex; gap:20px;">
        <!-- Kolom Kiri -->
        <div style="flex:2; background:#fff; padding:20px; border-radius:10px; box-shadow:0 4px 10px rgba(0,0,0,0.1);">

            <h2 style="font-size:20px; font-weight:bold; margin-bottom:20px;">Pembayaran</h2>

            <!-- Progress Bar -->
            <div style="margin: 20px 0; display: flex; justify-content: space-between; align-items: center; position: relative;">
                <div style="text-align: center; flex: 1; position: relative;">
                    <div style="width:24px; height:24px; border-radius:50%; background:#01AE3B; margin:auto;"></div>
                    <small>Isi Form</small>
                    <div style="position:absolute; top:12px; left:50%; width:100%; height:4px; background:#01AE3B;"></div>
                </div>
                <div style="text-align: center; flex: 1; position: relative;">
                    <div style="width:24px; height:24px; border-radius:50%; background:#01AE3B; margin:auto;"></div>
                    <small>Pembayaran</small>
                    <div style="position:absolute; top:12px; left:50%; width:100%; height:4px; background:#01AE3B;"></div>
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

            <p><b>Nomor Pemesanan:</b> {{ $pemesanan->nomor_transaksi }}</p>
            <p><b>Nama Penyewa:</b> {{ $pemesanan->user->nama }}</p>
            <p><b>Mobil:</b> {{ $pemesanan->mobil->nama_mobil }} {{ $pemesanan->mobil->tahun_mobil }}</p>
            <p><b>Jumlah Bayar:</b> Rp {{ number_format($totalBayar, 0, ',', '.') }}</p>

            <hr>

            <h3 style="font-size:16px; font-weight:bold; margin-bottom:10px;">Rekening Pemilik</h3>
            <div style="border:1px solid #ddd; border-radius:8px; padding:15px; display:flex; align-items:center; gap:15px;">
                <img src="{{ asset('gambar/BCA-Logo-Bank-Central-Asia-1024x1024.png') }}" alt="BCA" style="width:60px; height:auto;">
                <div>
                    <p style="margin:0;"><b>No. Rekening:</b> 7070926521 
                        <button onclick="navigator.clipboard.writeText('7070926521')" 
                                style="padding:4px 8px; background:#1a3c6e; color:#fff; border:none; border-radius:4px; cursor:pointer; font-size:12px;">
                            Salin
                        </button>
                    </p>
                    <p style="margin:0;"><b>Nama Rekening:</b> PT Rental Mobil</p>
                </div>
            </div>

            <hr>

            <form action="{{ route('checkout.upload', $pemesanan->id_pemesanan) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_pemesanan" value="{{ $pemesanan->id_pemesanan }}">
                <label for="bukti_pembayaran"><b>Bukti Pembayaran</b></label>
                <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" required style="display:block; margin:10px 0;">
                <button type="submit"
                        style="margin-top:15px; background:#1a3c6e; color:#fff; padding:14px; border:none; border-radius:8px; font-weight:bold; cursor:pointer; width:100%; font-size:16px;">
                    Kirim
                </button>
            </form>
        </div>

        <!-- Kolom Kanan -->
        <div style="flex:1; background:#fff; padding:20px; border-radius:10px; box-shadow:0 4px 10px rgba(0,0,0,0.1);">
            <div style="display:flex; gap:10px; margin-bottom:15px;">
                <img src="{{ asset('gambar/mobil.png') }}" alt="Mobil" style="width:80px; height:auto; border-radius:8px;">
                <div>
                    <span style="display:inline-block; background:#ffffff; color:#black; padding:2px 6px; font-size:12px; border:1px solid #ddd; border-radius:4px;">{{$pemesanan->mobil->paket->nama_paket}}</span>
                    <span style="display:inline-block; background:#ff6600; color:#fff; padding:2px 6px; font-size:12px; border-radius:4px;">{{$pemesanan->status_pemesanan}}</span>
                    <h4 style="margin:5px 0;">{{ $pemesanan->mobil->nama_mobil }} {{ $pemesanan->mobil->tahun_mobil }}</h4>
                    <p style="margin:0; color:#777;">Rp {{ number_format($pemesanan->paket->harga, 0, ',', '.') }}/hari</p>
                </div>
            </div>

            <p><b>Tanggal Mulai:</b> {{ $pemesanan->tanggal_mulai }}</p>
            <p><b>Tanggal Selesai:</b> {{ $pemesanan->tanggal_selesai }}</p>
            <p><b>Durasi Sewa:</b> {{ $pemesanan->durasi }} hari</p>

            <hr>

            <h4>Informasi Penyewa</h4>
            <p style="margin:0;"><b>{{ $pemesanan->user->nama }}</b></p>
            <p style="margin:0; font-size:14px; color:#555;">{{ $pemesanan->user->email }}</p>
            <p style="margin:0; font-size:14px; color:#555;">{{ $pemesanan->user->no_telepon ?? '-' }}</p>

            <hr>

            <p style="font-size:16px; font-weight:bold;">Jumlah Bayar 
                <span style="float:right;">Rp {{ number_format($totalBayar, 0, ',', '.') }}</span>
            </p>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session()->has('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil Dikirim',
        text: '{{ session("success") }}',
        confirmButtonColor: '#1a3c6e'
    });
</script>
@endif
@endsection
