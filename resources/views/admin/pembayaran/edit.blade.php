@extends('layouts.admin.app')

@section('title', 'Edit Pembayaran')

@section('content')
<div class="container mt-4">
    <div class="card p-3">
        <h6 class="mb-3">Edit Pembayaran</h6>

        <form action="{{ route('admin.pembayaran.update', $pembayaran->id_pembayaran) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nomor Transaksi</label>
                <input type="text" class="form-control" value="{{ $pembayaran->pemesanan->nomor_transaksi }}" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Penyewa</label>
                <input type="text" class="form-control" value="{{ $pembayaran->pemesanan->user->nama ?? '-' }}" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label">Bukti Bayar</label>
                @if($pembayaran->bukti_bayar)
                    <img src="{{ asset($pembayaran->bukti_bayar) }}" alt="Bukti Bayar" class="img-fluid" style="max-height:150px;">
                @else
                    <p>Tidak ada bukti bayar</p>
                @endif
            </div>

            <div class="mb-3">
    <label class="form-label">Denda per Hari (Rp)</label>
    <input type="number" name="denda" class="form-control" value="{{ $pembayaran->pemesanan->denda ?? 0 }}">
    <small class="text-muted">Jumlah bayar akan otomatis dihitung berdasarkan durasi pemesanan.</small>
</div>

<div class="mb-3">
    <label class="form-label">Status</label>
    <select name="status_bayar" class="form-select" required>
    <option value="Lunas" {{ $pembayaran->status_bayar == 'Lunas' ? 'selected' : '' }}>Lunas</option>
    <option value="Belum Lunas" {{ $pembayaran->status_bayar == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
    <option value="Menunggu Verifikasi" {{ $pembayaran->status_bayar == 'Menunggu Verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi</option>
</select>

</div>


            <div class="mb-3">
                <label class="form-label">Jumlah Bayar (Rp)</label>
                <input type="number" class="form-control" value="{{ $pembayaran->jumlah_bayar }}" disabled>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.pembayaran.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
