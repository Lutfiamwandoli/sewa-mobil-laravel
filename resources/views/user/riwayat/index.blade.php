@extends('layouts.app')

@section('content')
    <!-- Breadcrumb -->
    <div style="font-size:14px; color:#555; margin-bottom:15px;">
        Beranda > <span style="color:#1a3c6e; font-weight:600;">Profil</span>
    </div>

    <div style="max-width: 1200px; margin: 20px auto; font-family: Arial, sans-serif; display:flex; gap:20px;">
        
        <!-- Sidebar -->
        <div style="flex:1; max-width:250px;">
            @include('user.profile.sidebar')
        </div>

        <!-- Konten Riwayat -->
        <div style="flex:3;">
            <h4 style="margin-bottom:15px;">Riwayat Sewa</h4>

            @forelse($riwayat as $item)
                {{-- Status --}}
                <div style="font-weight:bold; color: {{ $item->status_pemesanan == 'Selesai' ? 'green' : 'orange' }}; margin-bottom:5px;">
                    {{ $item->status_pemesanan }}
                </div>

               {{-- Card --}}
<div style="border:1px solid #cfd8dc; border-radius:6px; overflow:hidden; margin-bottom:20px;">

    {{-- Header --}}
    <div style="display:flex; align-items:center; padding:10px; border-bottom:1px solid #cfd8dc;">
        <img src="{{ $item->mobil->foto ?? asset('images/no-image.png') }}" 
             alt="Mobil" 
             style="width:70px; height:50px; border-radius:4px; object-fit:cover; margin-right:10px;">

        <div>
            <div style="font-weight:bold;">{{ $item->mobil->nama_mobil ?? '-' }} {{ $item->mobil->tahun ?? '' }}</div>
        </div>
    </div>

    {{-- Body --}}
    <div style="padding:15px; font-size:14px; color:#333;">

        {{-- Label header baris --}}
        <div style="display:flex; font-weight:bold; margin-bottom:5px;">
            <div style="flex:1;">Tanggal Mulai</div>
            <div style="flex:1;">Tanggal Selesai</div>
            <div style="flex:1;">Paket</div>
        </div>

        {{-- Isi data --}}
        <div style="display:flex; margin-bottom:15px;">
            <div style="flex:1;">
                {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d-m-Y') }}
            </div>
            <div style="flex:1;">
                {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d-m-Y') }}
            </div>
            <div style="flex:1;">
                {{ $item->paket->nama_paket ?? '-' }}
            </div>
        </div>

        {{-- Harga --}}
        <div style="font-weight:bold; margin-bottom:10px;">
           Total Bayar : Rp {{ number_format($item->durasi * ($item->paket->harga ?? 0), 0, ',', '.') }}
        </div>

        {{-- Tombol --}}
        <a href="https://wa.me/6281234567890?text=Halo%20saya%20mau%20tanya%20tentang%20pemesanan%20{{ $item->id_pemesanan }}" 
           target="_blank" 
           style="display:block; text-align:center; background:#1a3c6e; color:#fff; 
                  padding:10px; border-radius:4px; margin-bottom:10px; text-decoration:none; font-weight:bold;">
            💬 Customer Service
        </a>

        <button type="button" 
                class="btn btn-outline-primary w-100" 
                style="font-weight:bold;" 
                data-bs-toggle="modal" 
                data-bs-target="#detailModal{{ $item->id_pemesanan }}">
            Lihat Rincian
        </button>
    </div>
</div>

              {{-- Modal Detail --}}
<div class="modal fade" id="detailModal{{ $item->id_pemesanan }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Detail Pemesanan {{ $item->nomor_transaksi }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body" style="font-size:14px; line-height:1.6;">
        <div class="row">
          <div class="col-md-6">
            <p><strong>Nomor Pemesanan:</strong> {{ $item->nomor_transaksi }}</p>
            <p><strong>Tanggal Pemesanan:</strong> {{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</p>
            <p><strong>Tanggal Mulai:</strong> {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d-m-Y') }}</p>
            <p><strong>Tanggal Selesai:</strong> {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d-m-Y') }}</p>
            <p><strong>Paket:</strong> {{ $item->mobil->paket->nama_paket ?? '-' }}</p>
            <p><strong>Mobil:</strong> {{ $item->mobil->nama_mobil ?? '-' }} {{ $item->mobil->tahun ?? '' }}</p>
          </div>
          <div class="col-md-6">
            <p><strong>Hitungan Sewa:</strong> Per Hari</p>
            <p><strong>Total Harga:</strong> Rp {{ number_format($item->durasi * $item->paket->harga, 0, ',', '.') }}</p>
            <p><strong>Bukti Pembayaran:</strong></p>
            @if($item->bukti_pembayaran)
              <img src="{{ asset('storage/'.$item->bukti_pembayaran) }}" 
                   alt="Bukti Pembayaran" 
                   style="width:120px; border:1px solid #ddd; border-radius:5px;">
            @else
              <p>-</p>
            @endif
          </div>
        </div>

        <hr>

        {{-- Form Review --}}
        <form action="{{ route('review.store') }}" method="POST">
          @csrf
          <input type="hidden" name="nama" value="{{ Auth::user()->nama }}">
          <input type="hidden" name="mobil" value="{{ $item->mobil->nama_mobil ?? '-' }}">

          {{-- Rating --}}
          <div class="mb-3">
            <label class="form-label">Rating</label><br>
            <div class="rating" data-id="{{ $item->id_pemesanan }}">
              @for ($i = 1; $i <= 5; $i++)
                <input type="radio" name="rating" value="{{ $i }}" id="star{{ $item->id_pemesanan }}-{{ $i }}" style="display:none;" required>
                <label for="star{{ $item->id_pemesanan }}-{{ $i }}" class="star" style="font-size:28px; cursor:pointer; color:#ccc;">★</label>
              @endfor
            </div>
          </div>

          {{-- Komentar --}}
          <div class="mb-3">
            <label class="form-label">Komentar</label>
            <textarea name="komentar" class="form-control" rows="3" required></textarea>
          </div>

          <button type="submit" class="btn btn-primary">Kirim</button>
        </form>
      </div>
    </div>
  </div>
</div>

{{-- Script Rating Bintang --}}
@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".rating").forEach(function(ratingDiv) {
        let stars = ratingDiv.querySelectorAll(".star");
        stars.forEach((star, index) => {
            star.addEventListener("click", function() {
                stars.forEach((s, i) => {
                    s.style.color = i <= index ? "#ffc107" : "#ccc"; // kuning untuk yang dipilih
                });
            });
        });
    });
});
</script>
@endpush

            @empty
                <p>Tidak ada riwayat pemesanan.</p>
            @endforelse

        </div>
    </div>
@endsection
