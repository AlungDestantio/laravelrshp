@extends('layouts.dokter')

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

<div class="alert-container">
    @if(session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
        </div>
    @endif
</div>

<div class="container">

    {{-- =================== INFORMASI REKAM MEDIS =================== --}}
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


    {{-- =================== FORM TAMBAH TINDAKAN =================== --}}
    <div class="card mb-5">
        <div class="card-header fw-bold text-white"
             style="background: linear-gradient(135deg, var(--unair-dark), var(--unair-blue));">
            <i class="bi bi-plus-circle me-2"></i> Tambah Tindakan / Terapi
        </div>

        <div class="card-body p-4">
            <form action="{{ route('dokter.tindakan.store', $rekamMedis->idrekam_medis) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Tindakan / Terapi</label>
                    <select name="idkode_tindakan_terapi" class="form-select" required>
                        @foreach(\App\Models\KodeTindakanTerapi::all() as $kt)
                            <option value="{{ $kt->idkode_tindakan_terapi }}">
                                {{ $kt->deskripsi_tindakan_terapi }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Detail</label>
                    <textarea name="detail" class="form-control" rows="2"></textarea>
                </div>

                <button class="btn btn-add px-4">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Tindakan
                </button>
            </form>
        </div>
    </div>


    {{-- =================== TABEL TINDAKAN =================== --}}
    <div class="card mb-5">
        <div class="card-header text-white fw-bold border-0"
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
                            <th style="width: 140px;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($rekamMedis->detailTindakan as $dt)
                        <tr>
                            <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                            <td>{{ $dt->kodeTindakanTerapi->deskripsi_tindakan_terapi }}</td>
                            <td>{{ $dt->detail }}</td>

                            <td class="text-center">
                                <div class="d-flex gap-2 justify-content-center">
                                    <a href="{{ route('dokter.tindakan.edit', $dt->iddetail_rekam_medis) }}"
                                       class="action-btn btn-edit">
                                        <i class="bi bi-pencil-square me-1"></i> Edit
                                    </a>

                                    <form action="{{ route('dokter.tindakan.destroy', $dt->iddetail_rekam_medis) }}"
                                        method="POST" onsubmit="return confirm('Hapus tindakan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="action-btn btn-delete">
                                            <i class="bi bi-trash me-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-3">
                                Belum ada tindakan dicatat.
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
        <a href="{{ route('dokter.rekam-medis.index') }}" class="btn btn-secondary px-4">
            <i class="bi bi-arrow-left-circle me-2"></i> Kembali
        </a>
    </div>

</div>

@endsection
