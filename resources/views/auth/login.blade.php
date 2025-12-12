@extends('layouts.app')

@section('title', 'Login')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<section class="login-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="login-card">
                    <div class="row g-0">

                        <!-- Left Side -->
                        <div class="col-md-5 d-none d-md-block">
                            <div class="login-left">
                                <div class="login-icon">
                                    <i class="bi bi-heart-pulse-fill"></i>
                                </div>
                                <h2 class="mb-3">Selamat Datang!</h2>
                                <p class="mb-4">Masuk ke sistem Rumah Sakit Hewan Pendidikan UNAIR untuk mengakses layanan kami</p>
                                <div class="mt-4">
                                    <i class="bi bi-shield-check" style="font-size: 2rem; opacity: 0.7;"></i>
                                    <p class="mt-2 small" style="opacity: 0.8;">Login aman dan terenkripsi</p>
                                </div>
                            </div>
                        </div>

                        <!-- Right Side - Login Form -->
                        <div class="col-md-7">
                            <div class="login-right">

                                <div class="text-center mb-4">
                                    <h3 style="color: #003366; font-weight: bold;">Login</h3>
                                    <p class="text-muted">Masuk ke akun Anda</p>
                                </div>

                                @if ($errors->any())
                                    <div class="alert alert-danger text-center">
                                        <ul class="mb-0" style="list-style: none; padding-left: 0;">
                                            @foreach ($errors->all() as $err)
                                                <li>{{ $err }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <!-- Email Input -->
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email atau Username</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-person-fill"></i>
                                            </span>
                                            <input type="text"
                                                class="form-control"
                                                id="email"
                                                name="email"
                                                placeholder="Masukkan email atau username"
                                                autocomplete="username"
                                                required>
                                        </div>
                                    </div>

                                    <!-- Password Input -->
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-lock-fill"></i>
                                            </span>
                                            <input type="password"
                                                class="form-control"
                                                id="password"
                                                name="password"
                                                placeholder="Masukkan password"
                                                autocomplete="current-password"
                                                required>
                                        </div>
                                    </div>

                                    <!-- Tombol Login -->
                                    <button type="submit" class="btn btn-primary btn-login w-100">
                                        <i class="bi bi-box-arrow-in-right"></i> Login
                                    </button>
                                </form>

                                <!-- Divider -->
                                <div class="divider">
                                    <span>atau login dengan</span>
                                </div>

                                <!-- Social Login -->
                                <div class="social-login">
                                    <button type="button" class="btn btn-social">
                                        <i class="bi bi-google" style="color: #DB4437;"></i>
                                    </button>
                                    <button type="button" class="btn btn-social">
                                        <i class="bi bi-facebook" style="color: #4267B2;"></i>
                                    </button>
                                    <button type="button" class="btn btn-social">
                                        <i class="bi bi-microsoft" style="color: #00A4EF;"></i>
                                    </button>
                                </div>

                                <!-- Register Link -->
                                <div class="text-center mt-4">
                                    <p class="text-muted mb-0">
                                        Belum punya akun?
                                        <a href="#" style="color: #0066CC; font-weight: 600; text-decoration: none;">
                                            Daftar Sekarang
                                        </a>
                                    </p>
                                </div>

                                <!-- Info Box -->
                                <div class="alert alert-info mt-4"
                                    style="border-radius: 10px; border: none; background: #e3f2fd;">
                                    <i class="bi bi-info-circle-fill"></i>
                                    <small>
                                        <strong>Untuk staf & mahasiswa:</strong> Gunakan akun UNAIR SSO Anda untuk login.
                                    </small>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <!-- Help Section -->
                <div class="text-center mt-4">
                    <p class="text-muted">
                        <i class="bi bi-question-circle"></i> Butuh bantuan?
                        <a href="{{ route('kontak') }}" style="color: #0066CC; text-decoration: none;">Hubungi Support</a>
                    </p>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    // Toggle password visibility
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Login page loaded');
    });
</script>
@endsection
