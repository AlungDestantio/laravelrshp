@extends('layouts.app')

@section('title', 'Layanan')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/layanan.css') }}">
@endsection

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1 class="display-4 fw-bold">Layanan Kami</h1>
        <p class="lead">Pelayanan kesehatan hewan yang komprehensif dan profesional</p>
    </div>
</div>

<!-- Services Section -->
<div class="container mb-5">
    <div class="row g-4">
        <!-- Layanan Rawat Jalan -->
        <div class="col-md-6 col-lg-4">
            <div class="service-card">
                <div class="service-icon">
                    <i class="bi bi-heart-pulse-fill"></i>
                </div>
                <div class="service-body">
                    <h4 class="service-title">Rawat Jalan</h4>
                    <ul class="service-list">
                        <li>Konsultasi Kesehatan Hewan</li>
                        <li>Pemeriksaan Umum</li>
                        <li>Vaksinasi</li>
                        <li>Pemeriksaan Rutin</li>
                        <li>Resep Obat</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Layanan Rawat Inap -->
        <div class="col-md-6 col-lg-4">
            <div class="service-card">
                <div class="service-icon">
                    <i class="bi bi-hospital-fill"></i>
                </div>
                <div class="service-body">
                    <h4 class="service-title">Rawat Inap</h4>
                    <ul class="service-list">
                        <li>Perawatan Intensif 24 Jam</li>
                        <li>Monitoring Kesehatan</li>
                        <li>Nutrisi Khusus</li>
                        <li>Perawatan Pasca Operasi</li>
                        <li>Kandang Isolasi</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Layanan Bedah -->
        <div class="col-md-6 col-lg-4">
            <div class="service-card">
                <div class="service-icon">
                    <i class="bi bi-bandaid-fill"></i>
                </div>
                <div class="service-body">
                    <h4 class="service-title">Bedah & Operasi</h4>
                    <ul class="service-list">
                        <li>Operasi Bedah Mayor</li>
                        <li>Operasi Bedah Minor</li>
                        <li>Sterilisasi/Kastrasi</li>
                        <li>Operasi Darurat</li>
                        <li>Anestesi Aman</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Layanan Laboratorium -->
        <div class="col-md-6 col-lg-4">
            <div class="service-card">
                <div class="service-icon">
                    <i class="bi bi-clipboard2-data-fill"></i>
                </div>
                <div class="service-body">
                    <h4 class="service-title">Laboratorium</h4>
                    <ul class="service-list">
                        <li>Pemeriksaan Darah Lengkap</li>
                        <li>Urinalisis</li>
                        <li>Feses</li>
                        <li>Mikrobiologi</li>
                        <li>Serologi</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Layanan Radiologi -->
        <div class="col-md-6 col-lg-4">
            <div class="service-card">
                <div class="service-icon">
                    <i class="bi bi-x-diamond-fill"></i>
                </div>
                <div class="service-body">
                    <h4 class="service-title">Radiologi</h4>
                    <ul class="service-list">
                        <li>Rontgen Digital</li>
                        <li>USG (Ultrasonografi)</li>
                        <li>Radiologi Thorax</li>
                        <li>Radiologi Abdomen</li>
                        <li>Radiologi Ekstremitas</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Layanan Grooming -->
        <div class="col-md-6 col-lg-4">
            <div class="service-card">
                <div class="service-icon">
                    <i class="bi bi-scissors"></i>
                </div>
                <div class="service-body">
                    <h4 class="service-title">Grooming & Perawatan</h4>
                    <ul class="service-list">
                        <li>Mandi & Sisir</li>
                        <li>Potong Kuku</li>
                        <li>Pembersihan Telinga</li>
                        <li>Perawatan Kulit & Bulu</li>
                        <li>Trimming</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Layanan Emergency -->
        <div class="col-md-6 col-lg-4">
            <div class="service-card">
                <div class="service-icon">
                    <i class="bi bi-alarm-fill"></i>
                </div>
                <div class="service-body">
                    <h4 class="service-title">Layanan Darurat</h4>
                    <ul class="service-list">
                        <li>IGD 24 Jam</li>
                        <li>Penanganan Kecelakaan</li>
                        <li>Penanganan Keracunan</li>
                        <li>Pertolongan Pertama</li>
                        <li>Ambulans Hewan</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Layanan Farmasi -->
        <div class="col-md-6 col-lg-4">
            <div class="service-card">
                <div class="service-icon">
                    <i class="bi bi-capsule-pill"></i>
                </div>
                <div class="service-body">
                    <h4 class="service-title">Farmasi</h4>
                    <ul class="service-list">
                        <li>Obat-obatan Veteriner</li>
                        <li>Suplemen Hewan</li>
                        <li>Makanan Khusus</li>
                        <li>Peralatan Medis</li>
                        <li>Konsultasi Penggunaan Obat</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Layanan Konsultasi -->
        <div class="col-md-6 col-lg-4">
            <div class="service-card">
                <div class="service-icon">
                    <i class="bi bi-chat-square-text-fill"></i>
                </div>
                <div class="service-body">
                    <h4 class="service-title">Konsultasi</h4>
                    <ul class="service-list">
                        <li>Konsultasi Nutrisi</li>
                        <li>Konsultasi Reproduksi</li>
                        <li>Konsultasi Perilaku</li>
                        <li>Konsultasi Pencegahan Penyakit</li>
                        <li>Program Kesehatan</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="container mb-5">
    <div class="card" style="background: linear-gradient(135deg, #0066CC, #003366); border: none; border-radius: 15px;">
        <div class="card-body text-center text-white p-5">
            <h2 class="mb-3">Butuh Bantuan Segera?</h2>
            <p class="lead mb-4">Tim medis kami siap melayani kebutuhan kesehatan hewan Anda 24/7</p>
            <a href="{{ route('kontak') }}" class="btn btn-warning btn-lg px-5">
                <i class="bi bi-telephone-fill"></i> Hubungi Kami Sekarang
            </a>
        </div>
    </div>
</div>
@endsection