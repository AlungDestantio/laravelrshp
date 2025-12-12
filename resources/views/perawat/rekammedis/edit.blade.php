@extends('layouts.perawat')

@section('title','Edit Rekam Medis')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')

<div class="page-header">
    <div class="container">
        <h1>Edit Rekam Medis</h1>
        <p>Perbarui data rekam medis pasien.</p>
    </div>
</div>

<div class="container">

    <div class="card mb-5">
        <div class="card-body">

            <form action="{{ route('perawat.rekam-medis.update', $rekamMedis->idrekam_medis) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Pasien --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Pasien</label>
                    <input type="text"
                           class="form-control"
                           value="{{ $rekamMedis->temuDokter->pet->nama }}"
                           readonly>
                </div>

                {{-- Dokter --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Dokter Pemeriksa</label>
                    <input type="text"
                           class="form-control"
                           value="{{ $rekamMedis->dokter->user->nama ?? '-' }}"
                           readonly>
                </div>

                {{-- Anamnesa --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Anamnesa</label>
                    <textarea name="anamnesa" class="form-control" rows="2">{{ $rekamMedis->anamnesa }}</textarea>
                </div>

                {{-- Temuan Klinis --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Temuan Klinis</label>
                    <textarea name="temuan_klinis" class="form-control" rows="2">{{ $rekamMedis->temuan_klinis }}</textarea>
                </div>

                {{-- Diagnosa --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Diagnosa</label>
                    <textarea name="diagnosa" class="form-control" rows="2">{{ $rekamMedis->diagnosa }}</textarea>
                </div>

                <div class="text-end">
                    <button class="btn btn-add px-4">
                        <i class="bi bi-check-circle me-1"></i> Simpan Perubahan
                    </button>

                    <a href="{{ route('perawat.rekam-medis.index') }}" class="btn btn-secondary px-4">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection
