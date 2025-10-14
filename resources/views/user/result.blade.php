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
                    <input type="text" value="Semarang" readonly
                           style="width: 100%; padding: 8px 8px 8px 35px; border: 1px solid #ccc; border-radius: 5px; background:#f5f5f5;">
                </div>
            </div>

            <!-- Wilayah -->
            <div>
                <label style="font-size: 14px; font-weight: 500;">Wilayah</label>
                <div style="position: relative;">
                    <img src="{{ asset('gambar/lokasi1.png') }}" 
                         style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); width: 16px; height: 16px;">
                    <select name="wilayah" 
                            style="width: 100%; padding: 8px 8px 8px 35px; border: 1px solid #ccc; border-radius: 5px;">
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
                    <input type="date" 
                           style="appearance: none; -webkit-appearance: none; width: 100%; padding: 8px 8px 8px 35px; border: 1px solid #ccc; border-radius: 5px;">
                </div>
            </div>

            <!-- Kota Tujuan -->
            <div>
                <label style="font-size: 14px; font-weight: 500;">Kota Tujuan</label>
                <div style="position: relative;">
                    <img src="{{ asset('gambar/lokasi2.png') }}" 
                         style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); width: 16px; height: 16px;">
                    <select name="tujuan_kota" 
                            style="width: 100%; padding: 8px 8px 8px 35px; border: 1px solid #ccc; border-radius: 5px;">
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
                    <select name="paket" 
                            style="width: 100%; padding: 8px 8px 8px 35px; border: 1px solid #ccc; border-radius: 5px;">
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
                    <input type="date" 
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

<div style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: center; margin: 20px;">
    @foreach ($pakets as $paket)
        <div style="width: 250px; border: 1px solid #ddd; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 6px rgba(0,0,0,0.15); font-family: Arial, sans-serif; background: #fff;">
            
            <!-- Gambar Mobil -->
            <div style="width: 100%; height: 160px; overflow: hidden;">
                <img src="{{ asset('storage/mobil/'.$paket->foto_mobil) }}" 
                     alt="{{ $paket->nama_mobil }}" 
                     style="width: 100%; height: 100%; object-fit: cover;">
            </div>

            <!-- Konten -->
            <div style="padding: 10px;">
                <!-- Nama Mobil -->
                <h3 style="font-size: 16px; font-weight: bold; margin: 5px 0; color: #1E3E62; text-align: center;">
                    {{ $paket->nama_mobil }}
                </h3>

                
                <!-- Info Detail -->
                <div style="font-size: 13px; color: #555; display: flex; justify-content: space-between; margin: 5px 0; align-items: center;">
                    <span style="display:inline-flex; align-items:center;">
                        <img src="{{ asset('gambar/kalender.png') }}" alt="tahun" style="width:16px; margin-right:5px;">
                        {{ $paket->tahun_mobil }}
                    </span>
                    <span style="display:inline-flex; align-items:center;">
                        <img src="{{ asset('gambar/fuel.png') }}" alt="bbm" style="width:16px; margin-right:5px;">
                        {{ $paket->bahan_bakar ?? 'Pertalite' }}
                    </span>
                    <span style="display:inline-flex; align-items:center;">
                        <img src="{{ asset('gambar/person.png') }}" alt="kapasitas" style="width:16px; margin-right:5px;">
                        {{ $paket->kapasitas ?? '5 orang' }}
                    </span>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; margin: 10px 0;">
                    <span style="font-weight: bold; font-size: 14px; color: #222;">
                        Rp {{ number_format($paket->harga, 0, ',', '.') }}
                    </span>
                    <span style="font-size: 12px; font-weight: bold; color: green; background: #e8f7e8; padding: 3px 6px; border-radius: 5px;">
                        {{ strtoupper($paket->status_mobil) }}
                    </span>
                </div>

                <a href="{{ route('mobil.show', $paket->id_mobil) }}?tanggal_mulai={{ request('tanggal_mulai') }}&tanggal_selesai={{ request('tanggal_selesai') }}&tujuan_kota={{ request('tujuan_kota') ?? '' }}" 
   style="display: block; text-align: center; background: #1e3a8a; color: white; padding: 10px; border-radius: 6px; font-size: 14px; font-weight: bold; text-decoration: none; transition: 0.3s;">
   PESAN
</a>

            </div>
        </div>
    @endforeach
</div>

<!-- Pagination -->
<div style="margin: 20px; text-align: center;">
    {{ $pakets->links() }}
</div>
@endsection
