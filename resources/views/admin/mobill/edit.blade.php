@extends('layouts.admin.app')

@section('title', 'Edit Mobil')

@section('content')
<div class="container mt-4">
    <div class="card p-3">
        <h6 class="mb-3">Edit Mobil</h6>

        <form action="{{ route('mobil.update', $mobil->id_mobil) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>Plat Nomor</label>
                <input type="text" name="plat_nomor" class="form-control" value="{{ old('plat_nomor', $mobil->plat_nomor) }}" required>
            </div>
            <div class="mb-3">
                <label>Nama Mobil</label>
                <input type="text" name="nama_mobil" class="form-control" value="{{ old('nama_mobil', $mobil->nama_mobil) }}" required>
            </div>
            <div class="mb-3">
                <label>Merk Mobil</label>
                <input type="text" name="merk_mobil" class="form-control" value="{{ old('merk_mobil', $mobil->merk_mobil) }}" required>
            </div>
            <div class="mb-3">
                <label>Tahun Mobil</label>
                <input type="number" name="tahun_mobil" class="form-control" value="{{ old('tahun_mobil', $mobil->tahun_mobil) }}" required>
            </div>
            <div class="mb-3">
                <label>Spesifikasi</label>
                <textarea name="spesifikasi" class="form-control">{{ old('spesifikasi', $mobil->spesifikasi) }}</textarea>
            </div>
            <div class="mb-3">
                <label>Status Mobil</label>
                <select name="status_mobil" class="form-control" required>
                    <option value="Tersedia" {{ $mobil->status_mobil == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="Disewa" {{ $mobil->status_mobil == 'Disewa' ? 'selected' : '' }}>Disewa</option>
                    <option value="Tidak Tersedia" {{ $mobil->status_mobil == 'Tidak Tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Foto Mobil</label>
                @if($mobil->foto_mobil)
                    <div class="mb-2">
                        <img src="{{ asset($mobil->foto_mobil) }}" alt="Foto Mobil" style="width:120px; height:80px; object-fit:cover; border-radius:5px;">
                    </div>
                @endif
                <input type="file" name="foto_mobil" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('mobil.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
