@extends('layouts.pemilik')

@section('title','Rekam Medis Hewan Saya')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')

{{-- =================== HEADER =================== --}}
<div class="page-header">
    <div class="container">
        <h1>Rekam Medis Hewan Saya</h1>
        <p>Riwayat pemeriksaan hewan peliharaan Anda oleh dokter.</p>
    </div>
</div>

<div class="container">

    {{-- =================== CARD TABEL =================== --}}
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
                            <th>Nama Hewan</th>
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
                                <a href="{{ route('pemilik.rekam-medis.show', $rm->idrekam_medis) }}"
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
