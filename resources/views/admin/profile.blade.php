@extends('layouts.admin.app')

@section('title', 'Profil Saya')

@section('content')
<div class="container mt-4">
    <div class="card shadow p-4">
        <h5 class="mb-3">Profil Saya</h5>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form id="formProfile" action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Foto Profil -->
            <div class="text-center mb-3">
                <img src="{{ $admin->foto ? asset($admin->foto) : asset('img/default-avatar.png') }}" 
                     class="rounded-circle mb-2" 
                     style="width: 100px; height: 100px; object-fit: cover;">
                <div>
                    <input type="file" name="foto" class="form-control form-control-sm mt-2" disabled>
                </div>
            </div>

            <!-- Username -->
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" value="{{ $admin->username }}" class="form-control" readonly>
            </div>

            <!-- Nama Lengkap -->
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama" value="{{ $admin->nama }}" class="form-control" disabled>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ $admin->email }}" class="form-control" disabled>
            </div>

            <!-- Nomor Telepon -->
            <div class="mb-3">
                <label class="form-label">Nomor Telepon</label>
                <input type="text" name="no_telepon" value="{{ $admin->no_telepon }}" class="form-control" disabled>
            </div>

            <!-- Jenis Kelamin -->
            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-select" disabled>
                    <option value="Pria" {{ $admin->jenis_kelamin == 'Pria' ? 'selected' : '' }}>Pria</option>
                    <option value="Wanita" {{ $admin->jenis_kelamin == 'Wanita' ? 'selected' : '' }}>Wanita</option>
                </select>
            </div>

            <!-- Tombol -->
            <div class="text-end">
                <button type="button" id="btnEdit" class="btn btn-primary">Ubah</button>
                <button type="submit" id="btnSave" class="btn btn-success d-none">Simpan</button>
                <button type="button" id="btnCancel" class="btn btn-secondary d-none">Batal</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("formProfile");
    const inputs = form.querySelectorAll("input, select");
    const btnEdit = document.getElementById("btnEdit");
    const btnSave = document.getElementById("btnSave");
    const btnCancel = document.getElementById("btnCancel");

    function enableForm(enable = true) {
        inputs.forEach(el => {
            if (el.name !== "_token" && el.name !== "_method") {
                if (enable) {
                    el.removeAttribute("disabled");
                } else {
                    el.setAttribute("disabled", true);
                }
            }
        });
    }

    btnEdit.addEventListener("click", () => {
        enableForm(true);
        btnEdit.classList.add("d-none");
        btnSave.classList.remove("d-none");
        btnCancel.classList.remove("d-none");
    });

    btnCancel.addEventListener("click", () => {
        form.reset();
        enableForm(false);
        btnEdit.classList.remove("d-none");
        btnSave.classList.add("d-none");
        btnCancel.classList.add("d-none");
    });
});
</script>
@endsection
