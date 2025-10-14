@extends('layouts.app')

@section('content')
<div style="max-width: 1000px; margin: 40px auto; padding: 30px; background-color: #fff; border-radius: 10px; border: 3px solid #1E3E62; box-shadow: 0 4px 10px rgba(0,0,0,0.1); font-family:'Poppins',sans-serif; color:#1E3E62;">

    <!-- Bagian Atas -->
    <div style="display: flex; justify-content: space-between; flex-wrap: wrap; gap: 20px;">
        <!-- Kiri -->
        <div style="flex:1; min-width: 250px;">
            <img src="{{ asset('gambar/puskopa.png') }}" alt="Logo PUSKOPKA" style="height:60px; margin-bottom:15px;">

            <h3 style="font-size:20px; font-weight:600;">PUSKOPKA JATENG</h3>
            <p>Pusat Koperasi Keluarga Kereta Api Provinsi Jawa Tengah (PUSKOPKA JATENG)</p>

            <h4 style="margin-top:15px; font-size:18px; font-weight:600;">Alamat</h4>
            <p>Jalan Merak No. 2<br>Semarang, Jawa Tengah</p>

            <h4 style="margin-top:15px; font-size:18px; font-weight:600;">Kontak</h4>
            <p>(+62) 82137059894</p>
        </div>

        <!-- Kanan -->
        <div style="flex:1; min-width: 100px; text-align:center;">
            <h4 style="font-size:18px; font-weight:600; margin-bottom:15px;">Hubungi Kami</h4>
            <a href="https://wa.me/6282137059894" target="_blank" style="display:block; background:#1E3E62; color:#fff; padding:12px; border-radius:8px; text-decoration:none; font-weight:500; margin-bottom:10px;">WhatsApp</a>
            <a href="https://instagram.com/username" target="_blank" style="display:block; background:#1E3E62; color:#fff; padding:12px; border-radius:8px; text-decoration:none; font-weight:500;">Instagram</a>
        </div>
    </div>

    <!-- Map -->
    <div style="margin-top:40px; text-align:center;">
        <h3 style="font-size:22px; font-weight:600; margin-bottom:20px;">Temukan Kami Di</h3>
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.882723150621!2d110.4146489!3d-6.966667!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708b5d3e1b2c8b%3A0x7d57f79984b4e5d4!2sSemarang%20Tawang%20Station!5e0!3m2!1sid!2sid!4v0000000000000"
            width="100%" height="400" style="border:0; border-radius:10px;" allowfullscreen="" loading="lazy">
        </iframe>
    </div>

</div>
@endsection
