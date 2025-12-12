@extends('layouts.dokter')

@section('title','Rekam Medis Dokter')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')

{{-- =================== HEADER =================== --}}
<div class="page-header">
    <div class="container">
        <h1>Rekam Medis</h1>
        <p>Data pemeriksaan pasien berdasarkan hasil evaluasi dokter.</p>
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

    {{-- =================== TABEL =================== --}}
    <div class="card mb-5">
        <div class="card-header text-white fw-bold border-0"
             style="background: linear-gradient(135deg, var(--unair-dark), var(--unair-blue));">
            <i class="bi bi-folder2-open me-1"></i> Daftar Rekam Medis
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Pasien</th>
                            <th>Dokter Pemeriksa</th>
                            <th>Anamnesa</th>
                            <th>Temuan Klinis</th>
                            <th>Diagnosa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($rekamMedis as $rm)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $rm->temuDokter->pet->nama ?? '-' }}</td>
                            <td>{{ $rm->dokter->user->nama ?? '-' }}</td>
                            <td>{{ $rm->anamnesa }}</td>
                            <td>{{ $rm->temuan_klinis }}</td>
                            <td>{{ $rm->diagnosa }}</td>
                            <td class="text-center">
                                <a href="{{ route('dokter.rekam-medis.show', $rm->idrekam_medis) }}"
                                   class="action-btn btn-edit">
                                    <i class="bi bi-eye-fill me-1"></i> Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-3">
                                Belum ada data rekam medis.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

@endsection
