@extends('layouts.admin')

@section('title', 'Edit Dokter')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')

{{-- =================== HEADER =================== --}}
<div class="page-header">
    <div class="container">
        <h1>Edit Dokter</h1>
        <p>Perbarui informasi dokter klinik hewan.</p>
    </div>
</div>

<div class="container">

    {{-- ALERT VALIDASI --}}
    @if ($errors->any())
        <div class="alert alert-danger text-start">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card mb-5">
        <div class="card-body">

            <form action="{{ route('admin.dokter.update', $data->id_dokter) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- USER --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">User</label>
                    <select name="iduser" class="form-select @error('iduser') is-invalid @enderror" required>
                        @foreach($users as $u)
                            <option value="{{ $u->iduser }}"
                                {{ $data->iduser == $u->iduser ? 'selected' : '' }}>
                                {{ $u->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('iduser')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- BIDANG DOKTER --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Bidang Dokter</label>
                    <input type="text"
                        name="bidang_dokter"
                        class="form-control @error('bidang_dokter') is-invalid @enderror"
                        value="{{ old('bidang_dokter', $data->bidang_dokter) }}"
                        required>
                    @error('bidang_dokter')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- NO HP --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">No HP</label>
                    <input type="text"
                        name="no_hp"
                        class="form-control @error('no_hp') is-invalid @enderror"
                        value="{{ old('no_hp', $data->no_hp) }}"
                        required>
                    @error('no_hp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- JENIS KELAMIN --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                        <option value="L" {{ $data->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ $data->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- ALAMAT --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Alamat</label>
                    <textarea name="alamat"
                        class="form-control @error('alamat') is-invalid @enderror"
                        rows="3">{{ old('alamat', $data->alamat) }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- BUTTON --}}
                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-add text-white px-4 me-2">
                        <i class="bi bi-save me-1"></i> Perbarui
                    </button>

                    <a href="{{ route('admin.dokter.index') }}" class="btn btn-secondary px-4">
                        <i class="bi bi-arrow-left-circle me-1"></i> Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection
