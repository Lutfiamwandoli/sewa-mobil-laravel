@extends('layouts.app')

@section('content')
<div style="font-size:14px; color:#555; margin-bottom:15px;">
    Beranda > <span style="color:#1a3c6e; font-weight:600;">Ubah Password</span>
</div>

<div style="max-width: 1000px; margin: 20px auto; font-family: Arial, sans-serif;">
    <div style="display:flex; gap:30px;">
        {{-- Sidebar --}}
        <div style="flex: 0 0 250px;">
            @include('user.profile.sidebar')
        </div>

        {{-- Konten utama --}}
        <div style="flex:1; background:#fff; padding:30px; border-radius:10px; box-shadow:0 4px 15px rgba(0,0,0,0.1);">
            <h4 style="margin-bottom:20px;">Ubah Password</h4>
            <p style="font-size:14px; color:#555; margin-bottom:25px;">
                Kata sandi Anda harus paling tidak 6 karakter dan harus menyertakan kombinasi huruf besar, huruf kecil, dan angka.
            </p>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
{{-- Password lama --}}
<div style="margin-bottom:20px; position: relative;">
    <label style="font-weight:bold; display:block; margin-bottom:5px;">Kata sandi saat ini</label>
    <input type="password" id="current_password" name="current_password" class="form-control" required>
    <img id="icon_current_password"
         src="{{ asset('gambar/hidden.png') }}"
         onclick="togglePassword('current_password', 'icon_current_password')"
         style="position:absolute; right:10px; top:35px; cursor:pointer; width:20px; height:20px;">
</div>

{{-- Password baru --}}
<div style="margin-bottom:20px; position: relative;">
    <label style="font-weight:bold; display:block; margin-bottom:5px;">Kata sandi baru</label>
    <input type="password" id="new_password" name="new_password" class="form-control" required>
    <img id="icon_new_password"
         src="{{ asset('gambar/hidden.png') }}"
         onclick="togglePassword('new_password', 'icon_new_password')"
         style="position:absolute; right:10px; top:35px; cursor:pointer; width:20px; height:20px;">
</div>

{{-- Konfirmasi --}}
<div style="margin-bottom:25px; position: relative;">
    <label style="font-weight:bold; display:block; margin-bottom:5px;">Konfirmasi kata sandi baru</label>
    <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" required>
    <img id="icon_new_password_confirmation"
         src="{{ asset('gambar/hidden.png') }}"
         onclick="togglePassword('new_password_confirmation', 'icon_new_password_confirmation')"
         style="position:absolute; right:10px; top:35px; cursor:pointer; width:20px; height:20px;">
</div>


                <button type="submit" class="btn btn-primary w-100">Ubah Password</button>
            </form>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);

    if (input.type === "password") {
        input.type = "text";
        icon.src = "{{ asset('gambar/ee.png') }}"; // icon untuk password terlihat
    } else {
        input.type = "password";
        icon.src = "{{ asset('gambar/hidden.png') }}"; // icon untuk password tersembunyi
    }
}
    // Notifikasi pop-up
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session("success") }}',
            confirmButtonColor: '#1a3c6e'
        });
    @endif

    @if($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Terjadi Kesalahan',
            html: `
                <ul style="text-align:left; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            `,
            confirmButtonColor: '#d33'
        });
    @endif
</script>
@endsection
