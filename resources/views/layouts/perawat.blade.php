<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - RSH Pendidikan UNAIR</title>

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    @yield('styles')
</head>
<body>

    <!-- === NAVBAR ADMIN === -->
    <nav class="navbar navbar-admin navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('perawat.dashboard') }}">
                <i class="bi bi-heart-pulse-fill"></i>
                <span>RSH Pendidikan UNAIR</span>
            </a>

            <div class="ms-auto d-flex align-items-center">
                <!-- Tombol Dashboard -->
                <a href="{{ route('perawat.dashboard') }}" class="nav-link {{ request()->routeIs('perawat.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-house-fill"></i> Dashboard Perawat
                </a>

                <a href="{{ route('perawat.rekam-medis.index') }}" class="nav-link {{ request()->routeIs('perawat.rekam-medis.index') ? 'active' : '' }}">
                    <i class="bi bi-clipboard2-pulse-fill"></i> Rekam Medis
                </a>

                <!-- Tombol Logout -->
                <form action="{{ route('logout') }}" method="POST" class="m-0 ms-2">
                    @csrf
                    <button type="submit" class="nav-link border-0 bg-transparent">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- === MAIN CONTENT === -->
    <main>
        @yield('content')
    </main>

    <!-- === FOOTER === -->
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
