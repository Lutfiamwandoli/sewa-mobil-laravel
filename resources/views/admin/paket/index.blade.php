@extends('layouts.admin.app')

@section('title', 'Data Paket')

@section('content')
<div class="container mt-4" style="margin-top:16px;">
    <div class="card p-3" style="padding:16px;">
        <h6 class="mb-3" style="margin-bottom:12px;">Paket</h6>

        <a href="{{ route('paket.create') }}" class="btn btn-success mb-3" style="font-size:14px; padding:6px 12px; margin-bottom:12px; width:150px">
           + Tambah Data
        </a>

        <div class="table-responsive" style="overflow-x:auto;">
            <table id="paketTable" class="table table-bordered table-striped align-middle" style="font-size:14px; border-collapse:collapse; width:100%;">
                <thead style="background:#f8f9fa;">
                    <tr>
                        <th style="padding:8px; border:1px solid #dee2e6;">NO</th>
                        <th style="padding:8px; border:1px solid #dee2e6;">MOBIL</th>
                        <th style="padding:8px; border:1px solid #dee2e6;">NAMA PAKET</th>
                        <th style="padding:8px; border:1px solid #dee2e6;">WILAYAH</th>
                        <th style="padding:8px; border:1px solid #dee2e6;">HARGA</th>
                        <th style="padding:8px; border:1px solid #dee2e6;">DESKRIPSI</th>
                        <th style="padding:8px; border:1px solid #dee2e6;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pakets as $index => $paket)
                    <tr>
                        <td style="padding:8px; border:1px solid #dee2e6; text-align:center;">{{ $index + 1 }}</td>
                        <td style="padding:8px; border:1px solid #dee2e6;">{{ $paket->mobil ? $paket->mobil->nama_mobil : '-' }}</td>
                        <td style="padding:8px; border:1px solid #dee2e6;">{{ $paket->nama_paket }}</td>
                        <td style="padding:8px; border:1px solid #dee2e6;">{{ $paket->wilayah }}</td>
                        <td style="padding:8px; border:1px solid #dee2e6;">{{ number_format($paket->harga,0,',','.') }}</td>
                        <td style="padding:8px; border:1px solid #dee2e6; white-space:pre-line;">{!! nl2br(e($paket->deskripsi)) !!}</td>
                        <td style="padding:8px; border:1px solid #dee2e6; text-align:center;">
                            <a href="{{ route('paket.edit', $paket->id_paket) }}" class="btn btn-sm btn-primary" style="width:60px; font-size:13px; margin-right:4px;">Edit</a>
                            <form action="{{ route('paket.destroy', $paket->id_paket) }}" method="POST" class="d-inline form-hapus" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger btn-hapus" style="width:60px; font-size:13px;">Hapus</button>
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
        $('#paketTable').DataTable({
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

        $('#paketTable').on('click', '.btn-hapus', function() {
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
