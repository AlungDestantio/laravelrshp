@extends('layouts.admin')

@section('title','Rekam Medis Admin')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')

{{-- =================== HEADER =================== --}}
<div class="page-header">
    <div class="container">
        <h1>Rekam Medis</h1>
        <p>Kelola seluruh rekam medis pasien.</p>
    </div>
</div>

<div class="alert-container">
    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
</div>

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3" style="max-width:1100px;margin:auto;">
        <a href="{{ route('admin.rekam-medis.create') }}" class="btn btn-add">
            <i class="bi bi-plus-circle"></i> Tambah Rekam Medis
        </a>
    </div>


    {{-- =================== TABEL REKAM MEDIS =================== --}}
    <div class="card mb-5">

        <div class="card-body">

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>NO</th>
                            <th>Pasien</th>
                            <th>Dokter</th>
                            <th>Anamnesa</th>
                            <th>Temuan Klinis</th>
                            <th>Diagnosa</th>
                            <th style="width:130px;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($rekamMedis as $rm)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $rm->temuDokter->pet->nama }}</td>
                            <td>{{ $rm->dokter->user->nama ?? '-' }}</td>
                            <td>{{ $rm->anamnesa }}</td>
                            <td>{{ $rm->temuan_klinis }}</td>
                            <td>{{ $rm->diagnosa }}</td>

                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.rekam-medis.show', $rm->idrekam_medis) }}"
                                        class="action-btn btn-add">
                                        <i class="bi bi-eye-fill"></i> Detail
                                    </a>

                                    <a href="{{ route('admin.rekam-medis.edit', $rm->idrekam_medis) }}"
                                        class="action-btn btn-edit">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>

                                    <form action="{{ route('admin.rekam-medis.delete', $rm->idrekam_medis) }}"
                                          method="POST" onsubmit="return confirm('Hapus rekam medis ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="action-btn btn-delete">
                                            <i class="bi bi-trash3"></i> Hapus
                                        </button>
                                    </form>
                                </div>
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
