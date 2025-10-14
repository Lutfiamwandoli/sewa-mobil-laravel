@extends('layouts.admin.app')

@section('title', 'Testimoni')

@section('content')
<div class="container mt-4">
    <div class="card p-3">
        <h6 class="mb-3">Testimoni</h6>

        <div class="table-responsive">
            <table id="reviewTable" class="table table-bordered table-striped align-middle" style="font-size:14px;">
                <thead style="background:#f8f9fa;">
                    <tr>
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>MOBIL</th>
                        <th>RATING</th>
                        <th>KOMENTAR</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reviews as $index => $review)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $review->nama }}</td>
                        <td>{{ $review->mobil }}</td>
                        <td>
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $review->rating)
                                    <span style="color:gold;">&#9733;</span>
                                @else
                                    <span style="color:#ccc;">&#9733;</span>
                                @endif
                            @endfor
                        </td>
                        <td>{!! nl2br(e($review->komentar)) !!}</td>
                        <td>
                            <a href="{{ route('admin.review.show', $review->id) }}" class="btn btn-sm btn-primary" style="width:70px; font-size:13px;">Detail</a>
                            <form action="{{ route('admin.review.destroy', $review->id) }}" method="POST" class="d-inline form-hapus">
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
    $('#reviewTable').DataTable({
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

    // Konfirmasi Hapus
    $('#reviewTable').on('click', '.btn-hapus', function() {
        let form = $(this).closest('form');
        Swal.fire({
            title: 'Yakin ingin menghapus testimoni ini?',
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
