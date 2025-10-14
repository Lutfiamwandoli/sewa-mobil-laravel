@extends('layouts.admin.app')

@section('title', 'Akun Pengguna')

@section('content')
<div class="container mt-4" style="margin-top:16px;">
    <div class="card p-3" style="padding:16px;">
        <!-- Judul -->
        <h6 class="mb-3" style="margin-bottom:12px;">Akun Pengguna</h6>

        <!-- Tombol Tambah Data -->
        <a href="{{ route('datauser.create') }}" 
           class="btn btn-success mb-3" 
           style="background-color:#28a745; border:none; font-size:14px; padding:6px 12px; width:150px; margin-bottom:12px;">
           + Tambah Data
        </a>

        <!-- Tabel -->
        <div class="table-responsive" style="overflow-x:auto;">
            <table id="userTable" class="table table-bordered table-striped align-middle" style="font-size:14px; border-collapse:collapse; width:100%;">
                <thead style="background:#f8f9fa;">
                    <tr>
                        <th style="padding:8px; border:1px solid #dee2e6;">NO</th>
                        <th style="padding:8px; border:1px solid #dee2e6;">FOTO</th>
                        <th style="padding:8px; border:1px solid #dee2e6;">NAMA</th>
                        <th style="padding:8px; border:1px solid #dee2e6;">EMAIL</th>
                        <th style="padding:8px; border:1px solid #dee2e6;">NO TELEPON</th>
                        <th style="padding:8px; border:1px solid #dee2e6;">JENIS KELAMIN</th>
                        <th style="padding:8px; border:1px solid #dee2e6;">USERNAME</th>
                        <th style="padding:8px; border:1px solid #dee2e6;">ROLE</th>
                        <th style="padding:8px; border:1px solid #dee2e6;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $index => $user)
                    <tr>
                        <td style="padding:8px; border:1px solid #dee2e6; text-align:center;">{{ $index + 1 }}</td>
                        <td style="padding:8px; border:1px solid #dee2e6; text-align:center;">
                            @if ($user->foto)
                                <img src="{{ asset($user->foto) }}" 
                                     alt="Foto Profil" 
                                     style="width:35px; height:35px; border-radius:50%;">
                            @else
                                <img src="{{ asset('gambar/person.png') }}" 
                                     alt="Default Foto" 
                                     style="width:35px; height:35px; border-radius:50%;">
                            @endif
                        </td>
                        <td style="padding:8px; border:1px solid #dee2e6;">{{ $user->nama }}</td>
                        <td style="padding:8px; border:1px solid #dee2e6;">{{ $user->email }}</td>
                        <td style="padding:8px; border:1px solid #dee2e6;">{{ $user->no_telepon }}</td>
                        <td style="padding:8px; border:1px solid #dee2e6;">{{ $user->jenis_kelamin }}</td>
                        <td style="padding:8px; border:1px solid #dee2e6;">{{ $user->username }}</td>
                        <td style="padding:8px; border:1px solid #dee2e6;">{{ ucfirst($user->role) }}</td>
                        <td style="padding:8px; border:1px solid #dee2e6; text-align:center;">
                            <form action="{{ route('datauser.destroy', $user->id_user) }}" method="POST" class="d-inline form-hapus" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" 
                                        class="btn btn-danger btn-sm btn-hapus" 
                                        style="width:70px; font-size:13px;">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Script DataTables & SweetAlert2 -->
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#userTable').DataTable({
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

        // SweetAlert2 Konfirmasi Hapus
        $('.btn-hapus').click(function() {
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
