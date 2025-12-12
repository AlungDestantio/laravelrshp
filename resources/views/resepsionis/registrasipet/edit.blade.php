@extends('layouts.resepsionis')

@section('title', 'Edit Data Hewan')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')

{{-- ============ HEADER ============ --}}
<div class="page-header">
    <div class="container">
        <h1>Edit Data Hewan</h1>
        <p>Perbarui informasi hewan peliharaan terdaftar.</p>
    </div>
</div>

<div class="container">

    {{-- ALERT --}}
    @if (session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    {{-- ============ FORM EDIT PET ============ --}}
    <div class="card">
        <div class="card-body">

            <form action="{{ route('resepsionis.registrasi-pet.update', $data->idpet) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- PEMILIK & NAMA --}}
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Pilih Pemilik</label>
                        <select name="idpemilik" class="form-select" required>
                            <option value="">-- Pilih Pemilik --</option>
                            @foreach ($pemilik as $p)
                                <option value="{{ $p->idpemilik }}"
                                    {{ $data->idpemilik == $p->idpemilik ? 'selected' : '' }}>
                                    {{ $p->user->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nama Hewan</label>
                        <input type="text" name="nama" class="form-control"
                               value="{{ $data->nama }}" required>
                    </div>
                </div>

                {{-- TANGGAL / JK / WARNA --}}
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control"
                               value="{{ $data->tanggal_lahir }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select" required>
                            <option value="J" {{ $data->jenis_kelamin == 'J' ? 'selected' : '' }}>Jantan</option>
                            <option value="B" {{ $data->jenis_kelamin == 'B' ? 'selected' : '' }}>Betina</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Warna / Tanda Khusus</label>
                        <input type="text" name="warna_tanda" class="form-control"
                               value="{{ $data->warna_tanda }}" placeholder="Contoh: Putih, belang, dll">
                    </div>
                </div>

                {{-- JENIS & RAS --}}
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Jenis Hewan</label>
                        <select name="idjenis_hewan" id="idjenis_hewan" class="form-select" required>
                            <option value="">-- Pilih Jenis Hewan --</option>
                            @foreach ($jenis_hewan as $j)
                                <option value="{{ $j->idjenis_hewan }}"
                                    {{ $j->idjenis_hewan == $data->ras->idjenis_hewan ? 'selected' : '' }}>
                                    {{ $j->nama_jenis_hewan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Ras Hewan</label>
                        <select name="idras_hewan" id="idras_hewan" class="form-select" required>
                            <option value="">-- Pilih Ras Hewan --</option>
                            @foreach ($ras_hewan as $r)
                                <option value="{{ $r->idras_hewan }}"
                                    {{ $r->idras_hewan == $data->idras_hewan ? 'selected' : '' }}>
                                    {{ $r->nama_ras }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- BUTTON --}}
                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-add px-4 me-2">
                        <i class="bi bi-save me-1"></i> Update
                    </button>

                    <a href="{{ route('resepsionis.registrasi-pet.index') }}"
                       class="btn btn-secondary px-4"
                       style="border-radius:8px; font-weight:600;">
                        <i class="bi bi-arrow-left-circle me-1"></i> Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection
