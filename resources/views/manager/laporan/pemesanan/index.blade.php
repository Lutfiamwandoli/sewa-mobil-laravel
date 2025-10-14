@extends('layouts.manager.app')

@section('title', 'Laporan Pemesanan')

@section('content')
<div class="container mt-4">
    <div class="card p-3">
        <h6 class="mb-3">Laporan Pemesanan</h6>
        <div class="table-responsive">
            <table id="laporanPemesananTable" class="table table-bordered table-striped align-middle" style="font-size:14px;">
                <thead style="background:#f8f9fa;">
                    <tr>
                        <th>NO</th>
                        <th>Nomor Transaksi</th>
                        <th>Penyewa</th>
                        <th>Mobil</th>
                        <th>Paket</th>
                        <th>Durasi</th>
                        <th>Status</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pemesanan as $i => $p)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $p->nomor_transaksi }}</td>
                        <td>{{ $p->user->nama ?? '-' }}</td>
                        <td>{{ $p->mobil->nama_mobil ?? '-' }}</td>
                        <td>{{ $p->paket->nama_paket ?? '-' }}</td>
                        <td>{{ $p->durasi }} hari</td>
                        <td>{{ $p->status_pemesanan }}</td>
                        <td>
                            <a href="{{ route('manager.laporan.pemesanan.detail', $p->id_pemesanan) }}" class="btn btn-sm btn-primary" style="width:70px;">Detail</a>
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
        $('#laporanPemesananTable').DataTable();
    });
</script>
@endpush
@endsection
