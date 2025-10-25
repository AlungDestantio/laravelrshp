@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('styles')
<style>
    .dashboard-hero {
        background: linear-gradient(135deg, #0066CC 0%, #003366 100%);
        color: white;
        padding: 60px 0;
        margin: -20px -20px 40px -20px;
        border-radius: 0 0 30px 30px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.15);
        position: relative;
        overflow: hidden;
    }
    
    .dashboard-hero h1 {
        font-weight: bold;
        font-size: 2.5rem;
        margin-bottom: 10px;
        position: relative;
        z-index: 1;
    }
    
    .dashboard-hero p {
        font-size: 1.2rem;
        color: rgba(255,255,255,0.95);
        position: relative;
        z-index: 1;
    }
    
    .dashboard-hero i.hero-icon {
        color: #FFB81C;
        font-size: 3.5rem;
        margin-bottom: 15px;
        filter: drop-shadow(0 4px 8px rgba(0,0,0,0.2));
    }
    
    .menu-section-title {
        color: #003366;
        font-weight: bold;
        font-size: 1.8rem;
        margin-bottom: 30px;
        text-align: center;
        position: relative;
        padding-bottom: 15px;
    }
    
    
    .admin-menu-card {
        border: none;
        border-radius: 20px;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        background: white;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        overflow: hidden;
        position: relative;
    }
    
    .admin-menu-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, #0066CC);
        transform: scaleX(0);
        transition: transform 0.4s ease;
    }
    
    .admin-menu-card:hover::before {
        transform: scaleX(1);
    }
    
    .admin-menu-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0,102,204,0.2);
    }
    
    .admin-menu-card .card-body {
        padding: 35px 25px;
    }
    
    .icon-wrapper {
        width: 80px;
        height: 80px;
        margin: 0 auto 20px;
        background: linear-gradient(135deg, #0066CC 0%, #003366 100%);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 20px rgba(0,102,204,0.25);
        transition: all 0.3s ease;
    }
    
    .admin-menu-card:hover .icon-wrapper {
        transform: scale(1.1) rotate(5deg);
        box-shadow: 0 12px 30px rgba(0,102,204,0.35);
    }
    
    .icon-wrapper i {
        font-size: 2.5rem;
        color: #FFB81C;
    }
    
    .admin-menu-card h5 {
        color: #003366;
        font-weight: 700;
        margin-bottom: 12px;
        font-size: 1.15rem;
        min-height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .admin-menu-card p {
        color: #6c757d;
        font-size: 0.9rem;
        margin-bottom: 25px;
        min-height: 40px;
    }
    
    .admin-menu-card .btn {
        background: linear-gradient(135deg, #0066CC 0%, #003366 100%);
        border: none;
        padding: 12px 30px;
        font-weight: 600;
        border-radius: 10px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0,102,204,0.2);
        width: 100%;
    }
    
    .admin-menu-card .btn:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 20px rgba(0,102,204,0.4);
    }
    
    .admin-menu-card .btn i {
        margin-left: 8px;
        transition: transform 0.3s ease;
    }
    
    .admin-menu-card:hover .btn i {
        transform: translateX(5px);
    }
    
    @media (max-width: 768px) {
        .dashboard-hero h1 {
            font-size: 1.8rem;
        }
        
        .dashboard-hero p {
            font-size: 1rem;
        }
        
        .admin-menu-card h5 {
            min-height: auto;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid px-4">
    <!-- Dashboard Hero -->
    <div class="dashboard-hero">
        <div class="container text-center">
            <h1>Dashboard Admin</h1>
            <p>Selamat datang, <strong>{{ Auth::user()->nama }}</strong></p>
            <p class="mb-0" style="font-size: 1rem; opacity: 0.9;">Kelola seluruh data sistem rumah sakit hewan dengan mudah dan efisien</p>
        </div>
    </div>

    <!-- Menu Section -->
    <div class="container">
        <h2 class="menu-section-title">Menu Administrasi</h2>
        
        <div class="row g-4 mb-5">
            @php
                $menus = [
                    ['icon'=>'bi-heart-fill','title'=>'Jenis Hewan','route'=>'admin.jenis-hewan.index', 'desc'=>'Kelola data jenis hewan seperti anjing, kucing, burung, dll'],
                    ['icon'=>'bi-diagram-3-fill','title'=>'Ras Hewan','route'=>'admin.ras-hewan.index', 'desc'=>'Kelola data ras untuk setiap jenis hewan'],
                    ['icon'=>'bi-tags-fill','title'=>'Kategori','route'=>'admin.kategori.index', 'desc'=>'Kelola kategori dan klasifikasi sistem'],
                    ['icon'=>'bi-file-medical-fill','title'=>'Kategori Klinis','route'=>'admin.kategori-klinis.index', 'desc'=>'Kelola kategori untuk keperluan klinis'],
                    ['icon'=>'bi-clipboard2-pulse-fill','title'=>'Kode Tindakan','route'=>'admin.kode-tindakan.index', 'desc'=>'Kelola kode tindakan terapi dan prosedur medis'],
                    ['icon'=>'bi-heart-pulse-fill','title'=>'Data Pet','route'=>'admin.pet.index', 'desc'=>'Kelola data hewan peliharaan pasien'],
                    ['icon'=>'bi-people-fill','title'=>'Role & Hak Akses','route'=>'admin.role.index', 'desc'=>'Kelola role dan permission pengguna'],
                    ['icon'=>'bi-people-fill','title'=>'User & Pengguna','route'=>'admin.user.index', 'desc'=>'Kelola akun pengguna dan assignment role'],
                ];
            @endphp

            @foreach($menus as $m)
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="card admin-menu-card">
                    <div class="card-body text-center">
                        <div class="icon-wrapper">
                            <i class="{{ $m['icon'] }}"></i>
                        </div>
                        <h5>{{ $m['title'] }}</h5>
                        <p>{{ $m['desc'] }}</p>
                        <a href="{{ route($m['route']) }}" class="btn btn-primary">
                            Kelola Data <i class="bi bi-arrow-right-circle"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection