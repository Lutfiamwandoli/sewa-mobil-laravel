@extends('layouts.app')

@section('content')
<div style="display: flex; max-width: 1200px; margin: 40px auto; gap: 30px; font-family: 'Poppins', sans-serif;">

<aside style="flex:1; min-width:250px; background-color:#f5f5f5; border-radius:10px; padding:20px; border:2px solid #1E3E62; height:fit-content;">
    <h3 style="font-size:22px; font-weight:600; color:#1E3E62; margin-bottom:20px;">Pilih Topik</h3>
    <hr style="border: solid 0.5px #1E3E62;">
    <ul style="list-style:none; padding:0;">
        <li style="margin-bottom:10px;">
            <a href="{{ route('panduan.lepas_kunci') }}" 
               style="display:block; padding:8px 12px; text-decoration:none; color: {{ Request::is('panduan/lepas-kunci') ? '#fff' : '#1E3E62' }}; background-color: {{ Request::is('panduan/lepas-kunci') ? '#1E3E62' : 'transparent' }}; border-radius:5px;">
               Sewa Lepas Kunci
            </a>
        </li>
        <li style="margin-bottom:10px;">
            <a href="{{ route('panduan.driver') }}" 
               style="display:block; padding:8px 12px; text-decoration:none; color: {{ Request::is('panduan/driver') ? '#fff' : '#1E3E62' }}; background-color: {{ Request::is('panduan/driver') ? '#1E3E62' : 'transparent' }}; border-radius:5px;">
               Sewa Dengan Driver Tanpa BBM
            </a>
        </li>
    </ul>
</aside>

<div style="max-width: 900px; margin: 40px auto; padding: 30px; background-color: #fff; border-radius: 10px; border: 3px solid #1E3E62; box-shadow: 0 4px 10px rgba(0,0,0,0.1); font-family: 'Poppins', sans-serif; line-height: 1.8; font-size: 18px; color: #1E3E62;">
    
    <h2 style="font-size: 28px; font-weight: 600; margin-bottom: 20px; text-align: center;">Sewa Dengan Driver Tanpa BBM</h2>

    <!-- Pembatalan -->
    <h3 style="font-size: 22px; font-weight: 600; margin-top: 20px;">Pembatalan</h3>
    <p>Tidak ada refund untuk pembatalan sewa kendaraan.</p>

    <!-- Penggunaan -->
    <h3 style="font-size: 22px; font-weight: 600; margin-top: 20px;">Penggunaan</h3>
            <ul style="list-style: decimal; padding-left: 20px;">
        <li>Harga belum termasuk biaya Tol, Parkir, BBM, tiket masuk tempat wisata, uang makan supir, dan biaya penginapan supir (apabila menginap).</li>
        <li>Kehilangan atau kerusakan barang penyewa adalah di luar tanggung jawab PUSKOPKA JATENG.</li>
        <li>Untuk perubahan jadwal penyewaan dapat dilakukan maksimal 1 minggu dari mulainya jadwal sewa awal.</li>
    </ul>
</div>
</div>
@endsection
