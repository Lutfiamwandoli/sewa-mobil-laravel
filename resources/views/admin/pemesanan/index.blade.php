@extends('layouts.admin.app')

@section('title', 'Data Pemesanan')

@section('content')
<div class="container mt-4">
    <div class="card p-3">
        <h6 class="mb-3">Pemesanan</h6>

        <div class="table-responsive">
            <table id="pemesananTable" class="table table-bordered table-striped align-middle">
                <thead style="background:#f8f9fa;">
                    <tr>
                        <th>NO</th>
                        <th>NOMOR TRANSAKSI</th>
                        <th>PEMESAN</th>
                        <th>MOBIL</th>
                        <th>PAKET</th>
                        <th>TANGGAL PEMESANAN</th>
                        <th>STATUS</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pemesanan as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nomor_transaksi }}</td>
                        <td>{{ $item->user->nama ?? '-' }}</td>
                        <td>{{ $item->mobil->nama_mobil ?? '-' }}</td>
                        <td>{{ $item->paket->nama_paket ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_pemesanan)->format('d/m/Y H:i') }}</td>
                        <td>
                            @if($item->status_pemesanan == 'Pending')
                                <span class="badge bg-warning">{{ $item->status_pemesanan }}</span>
                            @elseif($item->status_pemesanan == 'Selesai')
                                <span class="badge bg-success">{{ $item->status_pemesanan }}</span>
                            @else
                                <span class="badge bg-danger">{{ $item->status_pemesanan }}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.pemesanan.show', $item->id_pemesanan) }}" class="btn btn-sm btn-info">Detail</a>
                            <form action="{{ route('admin.pemesanan.destroy', $item->id_pemesanan) }}" method="POST" class="d-inline form-hapus">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger btn-hapus">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    $('#pemesananTable').DataTable();

    $('#pemesananTable').on('click', '.btn-hapus', function() {
        let form = $(this).closest('form');
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Data tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if(result.isConfirmed) form.submit();
        });
    });
});
</script>
@endpush
@endsection
