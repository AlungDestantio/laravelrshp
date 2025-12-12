@extends('layouts.admin')

@section('title', 'Tambah Perawat')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/stylemenu.css') }}">
@endsection

@section('content')

{{-- =================== PAGE HEADER =================== --}}
<div class="page-header">
    <div class="container">
        <h1>Tambah Perawat</h1>
        <p>Tambahkan data perawat baru ke dalam sistem.</p>
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
            <form action="{{ route('admin.perawat.store') }}" method="POST">
                @csrf

                {{-- USER --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">User</label>
                    <select name="iduser" class="form-select @error('iduser') is-invalid @enderror" required>
                        <option value="">-- Pilih User --</option>
                        @foreach($users as $u)
                            <option value="{{ $u->iduser }}" {{ old('iduser') == $u->iduser ? 'selected' : '' }}>
                                {{ $u->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('iduser')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- PENDIDIKAN --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Pendidikan</label>
                    <input type="text"
                           name="pendidikan"
                           class="form-control @error('pendidikan') is-invalid @enderror"
                           value="{{ old('pendidikan') }}"
                           placeholder="Contoh: D3 Keperawatan"
                           required>
                    @error('pendidikan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- NO HP --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">No HP</label>
                    <input type="text"
                           name="no_hp"
                           class="form-control @error('no_hp') is-invalid @enderror"
                           value="{{ old('no_hp') }}"
                           placeholder="08xxxxxxxxxx"
                           required>
                    @error('no_hp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- JENIS KELAMIN --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                        <option value="">-- Pilih --</option>
                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
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
                              rows="3"
                              placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- BUTTON --}}
                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-add px-4 me-2">
                        <i class="bi bi-plus-circle me-1"></i> Simpan
                    </button>

                    <a href="{{ route('admin.perawat.index') }}" class="btn btn-secondary px-4">
                        <i class="bi bi-arrow-left-circle me-1"></i> Kembali
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
