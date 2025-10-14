@extends('layouts.admin.app')

@section('title', 'Tambah User')

@section('content')
<div class="container mt-4" style="margin-top:16px;">
    <div class="card p-4" style="padding:16px;">
        <h6 class="mb-3" style="margin-bottom:12px;">Tambah User</h6>

        <form action="{{ route('datauser.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3" style="margin-bottom:12px;">
                <label class="form-label" style="font-weight:500;">Nama</label>
                <input type="text" name="nama" class="form-control" required style="width:100%; padding:6px 12px; font-size:14px;">
            </div>

            <div class="mb-3" style="margin-bottom:12px;">
                <label class="form-label" style="font-weight:500;">Username</label>
                <input type="text" name="username" class="form-control" required style="width:100%; padding:6px 12px; font-size:14px;">
            </div>

            <div class="mb-3" style="margin-bottom:12px;">
                <label class="form-label" style="font-weight:500;">Email</label>
                <input type="email" name="email" class="form-control" required style="width:100%; padding:6px 12px; font-size:14px;">
            </div>

            <div class="mb-3" style="margin-bottom:12px;">
                <label class="form-label" style="font-weight:500;">Password</label>
                <input type="password" name="password" class="form-control" required style="width:100%; padding:6px 12px; font-size:14px;">
            </div>

            <div class="mb-3" style="margin-bottom:12px;">
                <label class="form-label" style="font-weight:500;">No Telepon</label>
                <input type="text" name="no_telepon" class="form-control" required style="width:100%; padding:6px 12px; font-size:14px;">
            </div>

            <div class="mb-3" style="margin-bottom:12px;">
                <label class="form-label" style="font-weight:500;">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" required style="width:100%; padding:6px 12px; font-size:14px;">
                    <option value="Pria">Pria</option>
                    <option value="Wanita">Wanita</option>
                </select>
            </div>

            <div class="mb-3" style="margin-bottom:12px;">
                <label class="form-label" style="font-weight:500;">Role</label>
                <select name="role" class="form-control" required style="width:100%; padding:6px 12px; font-size:14px;">
                    <option value="penyewa">Penyewa</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div class="mb-3" style="margin-bottom:12px;">
                <label class="form-label" style="font-weight:500;">Foto</label>
                <input type="file" name="foto" class="form-control" style="width:100%; padding:6px 12px; font-size:14px;">
            </div>

            <button type="submit" class="btn btn-success" style="font-size:14px; padding:6px 12px;">Simpan</button>
            <a href="{{ route('datauser.index') }}" class="btn btn-secondary" style="font-size:14px; padding:6px 12px; margin-left:4px;">Kembali</a>
        </form>
    </div>
</div>
@endsection
