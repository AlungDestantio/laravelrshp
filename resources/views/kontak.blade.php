@extends('layouts.app')

@section('title', 'Kontak')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/kontak.css') }}">
@endsection

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1 class="display-4 fw-bold">Hubungi Kami</h1>
        <p class="lead">Kami siap membantu kebutuhan kesehatan hewan peliharaan Anda</p>
    </div>
</div>

<!-- Contact Info Section -->
<div class="container mb-5">
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="contact-card text-center">
                <div class="contact-icon">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>
                <h4 class="contact-title">Alamat</h4>
                <p class="text-muted">
                    Kampus C Universitas Airlangga<br>
                    Jl. Mulyorejo<br>
                    Surabaya, Jawa Timur 60115
                </p>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="contact-card text-center">
                <div class="contact-icon">
                    <i class="bi bi-telephone-fill"></i>
                </div>
                <h4 class="contact-title">Telepon</h4>
                <p class="text-muted">
                    <strong>Phone:</strong> (031) 5992785<br>
                    <strong>Mobile:</strong> +62 812-3456-7890<br>
                    <strong>Emergency:</strong> +62 821-9876-5432
                </p>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="contact-card text-center">
                <div class="contact-icon">
                    <i class="bi bi-envelope-fill"></i>
                </div>
                <h4 class="contact-title">Email & Sosial Media</h4>
                <p class="text-muted">
                    <strong>Email:</strong> rshp@unair.ac.id<br>
                    <strong>Instagram:</strong> @rshp.unair<br>
                    <strong>Facebook:</strong> RSH Pendidikan UNAIR
                </p>
            </div>
        </div>
    </div>

    <!-- Operating Hours -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="contact-card">
                <div class="text-center mb-4">
                    <div class="contact-icon">
                        <i class="bi bi-clock-fill"></i>
                    </div>
                    <h4 class="contact-title">Jam Operasional</h4>
                </div>
                <div class="row text-center">
                    <div class="col-md-6">
                        <h5 style="color: #0066CC;">Layanan Rawat Jalan</h5>
                        <p class="text-muted">
                            <strong>Senin - Jumat:</strong> 08.00 - 17.00 WIB<br>
                            <strong>Sabtu:</strong> 08.00 - 13.00 WIB<br>
                            <strong>Minggu & Libur:</strong> Tutup
                        </p>
                    </div>
                    <div class="col-md-6">
                        <h5 style="color: #0066CC;">Layanan IGD & Rawat Inap</h5>
                        <p class="text-muted">
                            <strong>24 Jam / 7 Hari</strong><br>
                            Tersedia setiap saat untuk<br>
                            keadaan darurat
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Form & Map -->
    <div class="row g-4">
        <div class="col-lg-6">
            <div class="contact-card">
                <h3 class="contact-title text-center mb-4">Kirim Pesan</h3>
                <form>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" placeholder="Masukkan nama Anda" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="nama@email.com" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Nomor Telepon</label>
                        <input type="tel" class="form-control" id="phone" placeholder="08xx-xxxx-xxxx" required>
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subjek</label>
                        <input type="text" class="form-control" id="subject" placeholder="Subjek pesan" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Pesan</label>
                        <textarea class="form-control" id="message" rows="5" placeholder="Tulis pesan Anda..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100" style="background: linear-gradient(135deg, #0066CC, #003366); border: none;">
                        <i class="bi bi-send-fill"></i> Kirim Pesan
                    </button>
                </form>
            </div>
        </div>
        
        <div class="col-lg-6">
            <div class="map-container">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.3779545906837!2d112.78145731477494!3d-7.309108794699938!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fa10ea2ae883%3A0xbe22c55d60ef09c7!2sFakultas%20Kedokteran%20Hewan%20Universitas%20Airlangga!5e0!3m2!1sid!2sid!4v1639234567890!5m2!1sid!2sid" 
                    width="100%" 
                    height="100%" 
                    style="border:0; min-height: 550px;" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
            </div>
        </div>
    </div>
</div>

<!-- Emergency Banner -->
<div class="container mb-5">
    <div class="card" style="background: linear-gradient(135deg, #dc3545, #c82333); border: none; border-radius: 15px;">
        <div class="card-body text-center text-white p-4">
            <h3 class="mb-3"><i class="bi bi-exclamation-triangle-fill"></i> Kondisi Darurat?</h3>
            <p class="lead mb-3">Hubungi layanan IGD kami segera!</p>
            <a href="tel:+6282198765432" class="btn btn-light btn-lg px-5">
                <i class="bi bi-telephone-fill"></i> +62 821-9876-5432
            </a>
        </div>
    </div>
</div>
@endsection