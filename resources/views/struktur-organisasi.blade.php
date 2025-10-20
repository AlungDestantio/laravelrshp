@extends('layouts.app')

@section('title', 'Struktur Organisasi')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/struktur-organisasi.css') }}">
@endsection

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1 class="display-4 fw-bold">Struktur Organisasi</h1>
        <p class="lead">Tim profesional yang berdedikasi untuk kesehatan hewan</p>
    </div>
</div>

<!-- Organization Chart -->
<div class="container mb-5">
    <!-- Director Level -->
    <div class="org-chart">
        <div class="org-level">
            <div class="org-card director">
                <img src="https://ui-avatars.com/api/?name=Dr+Ahmad&size=100&background=0066CC&color=fff" alt="Director" class="org-photo">
                <div class="org-name">Dr. Ahmad Subekti, drh., M.Sc.</div>
                <div class="org-title">Direktur Rumah Sakit Hewan</div>
                <div class="org-degree">Spesialis Bedah Hewan</div>
            </div>
        </div>

        <div class="connector"></div>
        <div class="horizontal-connector"></div>

        <!-- Manager Level -->
        <div class="org-level">
            <div class="org-card manager">
                <img src="https://ui-avatars.com/api/?name=Dr+Sri&size=100&background=FFB81C&color=fff" alt="Manager" class="org-photo">
                <div class="org-name">Dr. Sri Wahyuni, drh., M.Vet.</div>
                <div class="org-title">Kepala Bagian Medis</div>
                <div class="org-degree">Spesialis Penyakit Dalam</div>
            </div>

            <div class="org-card manager">
                <img src="https://ui-avatars.com/api/?name=Dr+Budi&size=100&background=FFB81C&color=fff" alt="Manager" class="org-photo">
                <div class="org-name">Dr. Budi Santoso, drh., M.Si.</div>
                <div class="org-title">Kepala Bagian Penunjang</div>
                <div class="org-degree">Spesialis Laboratorium Klinik</div>
            </div>

            <div class="org-card manager">
                <img src="https://ui-avatars.com/api/?name=Siti+Aminah&size=100&background=FFB81C&color=fff" alt="Manager" class="org-photo">
                <div class="org-name">Siti Aminah, S.E., M.M.</div>
                <div class="org-title">Kepala Bagian Administrasi</div>
                <div class="org-degree">Manajemen Rumah Sakit</div>
            </div>
        </div>
    </div>
</div>

<!-- Departments Section -->
<div class="container team-section mb-5">
    <h2 class="text-center mb-5" style="color: #003366; font-weight: bold;">Departemen & Unit Layanan</h2>
    
    <div class="row g-4">
        <!-- Departemen Bedah -->
        <div class="col-md-4">
            <div class="team-card">
                <div class="team-icon">
                    <i class="bi bi-scissors"></i>
                </div>
                <h5 style="color: #003366; font-weight: bold;">Departemen Bedah</h5>
                <p class="text-muted mb-3">Pelayanan operasi dan tindakan bedah</p>
                <ul class="list-unstyled text-start text-muted">
                    <li><i class="bi bi-check-circle-fill text-primary"></i> Bedah Umum</li>
                    <li><i class="bi bi-check-circle-fill text-primary"></i> Bedah Ortopedi</li>
                    <li><i class="bi bi-check-circle-fill text-primary"></i> Bedah Jaringan Lunak</li>
                    <li><i class="bi bi-check-circle-fill text-primary"></i> Sterilisasi</li>
                </ul>
            </div>
        </div>

        <!-- Departemen Penyakit Dalam -->
        <div class="col-md-4">
            <div class="team-card">
                <div class="team-icon">
                    <i class="bi bi-heart-pulse"></i>
                </div>
                <h5 style="color: #003366; font-weight: bold;">Departemen Penyakit Dalam</h5>
                <p class="text-muted mb-3">Diagnosis dan terapi penyakit internal</p>
                <ul class="list-unstyled text-start text-muted">
                    <li><i class="bi bi-check-circle-fill text-primary"></i> Kardiologi</li>
                    <li><i class="bi bi-check-circle-fill text-primary"></i> Gastroenterologi</li>
                    <li><i class="bi bi-check-circle-fill text-primary"></i> Nefrologi</li>
                    <li><i class="bi bi-check-circle-fill text-primary"></i> Endokrinologi</li>
                </ul>
            </div>
        </div>

        <!-- Unit Laboratorium -->
        <div class="col-md-4">
            <div class="team-card">
                <div class="team-icon">
                    <i class="bi bi-clipboard2-data"></i>
                </div>
                <h5 style="color: #003366; font-weight: bold;">Unit Laboratorium</h5>
                <p class="text-muted mb-3">Pemeriksaan diagnostik laboratorium</p>
                <ul class="list-unstyled text-start text-muted">
                    <li><i class="bi bi-check-circle-fill text-primary"></i> Patologi Klinik</li>
                    <li><i class="bi bi-check-circle-fill text-primary"></i> Mikrobiologi</li>
                    <li><i class="bi bi-check-circle-fill text-primary"></i> Serologi</li>
                    <li><i class="bi bi-check-circle-fill text-primary"></i> Parasitologi</li>
                </ul>
            </div>
        </div>

        <!-- Unit Radiologi -->
        <div class="col-md-4">
            <div class="team-card">
                <div class="team-icon">
                    <i class="bi bi-x-diamond"></i>
                </div>
                <h5 style="color: #003366; font-weight: bold;">Unit Radiologi</h5>
                <p class="text-muted mb-3">Pencitraan diagnostik medis</p>
                <ul class="list-unstyled text-start text-muted">
                    <li><i class="bi bi-check-circle-fill text-primary"></i> Rontgen Digital</li>
                    <li><i class="bi bi-check-circle-fill text-primary"></i> Ultrasonografi</li>
                    <li><i class="bi bi-check-circle-fill text-primary"></i> Radiologi Kontras</li>
                </ul>
            </div>
        </div>

        <!-- Unit IGD -->
        <div class="col-md-4">
            <div class="team-card">
                <div class="team-icon">
                    <i class="bi bi-alarm"></i>
                </div>
                <h5 style="color: #003366; font-weight: bold;">Unit IGD</h5>
                <p class="text-muted mb-3">Instalasi Gawat Darurat 24 Jam</p>
                <ul class="list-unstyled text-start text-muted">
                    <li><i class="bi bi-check-circle-fill text-primary"></i> Trauma</li>
                    <li><i class="bi bi-check-circle-fill text-primary"></i> Keracunan</li>
                    <li><i class="bi bi-check-circle-fill text-primary"></i> Kritis</li>
                    <li><i class="bi bi-check-circle-fill text-primary"></i> Intensive Care</li>
                </ul>
            </div>
        </div>

        <!-- Unit Farmasi -->
        <div class="col-md-4">
            <div class="team-card">
                <div class="team-icon">
                    <i class="bi bi-capsule-pill"></i>
                </div>
                <h5 style="color: #003366; font-weight: bold;">Unit Farmasi</h5>
                <p class="text-muted mb-3">Pelayanan obat dan konsultasi</p>
                <ul class="list-unstyled text-start text-muted">
                    <li><i class="bi bi-check-circle-fill text-primary"></i> Dispensing</li>
                    <li><i class="bi bi-check-circle-fill text-primary"></i> Konseling Obat</li>
                    <li><i class="bi bi-check-circle-fill text-primary"></i> Informasi Obat</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Medical Team -->
<div class="container mb-5">
    <h2 class="text-center mb-5" style="color: #003366; font-weight: bold;">Tim Dokter Hewan</h2>
    
    <div class="row g-4">
        <div class="col-md-3 col-sm-6">
            <div class="team-card">
                <img src="https://ui-avatars.com/api/?name=Dr+Rina&size=80&background=0066CC&color=fff" alt="Doctor" class="team-icon" style="border-radius: 50%;">
                <h6 style="color: #003366; font-weight: bold;">Dr. Rina Kusuma, drh.</h6>
                <p class="text-muted small mb-0">Dokter Hewan Umum</p>
            </div>
        </div>
        
        <div class="col-md-3 col-sm-6">
            <div class="team-card">
                <img src="https://ui-avatars.com/api/?name=Dr+Hendra&size=80&background=0066CC&color=fff" alt="Doctor" class="team-icon" style="border-radius: 50%;">
                <h6 style="color: #003366; font-weight: bold;">Dr. Hendra Wijaya, drh.</h6>
                <p class="text-muted small mb-0">Spesialis Bedah</p>
            </div>
        </div>
        
        <div class="col-md-3 col-sm-6">
            <div class="team-card">
                <img src="https://ui-avatars.com/api/?name=Dr+Dewi&size=80&background=0066CC&color=fff" alt="Doctor" class="team-icon" style="border-radius: 50%;">
                <h6 style="color: #003366; font-weight: bold;">Dr. Dewi Lestari, drh., M.Vet.</h6>
                <p class="text-muted small mb-0">Spesialis Radiologi</p>
            </div>
        </div>
        
        <div class="col-md-3 col-sm-6">
            <div class="team-card">
                <img src="https://ui-avatars.com/api/?name=Dr+Agus&size=80&background=0066CC&color=fff" alt="Doctor" class="team-icon" style="border-radius: 50%;">
                <h6 style="color: #003366; font-weight: bold;">Dr. Agus Pramono, drh.</h6>
                <p class="text-muted small mb-0">Dokter Hewan IGD</p>
            </div>
        </div>
    </div>
</div>
@endsection