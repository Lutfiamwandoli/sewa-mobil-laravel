@extends('layouts.admin.app')

@section('title', 'Tambah Paket')

@section('content')
<div class="container mt-4">
    <div class="card p-3">
        <h6 class="mb-3">Tambah Paket</h6>
        <form action="{{ route('paket.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="id_mobil" class="form-label">Mobil</label>
                <select name="id_mobil" id="id_mobil" class="form-select" required>
                    <option value="">-- Pilih Mobil --</option>
                    @foreach($mobils as $mobil)
                        <option value="{{ $mobil->id_mobil }}">{{ $mobil->nama_mobil }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="nama_paket" class="form-label">Nama Paket</label>
                <input type="text" name="nama_paket" id="nama_paket" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="wilayah" class="form-label">Wilayah</label>
                <input type="text" name="wilayah" id="wilayah" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" name="harga" id="harga" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('paket.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
