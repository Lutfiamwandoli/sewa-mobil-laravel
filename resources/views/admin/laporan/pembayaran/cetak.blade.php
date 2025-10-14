<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pembayaran</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table, th, td { border: 1px solid black; padding: 6px; text-align: center; vertical-align: middle; }
        th { background: #f0f0f0; }
        .text-left { text-align: left; }
        .right { text-align: right; }
        .footer { margin-top: 12px; font-size: 11px; text-align: right; }
        .muted { font-size: 11px; color: #555; }
    </style>
</head>
<body>

    <div class="header">
        <h2>RENTAL MOBIL PUSKOPKA JATENG</h2>
        <p class="muted">Jl. Merak No. 2, Tanjung Mas, Kec. Semarang Utara, Kota Semarang, Jawa Tengah 50174</p>
        <p class="muted">Telp: (+62) 81276576944</p>
        <hr>
        <h4>Laporan Pembayaran</h4>
        @if(isset($tanggal_awal) || isset($tanggal_akhir))
            <p class="muted">
                @if(isset($tanggal_awal)) Dari: {{ $tanggal_awal }} @endif
                @if(isset($tanggal_akhir)) &nbsp; s/d &nbsp; {{ $tanggal_akhir }} @endif
            </p>
        @endif
    </div>

    {{-- SINGLE PAYMENT --}}
    @if(isset($p))
        <table>
            <thead>
                <tr>
                    <th>No. Pembayaran</th>
                    <th>Tanggal Pembayaran</th>
                    <th>Nama Penyewa</th>
                    <th>Mobil</th>
                    <th>Paket</th>
                    <th>Metode</th>
                    <th>Jumlah Bayar</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $p->id_pembayaran }}</td>
                    <td>
                        {{ isset($p->tanggal_pembayaran) ? \Carbon\Carbon::parse($p->tanggal_pembayaran)->format('d-m-Y') : '-' }}
                    </td>
                    <td>
                        {{ $p->pemesanan->user->name ?? $p->pemesanan->user->nama ?? '-' }}
                    </td>
                    <td>
                        {{ $p->pemesanan->mobil->nama_mobil ?? $p->pemesanan->mobil->merk ?? '-' }}
                    </td>
                    <td>{{ $p->pemesanan->paket->nama_paket ?? '-' }}</td>
                    <td class="text-left">{{ $p->metode_pembayaran ?? '-' }}</td>
                    <td class="right">Rp {{ number_format($p->jumlah_bayar ?? 0, 0, ',', '.') }}</td>
                    <td>{{ isset($p->status) ? ucfirst($p->status) : '-' }}</td>
                </tr>
            </tbody>
        </table>

    {{-- LIST OF PAYMENTS --}}
    @elseif(isset($pembayaran))
        @if($pembayaran->isEmpty())
            <p class="muted">Tidak ada data pembayaran.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No. Pembayaran</th>
                        <th>Tanggal Pembayaran</th>
                        <th>Nama Penyewa</th>
                        <th>Mobil</th>
                        <th>Paket</th>
                        <th>Metode</th>
                        <th>Jumlah Bayar</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pembayaran as $i => $row)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $row->id_pembayaran }}</td>
                        <td>{{ isset($row->tanggal_pembayaran) ? \Carbon\Carbon::parse($row->tanggal_pembayaran)->format('d-m-Y') : '-' }}</td>
                        <td>{{ $row->pemesanan->user->name ?? $row->pemesanan->user->nama ?? '-' }}</td>
                        <td>{{ $row->pemesanan->mobil->nama_mobil ?? $row->pemesanan->mobil->merk ?? '-' }}</td>
                        <td>{{ $row->pemesanan->paket->nama_paket ?? '-' }}</td>
                        <td class="text-left">{{ $row->metode_pembayaran ?? '-' }}</td>
                        <td class="right">Rp {{ number_format($row->jumlah_bayar ?? 0, 0, ',', '.') }}</td>
                        <td>{{ isset($row->status) ? ucfirst($row->status) : '-' }}</td>
                    </tr>
                    @endforeach

                    {{-- Total --}}
                    <tr>
                        <td colspan="7" class="right"><strong>Total</strong></td>
                        <td class="right"><strong>Rp {{ number_format($pembayaran->sum('jumlah_bayar') ?? 0, 0, ',', '.') }}</strong></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        @endif
    @else
        <p class="muted">Tidak ada variabel pembayaran yang diberikan ke view. Pastikan controller mem-pass `p` untuk single atau `pembayaran` untuk list.</p>
    @endif

    <div class="footer">
        <div>Dicetak pada: {{ now()->format('d-m-Y H:i') }}</div>
    </div>
</body>
</html>
