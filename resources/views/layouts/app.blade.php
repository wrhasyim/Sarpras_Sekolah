<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Sarpras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>
    <div class="d-flex">
        <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px; min-height: 100vh;">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <span class="fs-4">Sarpras Sekolah</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link text-white {{ request()->is('dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('sarpras.index') }}" class="nav-link text-white {{ request()->is('sarpras*') ? 'active' : '' }}">
                        <i class="bi bi-box-seam"></i> Manajemen Sarpras
                    </a>
                </li>
                {{-- Menu Khusus Admin --}}
                @if(Auth::user()->role == 'admin')
                <li>
                    <a href="{{ route('users.index') }}" class="nav-link text-white {{ request()->is('users*') ? 'active' : '' }}">
                        <i class="bi bi-people"></i> Manajemen User
                    </a>
                </li>
                @endif

                 {{-- Menu untuk Admin dan TU --}}
                @if(in_array(Auth::user()->role, ['admin', 'tu']))
                <li>
                    <a href="{{ route('kelas.index') }}" class="nav-link text-white {{ request()->is('kelas*') ? 'active' : '' }}">
                        <i class="bi bi-geo-alt"></i> Manajemen Lokasi
                    </a>
                </li>
                <li>
                    <a href="{{ route('laporan.index') }}" class="nav-link text-white {{ request()->is('laporan*') ? 'active' : '' }}">
                        <i class="bi bi-file-earmark-text"></i> Laporan
                    </a>
                </li>
                <li>
                    <a href="{{ route('rekap.index') }}" class="nav-link text-white {{ request()->is('rekap*') ? 'active' : '' }}">
                        <i class="bi bi-calendar-check"></i> Rekap Bulanan
                    </a>
                </li>
                @endif
            </ul>
            <hr>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <strong>{{ Auth::user()->name }}</strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">Sign out</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <div class="w-100 p-4">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts') {{-- <-- TAMBAHKAN BARIS INI --}}
</body>
</html>