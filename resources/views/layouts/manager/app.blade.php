<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Manager Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            overflow-x: hidden;
        }
        .navbar {
            background-color: #1E3E62 !important;
        }
        .wrapper {
            display: flex;
            flex: 1;
            overflow: hidden;
        }
        .sidebar {
            width: 240px;
            background-color: #fff;
            border-right: 1px solid #ddd;
            flex-shrink: 0;
        }
        .sidebar .nav-link {
            color: #333;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .sidebar .nav-link img {
            width: 20px;
            height: 20px;
        }
        .sidebar .nav-link:hover {
            background-color: #f5f5f5;
        }
        .sidebar .nav-link.active {
            background-color: #0d6efd;
            color: #fff;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
        }
    </style>
</head>
<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-dark px-3 d-flex justify-content-between">
        <span class="navbar-text text-white fw-bold">
            SELAMAT DATANG MANAGER | RENTAL MOBIL PUSKOPKA JATENG
        </span>
        {{-- Ikon Profil --}}
        <a href="{{ route('manager.profile.edit') }}">
            <img src="{{ asset('gambar/profil.png') }}" width="30" alt="Profile" class="rounded-circle">
        </a>
    </nav>

    {{-- Wrapper: Sidebar + Content --}}
    <div class="wrapper">
        {{-- Sidebar --}}
        <div class="sidebar d-flex flex-column">
            <ul class="nav flex-column mt-3">
                <li>
                    <a href="{{ route('manager.dashboard') }}" class="nav-link">
                        <img src="{{ asset('gambar/tdesign_dashboard-1-filled.png') }}" alt="Dashboard"> Dashboard
                    </a>
                </li>
                <li>
                    <a class="nav-link dropdown-toggle" data-bs-toggle="collapse" href="#laporanMenu" role="button" aria-expanded="false">
                        <img src="{{ asset('gambar/lsicon_report-outline.png') }}" alt="Laporan"> Laporan
                    </a>
                    <div class="collapse ps-4" id="laporanMenu">
                        <a href="{{ route('manager.laporan.pemesanan') }}" class="nav-link">Laporan Pemesanan</a>
                        <a href="{{ route('manager.laporan.pembayaran') }}" class="nav-link">Laporan Pembayaran</a>
                    </div>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" class="mt-3">
                        @csrf
                        <button class="btn btn-link nav-link text-danger d-flex align-items-center gap-2" type="submit">
                            <img src="{{ asset('gambar/majesticons_logout.png') }}" alt="Logout"> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>

        {{-- Main Content --}}
        <div class="content">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
