<div style="flex:1; background:#fff; border-radius:8px; padding:20px; 
            box-shadow:0 2px 6px rgba(0,0,0,0.1); height:fit-content;">
    <div style="text-align:center; margin-bottom:20px;">
        <img src="{{ asset($user->foto ?? 'gambar/default.png') }}" 
             alt="Foto Profil" 
             style="width:70px; height:70px; border-radius:50%; object-fit:cover; display:block; margin:0 auto;">
        <p style="margin-top:10px; font-size:14px; font-weight:600; color:#333;">{{ $user->username }}</p>
        <a href="{{ route('profile.index') }}" style="font-size:12px; color:#1a3c6e; text-decoration:none;">✎ Ubah Profil</a>
    </div>

    <ul style="list-style:none; padding:0; margin:0; font-size:14px;">
        <li style="margin:12px 0;">
            <a href="{{ route('profile.index') }}" 
               style="text-decoration:none; display:flex; align-items:center; gap:10px; 
                      color:{{ request()->routeIs('profile.*') ? '#1a3c6e' : '#333' }}; 
                      font-weight:{{ request()->routeIs('profile.*') ? '600' : '400' }};">
                <img src="{{ asset('gambar/profill.png') }}" width="18"> Profil
            </a>
        </li>
        <li style="margin:12px 0;">
            <a href="{{ route('riwayat.index') }}" 
               style="text-decoration:none; display:flex; align-items:center; gap:10px; 
                      color:{{ request()->routeIs('riwayat.*') ? '#1a3c6e' : '#333' }}; 
                      font-weight:{{ request()->routeIs('riwayat.*') ? '600' : '400' }};">
                <img src="{{ asset('gambar/buku.png') }}" width="18"> Riwayat Sewa
            </a>
        </li>
        <li style="margin:12px 0;">
            <a href="{{ route('password.edit') }}" 
               style="text-decoration:none; display:flex; align-items:center; gap:10px; color:#333;">
                <img src="{{ asset('gambar/gembok.png') }}" width="18"> Ubah Password
            </a>
        </li>
        <li style="margin:12px 0;">
    <a href="#" 
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
       style="text-decoration:none; display:flex; align-items:center; gap:10px; color:#e74c3c; font-weight:600;">
        <img src="{{ asset('gambar/keluar.png') }}" width="18"> Logout
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</li>

    </ul>
</div>
