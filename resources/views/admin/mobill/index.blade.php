@extends('layouts.admin.app')

@section('title', 'Data Mobil')

@section('content')
<div class="container mt-4">
    <div class="card p-3">
        <h6 class="mb-3">Mobil</h6>

        <a href="{{ route('mobil.create') }}" class="btn btn-success mb-3" style="font-size:14px; padding:6px 12px; width:150px">+ Tambah Data</a>

        <div class="table-responsive">
            <table id="mobilTable" class="table table-bordered table-striped align-middle" style="font-size:14px;">
                <thead style="background:#f8f9fa;">
                    <tr>
                        <th>NO</th>
                        <th>PLAT NOMOR</th>
                        <th>NAMA</th>
                        <th>MERK</th>
                        <th>TAHUN</th>
                        <th>SPESIFIKASI</th>
                        <th>STATUS</th>
                        <th>FOTO</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mobils as $index => $mobil)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $mobil->plat_nomor }}</td>
                        <td>{{ $mobil->nama_mobil }}</td>
                        <td>{{ $mobil->merk_mobil }}</td>
                        <td>{{ $mobil->tahun_mobil }}</td>
                        <td>{!! nl2br(e($mobil->spesifikasi)) !!}</td>
                        <td>
                            @if($mobil->status_mobil == 'Tersedia')
                                <span class="badge bg-success">{{ $mobil->status_mobil }}</span>
                            @elseif($mobil->status_mobil == 'Disewa')
                                <span class="badge bg-primary">{{ $mobil->status_mobil }}</span>
                            @else
                                <span class="badge bg-secondary">{{ $mobil->status_mobil }}</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($mobil->foto_mobil)
                                <img src="{{ asset($mobil->foto_mobil) }}" alt="Foto Mobil" style="width:80px; height:50px; object-fit:cover; border-radius:5px;">
                            @else
                                <img src="{{ asset('gambar/mobil_default.png') }}" alt="Default Mobil" style="width:80px; height:50px; object-fit:cover; border-radius:5px;">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('mobil.edit', $mobil->id_mobil) }}" class="btn btn-sm btn-primary" style="width:60px; font-size:13px;">Edit</a>
                            <form action="{{ route('mobil.destroy', $mobil->id_mobil) }}" method="POST" class="d-inline form-hapus">
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
        $('#mobilTable').DataTable({
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

        $('#mobilTable').on('click', '.btn-hapus', function() {
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
