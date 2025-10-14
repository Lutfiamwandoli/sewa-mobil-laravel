@extends('layouts.app')

@section('content')
<div style="display: flex; max-width: 1200px; margin: 40px auto; gap: 30px; font-family: 'Poppins', sans-serif;">

    <!-- Sidebar -->
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


    <!-- Konten -->
    <div style="flex: 3; background-color: #fff; border-radius: 10px; border: 3px solid #1E3E62; padding: 30px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); line-height: 1.8; font-size: 18px; color: #1E3E62;">
        
        <!-- Sewa Lepas Kunci -->
        <section id="sewa-lepas-kunci">
            <h2 style="font-size: 28px; font-weight: 600; margin-bottom: 20px;">Sewa Lepas Kunci</h2>
            <hr style="border: solid 0.5px">
            <p><b>Syarat dan Ketentuan Sewa:</b></p>
            <ul style="list-style: decimal; padding-left: 20px;">
                <li>Usia minimum untuk Penyewa adalah 17 (tujuh belas) tahun dan maksimum adalah 60 (enam puluh) tahun.</li>
                <li>Penyewa wajib menyerahkan salah satu dari dokumen-dokumen (ASLI) berikut terlebih dahulu (disebut “Dokumen Jaminan”), sebelum menandatangani perjanjian sewa:
                    <ul style="list-style: disc; padding-left: 20px;">
                        <li>Elektronik-KTP atau Passport (Identitas diri Penyewa)</li>
                        <li>SIM C / STNK Kendaraan milik Penyewa</li>
                    </ul>
                </li>
                <li>Penyewa wajib menyerahkan Uang Jaminan (“Deposit”) minimal Rp. 300.000 sebelum masa sewa dimulai / pada saat serah terima kendaraan.</li>
                <li>Dokumen Jaminan dan Deposit disimpan selama masa sewa dan dikembalikan setelah masa sewa berakhir, jika tidak ada masalah.</li>
                <li>Penyewa setuju untuk mengambil kendaraan pada saat awal sewa di lokasi domisili kantor PUSKOPKA JATENG.</li>
                <li>Penyewa wajib mengembalikan kendaraan dalam kondisi baik dan lengkap sesuai lokasi awal.</li>
                <li>Serah terima kendaraan harus dilakukan langsung oleh Penyewa, kecuali dengan persetujuan PUSKOPKA JATENG.</li>
                <li>Penyewa wajib membayar Overtime jika pemakaian melebihi batas waktu yang ditentukan.</li>
                <li>Jika kendaraan mengalami penilangan/kecelakaan/kerusakan/pencurian/kehilangan, Penyewa wajib melapor dan menyerahkan dokumen pendukung.</li>
                <li>Jika STNK kendaraan hilang, Penyewa bertanggung jawab atas biaya pengurusan STNK baru.</li>
                <li>Penyewa wajib membayar biaya ETLE jika terbukti pelanggaran lalu lintas selama periode sewa.</li>
                <li>Penyewa dilarang meminjamkan kendaraan kepada anak dibawah umur atau orang tanpa SIM resmi.</li>
                <li>Penyewa dilarang menggunakan kendaraan dalam kondisi pengaruh obat/alkohol atau untuk kegiatan kriminal/larangan hukum lainnya.</li>
                <li>Penyewa wajib menjaga kebersihan kendaraan, larangan merokok, dan menanggung biaya jika kendaraan dikembalikan kotor atau bau.</li>
            </ul>
        </section>

        

    </div>
</div>
@endsection
