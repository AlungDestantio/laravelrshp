<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - RSH Pendidikan UNAIR</title>

    <link rel="icon" href="data:,">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    @yield('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="bi bi-heart-pulse-fill"></i>
                <span>RSH Pendidikan UNAIR</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="bi bi-house-fill"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('layanan') ? 'active' : '' }}" href="{{ route('layanan') }}">
                            <i class="bi bi-clipboard2-pulse"></i> Layanan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('struktur-organisasi') ? 'active' : '' }}" href="{{ route('struktur-organisasi') }}">
                            <i class="bi bi-diagram-3"></i> Struktur Organisasi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('kontak') ? 'active' : '' }}" href="{{ route('kontak') }}">
                            <i class="bi bi-telephone-fill"></i> Kontak
                        </a>
                    </li>

                    @if(Auth::check())
                        {{-- Tombol Dashboard --}}
                        @php
                            $role = Auth::user()->roleUsers->first()->idrole ?? 1;
                            $dashboardRoute = match($role) {
                                1 => route('admin.dashboard'),
                                2 => route('dokter.dashboard'),
                                3 => route('perawat.dashboard'),
                                4 => route('resepsionis.dashboard'),
                                default => route('admin.dashboard'),
                            };
                        @endphp
                        <li class="nav-item">
                            <a class="nav-link" href="{{ $dashboardRoute }}">
                                <i class="bi bi-house"></i> Dashboard
                            </a>
                        </li>

                        {{-- Tombol Logout --}}
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link" style="display:inline; padding:0; margin:0;">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right"></i> Login
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="footer-title">Rumah Sakit Hewan Pendidikan UNAIR</h5>
                    <p style="color: rgba(255,255,255,0.8);">
                        Rumah Sakit Hewan Pendidikan Universitas Airlangga berkomitmen memberikan pelayanan kesehatan hewan terbaik dengan didukung tenaga profesional dan fasilitas modern.
                    </p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="footer-title">Link Cepat</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}" class="footer-link"><i class="bi bi-chevron-right"></i> Home</a></li>
                        <li><a href="{{ route('layanan') }}" class="footer-link"><i class="bi bi-chevron-right"></i> Layanan</a></li>
                        <li><a href="{{ route('struktur-organisasi') }}" class="footer-link"><i class="bi bi-chevron-right"></i> Struktur Organisasi</a></li>
                        <li><a href="{{ route('kontak') }}" class="footer-link"><i class="bi bi-chevron-right"></i> Kontak</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="footer-title">Kontak Kami</h5>
                    <p style="color: rgba(255,255,255,0.8);">
                        <i class="bi bi-geo-alt-fill"></i> Kampus C UNAIR, Mulyorejo<br>
                        Surabaya, Jawa Timur 60115<br>
                        <i class="bi bi-telephone-fill"></i> (031) 5992785<br>
                        <i class="bi bi-envelope-fill"></i> rshp@unair.ac.id
                    </p>
                </div>
            </div>
            <hr style="border-color: rgba(255,255,255,0.2);">
            <div class="text-center" style="color: rgba(255,255,255,0.7);">
                <p class="mb-0">&copy; 2025 Rumah Sakit Hewan Pendidikan UNAIR. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>