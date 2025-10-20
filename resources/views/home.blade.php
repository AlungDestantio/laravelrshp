@extends('layouts.app')

@section('title', 'Home')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <h1 class="hero-title">Selamat Datang di Rumah Sakit Hewan Pendidikan Universitas Airlangga</h1>
        <p class="hero-subtitle">Pelayanan Kesehatan Hewan Terbaik dengan Standar Profesional</p>
        <a href="{{ route('layanan') }}" class="btn btn-warning btn-lg px-5">
            <i class="bi bi-clipboard2-pulse"></i> Lihat Layanan Kami
        </a>
    </div>
</section>

<!-- Features Section -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5" style="color: #003366; font-weight: bold;">Mengapa Memilih Kami?</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card feature-card text-center p-4">
                    <div class="card-body">
                        <i class="bi bi-people-fill feature-icon"></i>
                        <h4 style="color: #003366;">Tenaga Profesional</h4>
                        <p class="text-muted">Dokter hewan berpengalaman dan terlatih dari Fakultas Kedokteran Hewan UNAIR</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card feature-card text-center p-4">
                    <div class="card-body">
                        <i class="bi bi-hospital feature-icon"></i>
                        <h4 style="color: #003366;">Fasilitas Modern</h4>
                        <p class="text-muted">Dilengkapi dengan peralatan medis dan laboratorium berstandar internasional</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card feature-card text-center p-4">
                    <div class="card-body">
                        <i class="bi bi-clock-fill feature-icon"></i>
                        <h4 style="color: #003366;">Layanan 24 Jam</h4>
                        <p class="text-muted">Siap melayani kebutuhan kesehatan hewan peliharaan Anda kapan saja</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-6">
                <div class="stat-item">
                    <div class="stat-number">15+</div>
                    <div class="stat-label">Tahun Pengalaman</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-item">
                    <div class="stat-number">5000+</div>
                    <div class="stat-label">Hewan Ditangani</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-item">
                    <div class="stat-number">25+</div>
                    <div class="stat-label">Dokter Hewan</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-item">
                    <div class="stat-number">98%</div>
                    <div class="stat-label">Kepuasan Klien</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4">
                <img src="https://images.unsplash.com/photo-1530041539828-114de669390e?w=800" 
                     alt="Veterinary Care" 
                     class="img-fluid rounded shadow">
            </div>
            <div class="col-md-6">
                <h2 style="color: #003366; font-weight: bold;">Tentang Kami</h2>
                <p class="lead" style="color: #0066CC;">Rumah Sakit Hewan Pendidikan Universitas Airlangga</p>
                <p class="text-muted">
                    Rumah Sakit Hewan Pendidikan UNAIR merupakan fasilitas kesehatan hewan yang terintegrasi dengan 
                    pendidikan dan penelitian di Fakultas Kedokteran Hewan Universitas Airlangga. Kami berkomitmen 
                    memberikan pelayanan kesehatan hewan terbaik dengan didukung oleh tenaga medis profesional, 
                    mahasiswa veteriner yang terlatih, serta fasilitas dan teknologi modern.
                </p>
                <p class="text-muted">
                    Sebagai rumah sakit pendidikan, kami juga berperan dalam mengembangkan ilmu kedokteran hewan 
                    melalui praktik langsung, penelitian, dan pengabdian kepada masyarakat.
                </p>
                <a href="{{ route('kontak') }}" class="btn btn-primary mt-3">
                    <i class="bi bi-telephone-fill"></i> Hubungi Kami
                </a>
            </div>
        </div>
    </div>
</section>
@endsection