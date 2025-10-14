@extends('layouts.app')

@section('content')
<div style="max-width:1200px; margin:30px auto; font-family:Arial, sans-serif;">

    <!-- Breadcrumb -->
    <div style="font-size:14px; color:#555; margin-bottom:15px;">
        Beranda > <span style="color:#1a3c6e; font-weight:600;">Profil</span>
    </div>

    <div style="display:flex; gap:20px;">
        @include('user.profile.sidebar') <!-- Sidebar -->

        <!-- Form Profil -->
        <div style="flex:3; background:#fff; border-radius:8px; padding:25px; 
                    box-shadow:0 2px 6px rgba(0,0,0,0.1);">
            <h3 style="margin:0 0 5px 0; font-size:18px; font-weight:600; color:#1a3c6e;">Profil Saya</h3>
            <p style="margin:0 0 20px 0; font-size:13px; color:#555;">
                Kelola informasi profil Anda untuk mengontrol dan mengamankan akun
            </p>

            <form id="profileForm" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Foto -->
                <div style="text-align:center; margin-bottom:25px;">
                    <img src="{{ asset($user->foto ?? 'gambar/default.png') }}" 
                         alt="Foto Profil" 
                         style="width:100px; height:100px; border-radius:50%; object-fit:cover; display:block; margin:0 auto;">
                    <label style="display:inline-block; margin-top:10px; padding:6px 12px; border:1px solid #ccc; border-radius:6px; font-size:13px; cursor:pointer; background:#f9f9f9;">
                        Pilih Foto
                        <input type="file" name="foto" id="foto" style="display:none;" disabled>
                    </label>
                </div>

                <!-- Username -->
                <div style="display:flex; align-items:center; margin-bottom:15px;">
                    <label style="width:150px; font-size:13px;">Username</label>
                    <input type="text" name="username" value="{{ $user->username }}" 
                           style="flex:1; padding:8px; border:1px solid #ccc; border-radius:6px; font-size:13px;" disabled>
                </div>

                <!-- Nama Lengkap -->
                <div style="display:flex; align-items:center; margin-bottom:15px;">
                    <label style="width:150px; font-size:13px;">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ $user->nama }}" 
                           style="flex:1; padding:8px; border:1px solid #ccc; border-radius:6px; font-size:13px;" disabled>
                </div>

                <!-- NIK -->
                <div style="display:flex; align-items:center; margin-bottom:15px;">
                    <label style="width:150px; font-size:13px;">NIK</label>
                    <input type="text" name="NIK" value="{{ $user->NIK }}" 
                           style="flex:1; padding:8px; border:1px solid #ccc; border-radius:6px; font-size:13px;" disabled>
                </div>

                <!-- Email -->
                <div style="display:flex; align-items:center; margin-bottom:15px;">
                    <label style="width:150px; font-size:13px;">Email</label>
                    <input type="email" name="email" value="{{ $user->email }}" 
                           style="flex:1; padding:8px; border:1px solid #ccc; border-radius:6px; font-size:13px;" disabled>
                </div>

                <!-- Nomor Telepon -->
                <div style="display:flex; align-items:center; margin-bottom:15px;">
                    <label style="width:150px; font-size:13px;">Nomor Telepon</label>
                    <input type="text" name="no_telepon" value="{{ $user->no_telepon }}" 
                           style="flex:1; padding:8px; border:1px solid #ccc; border-radius:6px; font-size:13px;" disabled>
                </div>

                <!-- Jenis Kelamin -->
                <div style="display:flex; align-items:center; margin-bottom:20px;">
                    <label style="width:150px; font-size:13px;">Jenis Kelamin</label>
                    <select name="jenis_kelamin" 
                            style="flex:1; padding:8px; border:1px solid #ccc; border-radius:6px; font-size:13px;" disabled>
                        <option value="Pria" {{ $user->jenis_kelamin == 'Pria' ? 'selected' : '' }}>Pria</option>
                        <option value="Wanita" {{ $user->jenis_kelamin == 'Wanita' ? 'selected' : '' }}>Wanita</option>
                    </select>
                </div>

                <!-- Tombol -->
                <div style="text-align:right;">
                    <button type="button" id="editBtn"
                            style="background:#1a3c6e; color:#fff; padding:8px 20px; font-size:13px; border:none; border-radius:6px; cursor:pointer;">
                        Ubah
                    </button>
                    <button type="submit" id="saveBtn"
                            style="display:none; background:#28a745; color:#fff; padding:8px 20px; font-size:13px; border:none; border-radius:6px; cursor:pointer;">
                        Simpan
                    </button>
                    <button type="button" id="cancelBtn"
                            style="display:none; background:#dc3545; color:#fff; padding:8px 20px; font-size:13px; border:none; border-radius:6px; cursor:pointer;">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const editBtn = document.getElementById("editBtn");
    const saveBtn = document.getElementById("saveBtn");
    const cancelBtn = document.getElementById("cancelBtn");
    const inputs = document.querySelectorAll("#profileForm input, #profileForm select");

    function toggleForm(disabled) {
        inputs.forEach(el => {
            if (el.name !== "_token") {
                el.disabled = disabled;
            }
        });
    }

    toggleForm(true);

    editBtn.addEventListener("click", () => {
        toggleForm(false);
        editBtn.style.display = "none";
        saveBtn.style.display = "inline-block";
        cancelBtn.style.display = "inline-block";
    });

    cancelBtn.addEventListener("click", () => {
        toggleForm(true);
        editBtn.style.display = "inline-block";
        saveBtn.style.display = "none";
        cancelBtn.style.display = "none";
    });
</script>
@endsection
