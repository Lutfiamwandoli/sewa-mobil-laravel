@extends('layouts.app')

@section('content')
<div style="background-color:#f3f4f6; font-family:Arial, sans-serif;">


    <!-- Hero Section -->
    <div style="background:linear-gradient(to right,#eff6ff,#f3f4f6); padding:40px 0;">
        <div style="width:90%; max-width:1200px; margin:auto; display:grid; grid-template-columns:1fr 1fr; gap:30px; align-items:center;">
            
            <!-- Banner -->
            <div style="text-align:center;">
                <img src="{{ asset('gambar/baner.png') }}" alt="Banner Mobil" style="max-width:100%; border-radius:8px;">
            </div>

            <!-- Text -->
            <div>
                <h1 style="font-size:28px; font-weight:bold; margin-bottom:15px;">TEMAN SETIA PERJALANAN ANDA</h1>
                <p style="margin-bottom:20px; color:#374151; font-size:16px; line-height:1.5;">
                    Perjalanan terbaik dimulai dari pilihan yang tepat.
PUSKOPKA Jateng menjadi langkah pertama untuk mewujudkan petualangan impianmu
                </p>
            </div>
        </div>
    </div>

<form action="{{ route('user.search') }}" method="GET" class="flex">
    <div style="max-width: 900px; margin: -60px auto 0; background: white; border: 1px solid #ccc; border-radius: 8px; padding: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); position: relative;">
        <h2 style="font-size: 18px; font-weight: bold; margin-bottom: 15px;">Cari Sekarang</h2>

        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; align-items: center;">
            
            <!-- Lokasi Rental (readonly) -->
            <div>
                <label style="font-size: 14px; font-weight: 500;">Lokasi Rental</label>
                <div style="position: relative;">
                    <img src="{{ asset('gambar/lokasi2.png') }}" 
                         style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); width: 16px; height: 16px;">
                    <input type="text"  value="Semarang" readonly
                           style="width: 100%; padding: 8px 8px 8px 35px; border: 1px solid #ccc; border-radius: 5px; background:#f5f5f5;">
                </div>
            </div>

            <!-- Wilayah -->
            <div>
                <label style="font-size: 14px; font-weight: 500;">Wilayah</label>
                <div style="position: relative;">
                    <img src="{{ asset('gambar/lokasi1.png') }}" 
                         style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); width: 16px; height: 16px;">
                    <select name="wilayah" style="width: 100%; padding: 8px 8px 8px 35px; border: 1px solid #ccc; border-radius: 5px;">
                        <option value="">Semua Wilayah</option>
                        @foreach($pakets->groupBy('wilayah') as $wilayah => $items)
                            <option value="{{ $wilayah }}">{{ $wilayah }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Tanggal Mulai -->
            <div>
                <label style="font-size: 14px; font-weight: 500;">Tanggal Mulai</label>
                <div style="position: relative;">
                    <img src="{{ asset('gambar/bx_calendar.png') }}" 
                         style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); width: 16px; height: 16px;">
                    <input type="date" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}" 
                           style=" width: 100%; padding: 8px 8px 8px 35px; border: 1px solid #ccc; border-radius: 5px;">
                </div>
            </div>

            <!-- Kota Tujuan -->
            <div>
                <label style="font-size: 14px; font-weight: 500;">Kota Tujuan</label>
                <div style="position: relative;">
                    <img src="{{ asset('gambar/lokasi2.png') }}" 
                         style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); width: 16px; height: 16px;">
                    <select name="tujuan_kota" style="width: 100%; padding: 8px 8px 8px 35px; border: 1px solid #ccc; border-radius: 5px;">
                        <option value="">Semua Kota</option>
                        @foreach($pakets->groupBy('tujuan_kota') as $kota => $items)
                            <option value="{{ $kota }}">{{ $kota }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Paket -->
            <div>
                <label style="font-size: 14px; font-weight: 500;">Paket</label>
                <div style="position: relative;">
                    <img src="{{ asset('gambar/car.png') }}" 
                         style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); width: 16px; height: 16px;">
                    <select name="paket" style="width: 100%; padding: 8px 8px 8px 35px; border: 1px solid #ccc; border-radius: 5px;">
                        <option value="">Semua Paket</option>
                        @foreach($pakets->groupBy('nama_paket') as $nama => $items)
                            <option value="{{ $nama }}">{{ $nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Tanggal Selesai -->
            <div>
                <label style="font-size: 14px; font-weight: 500;">Tanggal Selesai</label>
                <div style="position: relative;">
                    <img src="{{ asset('gambar/bx_calendar.png') }}" 
                         style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); width: 16px; height: 16px;">
                        <input type="date" name="tanggal_selesai" value="{{ request('tanggal_selesai') }}" 
                           style="appearance: none; -webkit-appearance: none; width: 100%; padding: 8px 8px 8px 35px; border: 1px solid #ccc; border-radius: 5px;">
                </div>
            </div>
        </div>

        <!-- Tombol Cari -->
        <button type="submit" 
                style="margin-top: 15px; width: 100%; background: #1a3c6e; color: white; font-weight: bold; padding: 10px; border-radius: 6px; border: none; cursor: pointer;">
            Cari Mobil
        </button>
    </div>
</form>


</div>

<div style="width:90%; max-width:1200px; margin:50px auto; text-align:center;">
    <h2 style="font-size:22px; font-weight:bold; margin-bottom:30px; color:#1e3a5f;">
        MENGAPA SEWA MOBIL DI PUSKOPKA JATENG?
    </h2>

    <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:20px; margin-bottom:30px;">
        <div style="text-align:center;">
            <img src="{{ asset('gambar/Group_138.png') }}" alt="Harga Terjangkau" style="width:100%; max-width:220px; margin:auto;">
        </div>
        <div style="text-align:center;">
            <img src="{{ asset('gambar/Group_139.png') }}" alt="Mudah & Cepat" style="width:100%; max-width:220px; margin:auto;">
        </div>
        <div style="text-align:center;">
            <img src="{{ asset('gambar/Group_140.png') }}" alt="Lengkap & Terawat" style="width:100%; max-width:220px; margin:auto;">
        </div>
    </div>

    <div style="display:flex; justify-content:center;">
        <div style="text-align:center;">
            <img src="{{ asset('gambar/Group_141.png') }}" alt="Pelayanan 24/7" style="width:100%; max-width:220px; margin:auto;">
        </div>
    </div>
</div>
<!-- Review Pelanggan -->
<div style="width:90%; max-width:1100px; margin:50px auto; text-align:center;">
    <h2 style="font-size:22px; font-weight:bold; margin-bottom:25px; color:#1e3a5f;">APA KATA MEREKA</h2>

    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(300px,1fr)); gap:20px;">
        @foreach($reviews as $review)
            <div style="border:1px solid #ccc; border-radius:10px; padding:20px; background:#fff; text-align:left;">
                <div style="font-weight:bold; font-size:16px; margin-bottom:5px;">
                    {{ $review->nama }}
                </div>
                <div style="color:#ffb400; margin-bottom:10px;">
                    @for ($i = 0; $i < $review->rating; $i++)
                        ★
                    @endfor
                </div>
                <div style="font-size:14px; color:#444; margin-bottom:10px;">
                    <strong>Mobil :</strong> {{ $review->mobil }}
                </div>
                <p style="font-size:14px; color:#333;">{{ $review->komentar }}</p>
            </div>
        @endforeach
    </div>
</div>


@endsection
