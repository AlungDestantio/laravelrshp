@extends('layouts.admin')

@section('title','Tambah Rekam Medis Admin')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')

{{-- =================== HEADER =================== --}}
<div class="page-header">
    <div class="container">
        <h1>Tambah Rekam Medis</h1>
        <p>Catat data pemeriksaan pasien.</p>
    </div>
</div>

<div class="container">

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif


    {{-- =================== FORM TAMBAH =================== --}}
    <div class="card mb-5">
        <div class="card-body">
            <form action="{{ route('admin.rekam-medis.store') }}" method="POST">
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
                    <a href="{{ route('admin.rekam-medis.index') }}" class="btn btn-secondary px-4">
                        <i class="bi bi-arrow-left-circle me-2"></i>Kembali
                    </a>
                </div>

            </form>
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
    updateDokter();
});
</script>
