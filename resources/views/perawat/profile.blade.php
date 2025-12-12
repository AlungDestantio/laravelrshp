@extends('layouts.perawat')

@section('title', 'Profil Perawat')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')

{{-- =================== HEADER =================== --}}
<div class="page-header">
    <div class="container">
        <h1>Profil Perawat</h1>
        <p>Informasi lengkap data diri Anda sebagai perawat.</p>
    </div>
</div>

<div class="container" style="max-width: 900px;">

    {{-- =================== CARD PROFIL =================== --}}
    <div class="card mb-5">

        <div class="card-header fw-bold text-white"
             style="background: linear-gradient(135deg, var(--unair-dark), var(--unair-blue));">
            <i class="bi bi-person-badge-fill me-2"></i> Data Profil
        </div>

        <div class="card-body p-4">

            <div class="row g-4">

                {{-- KOLOM KIRI --}}
                <div class="col-md-6">

                    <div class="mb-3">
                        <label class="fw-semibold text-primary">Nama</label>
                        <div class="p-3 bg-light rounded shadow-sm">
                            {{ $user->nama }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="fw-semibold text-primary">Email</label>
                        <div class="p-3 bg-light rounded shadow-sm">
                            {{ $user->email }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="fw-semibold text-primary">Jenis Kelamin</label>
                        <div class="p-3 bg-light rounded shadow-sm">
                            {{ $perawat->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                        </div>
                    </div>

                </div>

                {{-- KOLOM KANAN --}}
                <div class="col-md-6">

                    <div class="mb-3">
                        <label class="fw-semibold text-primary">No HP</label>
                        <div class="p-3 bg-light rounded shadow-sm">
                            {{ $perawat->no_hp }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="fw-semibold text-primary">Alamat</label>
                        <div class="p-3 bg-light rounded shadow-sm">
                            {{ $perawat->alamat }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="fw-semibold text-primary">Pendidikan</label>
                        <div class="p-3 bg-light rounded shadow-sm">
                            {{ $perawat->pendidikan }}
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>

</div>

@endsection
