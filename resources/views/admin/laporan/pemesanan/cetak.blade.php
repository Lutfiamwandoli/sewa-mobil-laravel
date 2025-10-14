<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan Pemesanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h2, .header p {
            margin: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table th, table td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }
    </style>
</head>
<body onload="window.print()">

    <div class="header">
        <h2>RENTAL MOBIL PUSKOPKA JATENG</h2>
        <p>Jl. Merak No. 2, Tanjung Mas, Kec. Semarang Utara, Kota Semarang, Jawa Tengah 50714</p>
        <p>Telp: (+62) 812 7650 6944</p>
        <hr>
        <h3>Laporan Pemesanan</h3>
        <p>Dari Tanggal: {{ $tanggal_awal }} s/d {{ $tanggal_akhir }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>NO</th>
                <th>NOMOR TRANSAKSI</th>
                <th>TANGGAL PEMESANAN</th>
                <th>NAMA PENYEWA</th>
                <th>MOBIL</th>
                <th>TANGGAL MULAI</th>
                <th>TANGGAL SELESAI</th>
                <th>DURASI</th>
                <th>PAKET SEWA</th>
                <th>STATUS</th>
            </tr>
        </thead>
        <tbody>
            @php
                $list = isset($pemesanan) ? $pemesanan : collect([$p]);
            @endphp
            @foreach($list as $i => $row)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $row->nomor_transaksi }}</td>
                <td>{{ $row->tanggal_pemesanan->format('d-m-Y') }}</td>
                <td>{{ $row->user->nama ?? '-' }}</td>
                <td>{{ $row->mobil->nama_mobil ?? '-' }} {{ $row->mobil->tipe ?? '' }}</td>
                <td>{{ $row->tanggal_mulai }}</td>
                <td>{{ $row->tanggal_selesai }}</td>
                <td>{{ $row->durasi }} hari</td>
                <td>{{ $row->paket->nama_paket ?? '-' }}</td>
                <td>{{ $row->status_pemesanan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
