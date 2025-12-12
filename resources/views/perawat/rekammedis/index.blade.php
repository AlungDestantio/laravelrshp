@extends('layouts.perawat')

@section('title','Rekam Medis Perawat')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')

{{-- =================== HEADER =================== --}}
<div class="page-header">
    <div class="container">
        <h1>Rekam Medis</h1>
        <p>Catat data pemeriksaan pasien dan kelola rekam medis harian.</p>
    </div>
</div>

<div class="alert-container">
    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif
</div>

<div class="container">

    {{-- =================== FORM TAMBAH =================== --}}
    <div class="card mb-5">
        <div class="card-body">
            <form action="{{ route('perawat.rekam-medis.store') }}" method="POST">
                @csrf

                {{-- RESERVASI DOKTER --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Reservasi Dokter</label>
                    <select name="idreservasi_dokter" class="form-select" required>
                        <option value="">-- Pilih Reservasi --</option>
                        @foreach($reservasi as $td)
                            <option value="{{ $td->idreservasi_dokter }}"
                                data-dokter="{{ $td->dokter->user->nama ?? 'Tidak ada' }}">
                                No Urut {{ $td->no_urut }} — {{ $td->pet->nama }}
                            </option>
                        @endforeach

                    </select>
                </div>

                {{-- DOKTER --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Dokter Pemeriksa</label>
                    <input type="text" id="dokter_pemeriksa_text" class="form-control" readonly placeholder="Pilih reservasi dulu">
                </div>

                {{-- ANAMNESA --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Anamnesa</label>
                    <textarea name="anamnesa" class="form-control" rows="2"></textarea>
                </div>

                {{-- TEMUAN KLINIS --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Temuan Klinis</label>
                    <textarea name="temuan_klinis" class="form-control" rows="2"></textarea>
                </div>

                {{-- DIAGNOSA --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Diagnosa</label>
                    <textarea name="diagnosa" class="form-control" rows="2"></textarea>
                </div>

                <div class="text-end">
                    <button class="btn btn-add px-4">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Rekam Medis
                    </button>
                    <a href="{{ route('perawat.dashboard') }}" class="btn btn-secondary px-4">
                        <i class="bi bi-arrow-left-circle me-2"></i>Kembali
                    </a>
                </div>

            </form>
        </div>
    </div>



    {{-- =================== TABEL REKAM MEDIS =================== --}}
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
                                    <a href="{{ route('perawat.rekam-medis.show', $rm->idrekam_medis) }}"
                                        class="action-btn btn-add">
                                        <i class="bi bi-eye-fill"></i> Detail
                                    </a>

                                    <a href="{{ route('perawat.rekam-medis.edit', $rm->idrekam_medis) }}"
                                        class="action-btn btn-edit">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>

                                    <form action="{{ route('perawat.rekam-medis.delete', $rm->idrekam_medis) }}"
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


<script>
document.addEventListener('DOMContentLoaded', function () {
    const selectReservasi = document.querySelector('select[name="idreservasi_dokter"]');
    const dokterInput = document.getElementById('dokter_pemeriksa_text');

    function updateDokter() {
        const selected = selectReservasi.options[selectReservasi.selectedIndex];
        const namaDokter = selected.getAttribute('data-dokter') || 'Tidak ada';
        dokterInput.value = namaDokter;
    }

    selectReservasi.addEventListener('change', updateDokter);

    // Set default saat halaman pertama kali muncul
    updateDokter();
});
</script>
