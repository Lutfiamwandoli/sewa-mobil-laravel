@extends('layouts.app')

@section('content')
<div style="
    max-width: 900px; 
    margin: 40px auto; 
    padding: 40px; 
    background-color: #fff; 
    border-radius: 10px; 
    border: 3px solid #1E3E62; 
    box-shadow: 0 6px 15px rgba(0,0,0,0.1); 
    font-family: 'Poppins', sans-serif; 
    font-weight: 500; 
    font-size: 30px; 
    line-height: 1.6; 
    letter-spacing: 0;
    ">
    
    <h2 style="
        font-size: 36px; 
        font-weight: 600; 
        line-height: 1.4; 
        margin-bottom: 30px; 
        text-align: center; 
        color: #1E3E62;
        ">
        Cara Sewa Mobil di PUSKOPKA JATENG
    </h2>

    <ol style="
        list-style-type: decimal; 
        padding-left: 30px; 
        line-height: 1.8; 
        color: #1E3E62;
        font-weight: 400;
        font-size: 20px;
        letter-spacing: 0;
        ">
        <li>Penyewa melakukan Registrasi (jika belum punya akun) atau Login (jika sudah punya akun).</li>
        <li>Penyewa mencari mobil dengan memasukkan data yang diperlukan di form pencarian mobil.</li>
        <li>Penyewa mengisi formulir pemesanan.</li>
        <li>Penyewa melakukan pembayaran, Admin akan melakukan validasi terhadap bukti pembayaran yang sudah dikirim oleh Penyewa.</li>
        <li>Penyewa menunjukkan identitas asli pada saat pengambilan mobil.</li>
        <li>Penyewa menggunakan mobil sesuai dengan kontrak yang sudah disepakati.</li>
        <li>Penyewa mengembalikan mobil sesuai dengan waktu yang telah ditentukan.</li>
    </ol>
</div>
@endsection
