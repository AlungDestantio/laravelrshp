@extends('layouts.perawat')

@section('title','Detail Rekam Medis')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')

{{-- =================== HEADER =================== --}}
<div class="page-header">
    <div class="container">
        <h1>Detail Rekam Medis</h1>
        <p>Informasi lengkap pemeriksaan untuk hewan:
            <strong>{{ $rekamMedis->temuDokter->pet->nama }}</strong>
        </p>
    </div>
</div>

<div class="container">

    {{-- =================== INFO REKAM MEDIS =================== --}}
    <div class="card mb-5">
        <div class="card-header fw-bold text-white"
             style="background: linear-gradient(135deg, var(--unair-dark), var(--unair-blue));">
            <i class="bi bi-file-medical me-2"></i> Informasi Rekam Medis
        </div>

        <div class="card-body p-4">
            <div class="mb-3">
                <label class="fw-semibold text-primary">Dokter Pemeriksa:</label>
                <p class="mb-0">{{ $rekamMedis->dokter->user->nama ?? '-' }}</p>
            </div>
            <div class="mb-3">
                <label class="fw-semibold text-primary">Anamnesa:</label>
                <p class="mb-2">{{ $rekamMedis->anamnesa ?: '-' }}</p>
            </div>

            <div class="mb-3">
                <label class="fw-semibold text-primary">Temuan Klinis:</label>
                <p class="mb-2">{{ $rekamMedis->temuan_klinis ?: '-' }}</p>
            </div>

            <div class="mb-3">
                <label class="fw-semibold text-primary">Diagnosa:</label>
                <p class="mb-0">{{ $rekamMedis->diagnosa ?: '-' }}</p>
            </div>
        </div>
    </div>


    {{-- =================== TABEL TINDAKAN =================== --}}
    <div class="card mb-5">
        <div class="card-header fw-bold text-white"
             style="background: linear-gradient(135deg, var(--unair-dark), var(--unair-blue));">
            <i class="bi bi-clipboard2-pulse me-2"></i> Daftar Tindakan / Terapi
        </div>

        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 60px;">No</th>
                            <th>Tindakan / Terapi</th>
                            <th>Detail</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($rekamMedis->detailTindakan as $dt)
                        <tr>
                            <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                            <td>{{ $dt->kodeTindakanTerapi->deskripsi_tindakan_terapi }}</td>
                            <td>{{ $dt->detail }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-3">
                                Belum ada tindakan dicatat pada rekam medis ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>


    {{-- BUTTON KEMBALI --}}
    <div class="text-center mb-5">
        <a href="{{ route('perawat.rekam-medis.index') }}" class="btn btn-secondary px-4">
            <i class="bi bi-arrow-left-circle me-2"></i>Kembali
        </a>
    </div>

</div>

@endsection
