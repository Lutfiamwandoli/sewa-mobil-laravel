<nav style="background-color:#0d3b66; color:white; padding:10px 20px; display:flex; align-items:center; justify-content:space-between;">
    
    <!-- Logo -->
    <div style="display:flex; align-items:center;">
        <img src="{{ asset('gambar/puskopa.png') }}" alt="Logo" style="height:40px; margin-right:10px;">
    </div>

    <!-- Menu -->
    <ul style="list-style:none; display:flex; margin:0; padding:0; gap:20px;">
        <li style="display:inline;">
            <a href="{{ url('/') }}" style="color:white; text-decoration:none; font-weight:normal; padding:5px;"
               onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
               Beranda
            </a>
        </li>
        <li style="display:inline; position:relative;">
            <a href="#" style="color:white; text-decoration:none; padding:5px;"
               onmouseover="this.nextElementSibling.style.display='block'" 
               onmouseout="this.nextElementSibling.style.display='none'">
               Bantuan ▾
            </a>
            <!-- Dropdown -->
            <ul style="display:none; position:absolute; background:white; color:black; margin-top:5px; padding:0; list-style:none; border-radius:4px; min-width:120px;"
                onmouseover="this.style.display='block'" onmouseout="this.style.display='none'">
                <li><a href="{{ url('/cara-sewa') }}" style="display:block; padding:8px 12px; color:black; text-decoration:none;" 
                       onmouseover="this.style.backgroundColor='#f1f1f1'" onmouseout="this.style.backgroundColor='transparent'">Cara Sewa</a></li>
                <li><a href="{{ url('/panduan/lepas-kunci') }}" style="display:block; padding:8px 12px; color:black; text-decoration:none;" 
                       onmouseover="this.style.backgroundColor='#f1f1f1'" onmouseout="this.style.backgroundColor='transparent'">Syarat dan Ketentuan</a></li>
            </ul>
        </li>
        <li style="display:inline;">
            <a href="{{ url('/about') }}" style="color:white; text-decoration:none; padding:5px;"
               onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
               Tentang Kami
            </a>
        </li>
        <li style="display:inline;">
            <a href="{{ url('/contact') }}" style="color:white; text-decoration:none; padding:5px;"
               onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
               Hubungi Kami
            </a>
        </li>
    </ul>
<!-- User Icon -->
<div>
    @if(Auth::check())
        <!-- User sudah login -->
        <a href="{{ url('/profile') }}">
            <img src="{{ asset('gambar/profil.png') }}" 
                 style="height:30px; width:30px; cursor:pointer;" 
                 alt="Profil">
        </a>
    @else
        <!-- User belum login -->
        <a href="{{ url('/login') }}">
            <img src="{{ asset('gambar/profil.png') }}" 
                 style="height:30px; width:30px; cursor:pointer;" 
                 alt="Login">
        </a>
    @endif
</div>



</nav>
