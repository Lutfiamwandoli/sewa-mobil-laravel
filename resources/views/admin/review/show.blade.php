@extends('layouts.admin.app')

@section('title', 'Detail Testimoni')

@section('content')
<div class="container mt-4">
    <div class="card p-3">
        <h6 class="mb-3 d-flex justify-content-between align-items-center">
            Detail Testimoni
            <a href="{{ route('admin.review.index') }}" class="btn btn-sm btn-secondary btn-danger">X</a>
        </h6>

        @php
            $fields = [
                'Nomor Pemesanan' => $review->pemesanan->nomor_transaksi ?? '-',
                'Nama Penyewa' => $review->nama ?? '-',
                'Mobil' => $review->mobil ?? '-',
                'Paket' => $review->pemesanan->paket->nama_paket ?? '-',
                'Durasi' => ($review->pemesanan->durasi ?? '-') . ' hari',
                'Dikirim Pada' => $review->created_at->format('d-m-Y'),
            ];
        @endphp

        @foreach($fields as $label => $value)
            <div style="display:flex; align-items:center; margin-bottom:12px;">
                <div style="width:150px; font-weight:bold;">{{ $label }}:</div>
                <div style="flex:1;">
                    <input type="text" class="form-control" value="{{ $value }}" readonly style="width:100%;">
                </div>
            </div>
        @endforeach

        <div style="display:flex; align-items:center; margin-bottom:12px;">
            <div style="width:150px; font-weight:bold;">Rating:</div>
            <div style="flex:1;">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $review->rating)
                        <span style="color:gold; font-size:18px;">&#9733;</span>
                    @else
                        <span style="color:#ccc; font-size:18px;">&#9733;</span>
                    @endif
                @endfor
            </div>
        </div>

        <div style="display:flex; align-items:flex-start; margin-bottom:12px;">
            <div style="width:150px; font-weight:bold; margin-top:5px;">Komentar:</div>
            <div style="flex:1;">
                <textarea class="form-control" rows="4" readonly style="width:100%;">{!! $review->komentar !!}</textarea>
            </div>
        </div>

    </div>
</div>
@endsection
