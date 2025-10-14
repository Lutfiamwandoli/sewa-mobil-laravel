@extends('layouts.admin.app')

@section('title', 'Edit Paket')

@section('content')
<div class="container mt-4">
    <div class="card p-3">
        <h6 class="mb-3">Edit Paket</h6>
        <form id="paketForm" action="{{ route('paket.update', $paket->id_paket) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="id_mobil" class="form-label">Mobil</label>
                <select name="id_mobil" id="id_mobil" class="form-select" disabled required>
                    <option value="">-- Pilih Mobil --</option>
                    @foreach($mobils as $mobil)
                        <option value="{{ $mobil->id_mobil }}" {{ $mobil->id_mobil == $paket->id_mobil ? 'selected' : '' }}>
                            {{ $mobil->nama_mobil }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="nama_paket" class="form-label">Nama Paket</label>
                <input type="text" name="nama_paket" id="nama_paket" class="form-control" value="{{ $paket->nama_paket }}" disabled required>
            </div>

            <div class="mb-3">
                <label for="wilayah" class="form-label">Wilayah</label>
                <input type="text" name="wilayah" id="wilayah" class="form-control" value="{{ $paket->wilayah }}" disabled required>
            </div>

            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" name="harga" id="harga" class="form-control" value="{{ $paket->harga }}" disabled required>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3" disabled>{{ $paket->deskripsi }}</textarea>
            </div>

            <button type="button" id="editBtn" class="btn btn-warning">Ubah</button>
            <button type="submit" id="updateBtn" class="btn btn-primary d-none">Update</button>
            <a href="{{ route('paket.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#editBtn').click(function() {
            // Enable all inputs dan select
            $('#paketForm').find('input, select, textarea').prop('disabled', false);

            // Sembunyikan tombol Ubah dan tampilkan tombol Update
            $(this).addClass('d-none');
            $('#updateBtn').removeClass('d-none');
        });
    });
</script>
@endpush
@endsection
