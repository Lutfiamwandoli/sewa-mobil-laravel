@extends('layouts.admin.app')

@section('title', 'Laporan Pembayaran')

@section('content')
<div class="container mt-4">
    <div class="card p-3">
        <h6 class="mb-3">Laporan Pembayaran</h6>
        <div class="table-responsive">
            <table id="laporanPembayaranTable" class="table table-bordered table-striped align-middle" style="font-size:14px;">
                <thead style="background:#f8f9fa;">
                    <tr>
                        <th>NO</th>
                        <th>Nomor Transaksi</th>
                        <th>Penyewa</th>
                        <th>Tanggal Bayar</th>
                        <th>Jumlah Bayar</th>
                        <th>Status</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pembayaran as $i => $p)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $p->pemesanan->nomor_transaksi ?? '-' }}</td>
                        <td>{{ $p->pemesanan->user->nama ?? '-' }}</td>
                        <td>{{ $p->tanggal_bayar }}</td>
                        <td>{{ number_format($p->jumlah_bayar,0,',','.') }}</td>
                        <td>{{ $p->status_bayar }}</td>
                        <td>
                            <a href="{{ route('admin.laporan.pembayaran.detail', $p->id_pembayaran) }}" class="btn btn-sm btn-primary" style="width:70px;">Detail</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function(){
        $('#laporanPembayaranTable').DataTable();
    });
</script>
@endpush
@endsection
