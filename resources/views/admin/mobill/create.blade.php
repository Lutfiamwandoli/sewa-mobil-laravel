@extends('layouts.admin.app')

@section('title', 'Tambah Mobil')

@section('content')
<div class="container mt-4">
    <div class="card p-3">
        <h6 class="mb-3">Tambah Mobil</h6>

        <form action="{{ route('mobil.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label>Plat Nomor</label>
                <input type="text" name="plat_nomor" class="form-control" value="{{ old('plat_nomor') }}" required>
            </div>
            <div class="mb-3">
                <label>Nama Mobil</label>
                <input type="text" name="nama_mobil" class="form-control" value="{{ old('nama_mobil') }}" required>
            </div>
            <div class="mb-3">
                <label>Merk Mobil</label>
                <input type="text" name="merk_mobil" class="form-control" value="{{ old('merk_mobil') }}" required>
            </div>
            <div class="mb-3">
                <label>Tahun Mobil</label>
                <input type="number" name="tahun_mobil" class="form-control" value="{{ old('tahun_mobil') }}" required>
            </div>
            <div class="mb-3">
                <label>Spesifikasi</label>
                <textarea name="spesifikasi" class="form-control">{{ old('spesifikasi') }}</textarea>
            </div>
            <div class="mb-3">
                <label>Status Mobil</label>
                <select name="status_mobil" class="form-control" required>
                    <option value="Tersedia">Tersedia</option>
                    <option value="Disewa">Disewa</option>
                    <option value="Tidak Tersedia">Tidak Tersedia</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Foto Mobil</label>
                <input type="file" name="foto_mobil" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('mobil.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
