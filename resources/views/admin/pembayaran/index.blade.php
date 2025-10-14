@extends('layouts.admin.app')

@section('title', 'Data Pembayaran')

@section('content')
<div class="container mt-4">
    <div class="card p-3">
        <h6 class="mb-3">Pembayaran</h6>

        <div class="table-responsive">
            <table id="pembayaranTable" class="table table-bordered table-striped align-middle" style="font-size:14px;">
                <thead style="background:#f8f9fa;">
                    <tr>
                        <th>NO</th>
                        <th>NOMOR TRANSAKSI</th>
                        <th>NAMA PENYEWA</th>
                        <th>TANGGAL BAYAR</th>
                        <th>JUMLAH BAYAR</th>
                        <th>STATUS</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pembayarans as $index => $pembayaran)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $pembayaran->pemesanan->nomor_transaksi }}</td>
                        <td>{{ $pembayaran->pemesanan->user->nama ?? '-' }}</td>
                        <td>{{ $pembayaran->tanggal_bayar }}</td>
                        <td>{{ number_format($pembayaran->jumlah_bayar,0,',','.') }}</td>
                        <td>
                            @if($pembayaran->status_bayar == 'Lunas')
                                <span class="badge bg-success">{{ $pembayaran->status_bayar }}</span>
                            @else
                                <span class="badge bg-warning">{{ $pembayaran->status_bayar }}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.pembayaran.edit', $pembayaran->id_pembayaran) }}" class="btn btn-sm btn-primary" style="width:70px; font-size:13px;">Edit</a>
                            <form action="{{ route('admin.pembayaran.destroy', $pembayaran->id_pembayaran) }}" method="POST" class="d-inline form-hapus">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger btn-hapus" style="width:70px; font-size:13px;">Hapus</button>
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
        $('#pembayaranTable').DataTable({
            "language": {
                "search": "Search:",
                "lengthMenu": "Show _MENU_ entries",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "paginate": {
                    "first": "First",
                    "last": "Last",
                    "next": "Next",
                    "previous": "Previous"
                }
            }
        });

        $('#pembayaranTable').on('click', '.btn-hapus', function() {
            let form = $(this).closest('form');
            Swal.fire({
                title: 'Yakin ingin menghapus ini?',
                text: "Data yang sudah dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush
@endsection
